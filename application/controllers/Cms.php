<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Cms extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Project_model');
		$this->load->model('Portfolio_model');
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function dashboard()
	{
		$data = array(
			'page_title' => 'CMS Dashboard',
			'total_projects' => $this->db->count_all('projects'),
			'active_projects' => $this->db->where('is_active', 1)->count_all_results('projects'),
			'featured_projects' => $this->db->where('featured', 1)->where('is_active', 1)->count_all_results('projects'),
		);

		// Get recent activity
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(10);
		$data['recent_activity'] = $this->db->get('activity_log')->result();

		$this->load->view('cms/dashboard', $data);
	}

	// ======================= PROJECTS CRUD =======================

	public function projects()
	{
		$data = array(
			'page_title' => 'Manage Projects',
			'projects' => $this->Project_model->get_all(FALSE)
		);

		$this->load->view('cms/projects/list', $data);
	}

	public function project_create()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('slug', 'Slug', 'required|trim|is_unique[projects.slug]');
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('tech', 'Technologies', 'required');

			if ($this->form_validation->run()) {
				// Handle image upload
				$image_path = $this->handle_upload('image', 'projects');
				$featured_image_path = $this->handle_upload('featured_image', 'projects');

				$project_data = array(
					'slug' => $this->input->post('slug', TRUE),
					'title' => $this->input->post('title', TRUE),
					'description' => $this->input->post('description'),
					'tech' => $this->input->post('tech', TRUE),
					'featured' => $this->input->post('featured') ? 1 : 0,
					'is_training' => $this->input->post('is_training') ? 1 : 0,
					'timeline' => $this->input->post('timeline', TRUE),
					'event' => $this->input->post('event', TRUE),
					'full_description' => $this->input->post('full_description'),
					'display_order' => $this->input->post('display_order', TRUE)
				);

				if ($image_path) {
					$project_data['image'] = $image_path;
				}

				if ($featured_image_path) {
					$project_data['featured_image'] = $featured_image_path;
				}

				// Handle metrics
				$metric_labels = $this->input->post('metric_label');
				$metric_values = $this->input->post('metric_value');
				if ($metric_labels && $metric_values) {
					$metrics = array();
					foreach ($metric_labels as $key => $label) {
						if (!empty($label) && !empty($metric_values[$key])) {
							$metrics[$label] = $metric_values[$key];
						}
					}
					$project_data['metrics'] = $metrics;
				}

				// Handle highlights
				$highlights = $this->input->post('highlights');
				if ($highlights) {
					$project_data['highlights'] = array_filter($highlights);
				}

				// Handle images
				$images = $this->input->post('images');
				if ($images) {
					$project_data['images'] = array_filter($images);
				}

				$project_id = $this->Project_model->insert($project_data);

				$this->log_activity('create_project', 'projects', $project_id, 'Created project: ' . $project_data['title']);
				$this->session->set_flashdata('success', 'Project created successfully');
				redirect('cms/projects');
			}
		}

		$data = array(
			'page_title' => 'Create New Project',
			'action' => 'create'
		);

		$this->load->view('cms/projects/form', $data);
	}

	public function project_edit($id)
	{
		$project = $this->Project_model->get_by_id($id);

		if (!$project) {
			show_404();
		}

		if ($this->input->post()) {
			$this->form_validation->set_rules('slug', 'Slug', 'required|trim');
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('tech', 'Technologies', 'required');

			if ($this->form_validation->run()) {
				// Handle image upload
				$image_path = $this->handle_upload('image', 'projects');
				$featured_image_path = $this->handle_upload('featured_image', 'projects');

				$project_data = array(
					'slug' => $this->input->post('slug', TRUE),
					'title' => $this->input->post('title', TRUE),
					'description' => $this->input->post('description'),
					'tech' => $this->input->post('tech', TRUE),
					'featured' => $this->input->post('featured') ? 1 : 0,
					'is_training' => $this->input->post('is_training') ? 1 : 0,
					'timeline' => $this->input->post('timeline', TRUE),
					'event' => $this->input->post('event', TRUE),
					'full_description' => $this->input->post('full_description'),
					'display_order' => $this->input->post('display_order', TRUE)
				);

				if ($image_path) {
					$project_data['image'] = $image_path;
				}

				if ($featured_image_path) {
					$project_data['featured_image'] = $featured_image_path;
				}

				// Handle metrics
				$metric_labels = $this->input->post('metric_label');
				$metric_values = $this->input->post('metric_value');
				if ($metric_labels && $metric_values) {
					$metrics = array();
					foreach ($metric_labels as $key => $label) {
						if (!empty($label) && !empty($metric_values[$key])) {
							$metrics[$label] = $metric_values[$key];
						}
					}
					$project_data['metrics'] = $metrics;
				}

				// Handle highlights
				$highlights = $this->input->post('highlights');
				if ($highlights) {
					$project_data['highlights'] = array_filter($highlights);
				}

				// Handle images
				$images = $this->input->post('images');
				if ($images) {
					$project_data['images'] = array_filter($images);
				}

				$this->Project_model->update($id, $project_data);

				$this->log_activity('update_project', 'projects', $id, 'Updated project: ' . $project_data['title']);
				$this->session->set_flashdata('success', 'Project updated successfully');
				redirect('cms/projects');
			}
		}

		$data = array(
			'page_title' => 'Edit Project',
			'action' => 'edit',
			'project' => $this->Project_model->build_project_array($project)
		);

		$this->load->view('cms/projects/form', $data);
	}

	public function project_delete($id)
	{
		$project = $this->Project_model->get_by_id($id);

		if (!$project) {
			show_404();
		}

		$this->Project_model->delete($id);
		$this->log_activity('delete_project', 'projects', $id, 'Deleted project: ' . $project->title);
		$this->session->set_flashdata('success', 'Project deleted successfully');
		redirect('cms/projects');
	}

	// ======================= PORTFOLIO DATA =======================

	public function profile()
	{
		if ($this->input->post()) {
			// Save portfolio data
			$fields = array('name', 'tagline', 'email', 'work_email', 'phone', 'location', 'github', 'linkedin', 'about', 'aspirations', 'clients_stakeholders');

			foreach ($fields as $field) {
				$value = $this->input->post($field);
				if ($value !== NULL) {
					$this->Portfolio_model->set($field, $value);
				}
			}

			// Handle profile image upload
			$profile_image = $this->handle_upload('profile_image', 'profile');
			if ($profile_image) {
				$this->Portfolio_model->set('profile_image', $profile_image);
			}

			$this->log_activity('update_profile', 'portfolio_data', NULL, 'Updated portfolio profile data');
			$this->session->set_flashdata('success', 'Profile updated successfully');
			redirect('cms/profile');
		}

		$data = array(
			'page_title' => 'Edit Portfolio Profile',
			'portfolio' => $this->Portfolio_model->get_all()
		);

		$this->load->view('cms/profile', $data);
	}

	// ======================= SKILLS CRUD =======================

	public function skills()
	{
		$data = array(
			'page_title' => 'Manage Skills',
			'skills' => $this->Portfolio_model->get_skills()
		);

		$this->load->view('cms/skills/list', $data);
	}

	public function skill_form($id = NULL)
	{
		$data = array(
			'page_title' => $id ? 'Edit Skill' : 'Add Skill',
			'action' => $id ? 'edit' : 'create'
		);

		if ($id) {
			$skill = $this->db->get_where('skills', array('id' => $id))->row();
			if (!$skill) {
				show_404();
			}
			$data['skill'] = $skill;
		}

		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Skill Name', 'required|trim');
			$this->form_validation->set_rules('level', 'Proficiency Level', 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]');
			$this->form_validation->set_rules('display_order', 'Display Order', 'required|integer');

			if ($this->form_validation->run()) {
				$skill_data = array(
					'name' => $this->input->post('name'),
					'level' => $this->input->post('level'),
					'display_order' => $this->input->post('display_order'),
					'is_active' => $this->input->post('is_active') ? 1 : 0,
					'updated_at' => date('Y-m-d H:i:s')
				);

				if ($id) {
					$this->db->where('id', $id);
					$this->db->update('skills', $skill_data);
					$this->log_activity('update_skill', 'Updated skill: ' . $skill_data['name']);
					$this->session->set_flashdata('success', 'Skill updated successfully');
				} else {
					$skill_data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('skills', $skill_data);
					$this->log_activity('create_skill', 'Created skill: ' . $skill_data['name']);
					$this->session->set_flashdata('success', 'Skill added successfully');
				}

				redirect('cms/skills');
			}
		}

		$this->load->view('cms/skills/form', $data);
	}

	public function skill_delete($id)
	{
		$skill = $this->db->get_where('skills', array('id' => $id))->row();
		if ($skill) {
			$this->db->where('id', $id);
			$this->db->delete('skills');
			$this->log_activity('delete_skill', 'Deleted skill: ' . $skill->name);
			$this->session->set_flashdata('success', 'Skill deleted successfully');
		}
		redirect('cms/skills');
	}

	// ======================= EXPERIENCE CRUD =======================

	public function experience()
	{
		$data = array(
			'page_title' => 'Manage Experience',
			'experience' => $this->Portfolio_model->get_experience()
		);

		$this->load->view('cms/experience/list', $data);
	}

	public function experience_form($id = NULL)
	{
		$data = array(
			'page_title' => $id ? 'Edit Experience' : 'Add Experience',
			'action' => $id ? 'edit' : 'create'
		);

		if ($id) {
			$exp = $this->db->get_where('experience', array('id' => $id))->row();
			if (!$exp) {
				show_404();
			}
			$data['experience'] = $exp;
		}

		if ($this->input->post()) {
			$this->form_validation->set_rules('position', 'Position', 'required|trim');
			$this->form_validation->set_rules('company', 'Company', 'required|trim');
			$this->form_validation->set_rules('location', 'Location', 'required|trim');
			$this->form_validation->set_rules('duration', 'Duration', 'required|trim');
			$this->form_validation->set_rules('responsibilities', 'Responsibilities', 'required');

			if ($this->form_validation->run()) {
				$exp_data = array(
					'position' => $this->input->post('position'),
					'company' => $this->input->post('company'),
					'location' => $this->input->post('location'),
					'duration' => $this->input->post('duration'),
					'responsibilities' => $this->input->post('responsibilities'),
					'display_order' => $this->input->post('display_order'),
					'is_active' => $this->input->post('is_active') ? 1 : 0,
					'updated_at' => date('Y-m-d H:i:s')
				);

				if ($id) {
					$this->db->where('id', $id);
					$this->db->update('experience', $exp_data);
					$this->log_activity('update_experience', 'Updated experience: ' . $exp_data['position']);
					$this->session->set_flashdata('success', 'Experience updated successfully');
				} else {
					$exp_data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('experience', $exp_data);
					$this->log_activity('create_experience', 'Created experience: ' . $exp_data['position']);
					$this->session->set_flashdata('success', 'Experience added successfully');
				}

				redirect('cms/experience');
			}
		}

		$this->load->view('cms/experience/form', $data);
	}

	public function experience_delete($id)
	{
		$exp = $this->db->get_where('experience', array('id' => $id))->row();
		if ($exp) {
			$this->db->where('id', $id);
			$this->db->delete('experience');
			$this->log_activity('delete_experience', 'Deleted experience: ' . $exp->position);
			$this->session->set_flashdata('success', 'Experience deleted successfully');
		}
		redirect('cms/experience');
	}

	// ======================= EDUCATION CRUD =======================

	public function education()
	{
		$data = array(
			'page_title' => 'Manage Education',
			'education' => $this->Portfolio_model->get_education()
		);

		$this->load->view('cms/education/list', $data);
	}

	public function education_form($id = NULL)
	{
		$data = array(
			'page_title' => $id ? 'Edit Education' : 'Add Education',
			'action' => $id ? 'edit' : 'create'
		);

		if ($id) {
			$edu = $this->db->get_where('education', array('id' => $id))->row();
			if (!$edu) {
				show_404();
			}
			$data['education'] = $edu;
		}

		if ($this->input->post()) {
			$this->form_validation->set_rules('degree', 'Degree', 'required|trim');
			$this->form_validation->set_rules('school', 'School', 'required|trim');
			$this->form_validation->set_rules('location', 'Location', 'required|trim');
			$this->form_validation->set_rules('year', 'Year', 'required|trim');

			if ($this->form_validation->run()) {
				$edu_data = array(
					'degree' => $this->input->post('degree'),
					'school' => $this->input->post('school'),
					'location' => $this->input->post('location'),
					'year' => $this->input->post('year'),
					'honors' => $this->input->post('honors'),
					'highlights' => $this->input->post('highlights'),
					'display_order' => $this->input->post('display_order'),
					'is_active' => $this->input->post('is_active') ? 1 : 0,
					'updated_at' => date('Y-m-d H:i:s')
				);

				if ($id) {
					$this->db->where('id', $id);
					$this->db->update('education', $edu_data);
					$this->log_activity('update_education', 'Updated education: ' . $edu_data['degree']);
					$this->session->set_flashdata('success', 'Education updated successfully');
				} else {
					$edu_data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('education', $edu_data);
					$this->log_activity('create_education', 'Created education: ' . $edu_data['degree']);
					$this->session->set_flashdata('success', 'Education added successfully');
				}

				redirect('cms/education');
			}
		}

		$this->load->view('cms/education/form', $data);
	}

	public function education_delete($id)
	{
		$edu = $this->db->get_where('education', array('id' => $id))->row();
		if ($edu) {
			$this->db->where('id', $id);
			$this->db->delete('education');
			$this->log_activity('delete_education', 'Deleted education: ' . $edu->degree);
			$this->session->set_flashdata('success', 'Education deleted successfully');
		}
		redirect('cms/education');
	}

	// ======================= TECH STACK CRUD =======================

	public function tech_stack()
	{
		$data = array(
			'page_title' => 'Manage Tech Stack',
			'tech_stack' => $this->Portfolio_model->get_tech_stack()
		);

		$this->load->view('cms/tech_stack/list', $data);
	}

	public function tech_stack_form($id = NULL)
	{
		$data = array(
			'page_title' => $id ? 'Edit Tech Stack' : 'Add Tech Stack',
			'action' => $id ? 'edit' : 'create'
		);

		if ($id) {
			$tech = $this->db->get_where('tech_stack', array('id' => $id))->row();
			if (!$tech) {
				show_404();
			}
			$data['tech_stack'] = $tech;
		}

		if ($this->input->post()) {
			$this->form_validation->set_rules('category', 'Category', 'required|trim');
			$this->form_validation->set_rules('technologies', 'Technologies', 'required|trim');

			if ($this->form_validation->run()) {
				$tech_data = array(
					'category' => $this->input->post('category'),
					'technologies' => $this->input->post('technologies'),
					'display_order' => $this->input->post('display_order'),
					'is_active' => $this->input->post('is_active') ? 1 : 0,
					'updated_at' => date('Y-m-d H:i:s')
				);

				if ($id) {
					$this->db->where('id', $id);
					$this->db->update('tech_stack', $tech_data);
					$this->log_activity('update_tech_stack', 'Updated tech stack: ' . $tech_data['category']);
					$this->session->set_flashdata('success', 'Tech stack updated successfully');
				} else {
					$tech_data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('tech_stack', $tech_data);
					$this->log_activity('create_tech_stack', 'Created tech stack: ' . $tech_data['category']);
					$this->session->set_flashdata('success', 'Tech stack added successfully');
				}

				redirect('cms/tech_stack');
			}
		}

		$this->load->view('cms/tech_stack/form', $data);
	}

	public function tech_stack_delete($id)
	{
		$tech = $this->db->get_where('tech_stack', array('id' => $id))->row();
		if ($tech) {
			$this->db->where('id', $id);
			$this->db->delete('tech_stack');
			$this->log_activity('delete_tech_stack', 'Deleted tech stack: ' . $tech->category);
			$this->session->set_flashdata('success', 'Tech stack deleted successfully');
		}
		redirect('cms/tech_stack');
	}

	// ======================= HELPER METHODS =======================

	private function handle_upload($field_name, $subfolder = '')
	{
		if (empty($_FILES[$field_name]['name'])) {
			return FALSE;
		}

		$upload_path = './assets/uploads';
		if ($subfolder) {
			$upload_path .= '/' . $subfolder;
		}

		// Create directory if it doesn't exist
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, TRUE);
		}

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
		$config['max_size'] = 5120; // 5MB
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->upload->do_upload($field_name)) {
			$upload_data = $this->upload->data();
			$relative_path = 'assets/uploads';
			if ($subfolder) {
				$relative_path .= '/' . $subfolder;
			}
			return $relative_path . '/' . $upload_data['file_name'];
		}

		return FALSE;
	}
}
