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
        $this->load->model('User_model');
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
                $gallery_images = $this->handle_multiple_upload('gallery_images', 'projects');

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
                $metrics_input = $this->input->post('metrics');
                if ($metrics_input && is_array($metrics_input)) {
                    $metrics = array();
                    foreach ($metrics_input as $metric) {
                        if (!empty($metric['label']) && !empty($metric['value'])) {
                            $metrics[$metric['label']] = $metric['value'];
                        }
                    }
                    if (!empty($metrics)) {
                        $project_data['metrics'] = $metrics;
                    }
                }

                // Handle highlights
                $highlights_input = $this->input->post('highlights');
                if ($highlights_input && is_array($highlights_input)) {
                    $highlights = array();
                    foreach ($highlights_input as $highlight) {
                        if (!empty($highlight['text'])) {
                            $highlights[] = $highlight['text'];
                        }
                    }
                    if (!empty($highlights)) {
                        $project_data['highlights'] = $highlights;
                    }
                }

                // Handle gallery images
                if (!empty($gallery_images)) {
                    $project_data['images'] = $gallery_images;
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
                $gallery_images = $this->handle_multiple_upload('gallery_images', 'projects');

                $project_data = array(
                    'slug' => $this->input->post('slug', TRUE),
                    'title' => $this->input->post('title', TRUE),
                    'description' => $this->input->post('description'),
                    'tech' => $this->input->post('tech', TRUE),
                    'featured' => $this->input->post('featured') ? 1 : 0,
                    'is_training' => $this->input->post('is_training') ? 1 : 0,
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    'timeline' => $this->input->post('timeline', TRUE),
                    'event' => $this->input->post('event', TRUE),
                    'full_description' => $this->input->post('full_description'),
                    'display_order' => $this->input->post('display_order', TRUE)
                );

                // Handle main image removal or replacement
                if ($this->input->post('remove_main_image')) {
                    $project_data['image'] = NULL;
                } elseif ($image_path) {
                    $project_data['image'] = $image_path;
                }

                // Handle featured image removal or replacement
                if ($this->input->post('remove_featured_image')) {
                    $project_data['featured_image'] = NULL;
                } elseif ($featured_image_path) {
                    $project_data['featured_image'] = $featured_image_path;
                }

                // Handle gallery image removals
                $remove_gallery_images = $this->input->post('remove_gallery_images');
                if (!empty($remove_gallery_images)) {
                    $project_data['remove_images'] = $remove_gallery_images;
                }

                // Handle new gallery images
                if (!empty($gallery_images)) {
                    $project_data['images'] = $gallery_images;
                }

                // Handle metrics
                $metrics_input = $this->input->post('metrics');
                if ($metrics_input && is_array($metrics_input)) {
                    $metrics = array();
                    foreach ($metrics_input as $metric) {
                        if (!empty($metric['label']) && !empty($metric['value'])) {
                            $metrics[$metric['label']] = $metric['value'];
                        }
                    }
                    if (!empty($metrics)) {
                        $project_data['metrics'] = $metrics;
                    } else {
                        $project_data['metrics'] = array();
                    }
                } else {
                    $project_data['metrics'] = array();
                }

                // Handle highlights
                $highlights_input = $this->input->post('highlights');
                if ($highlights_input && is_array($highlights_input)) {
                    $highlights = array();
                    foreach ($highlights_input as $highlight) {
                        if (!empty($highlight['text'])) {
                            $highlights[] = $highlight['text'];
                        }
                    }
                    if (!empty($highlights)) {
                        $project_data['highlights'] = $highlights;
                    } else {
                        $project_data['highlights'] = array();
                    }
                } else {
                    $project_data['highlights'] = array();
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
        if ($project) {
            $this->db->where('id', $id);
            $this->db->update('projects', array('is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')));
            $this->log_activity('delete_project', 'projects', $id, 'Deleted project: ' . $project->title);
            $this->session->set_flashdata('success', 'Project deleted successfully');
        }
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
            $this->db->update('skills', array('is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')));
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
            $this->db->update('experience', array('is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')));
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
            $this->db->update('education', array('is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')));
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
            $this->db->update('tech_stack', array('is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')));
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

    private function handle_multiple_upload($field_name, $subfolder = '')
    {
        $uploaded_files = array();
        
        if (empty($_FILES[$field_name]['name'][0])) {
            return $uploaded_files;
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

        $files_count = count($_FILES[$field_name]['name']);

        for ($i = 0; $i < $files_count; $i++) {
            if (!empty($_FILES[$field_name]['name'][$i])) {
                $_FILES['single_file']['name'] = $_FILES[$field_name]['name'][$i];
                $_FILES['single_file']['type'] = $_FILES[$field_name]['type'][$i];
                $_FILES['single_file']['tmp_name'] = $_FILES[$field_name]['tmp_name'][$i];
                $_FILES['single_file']['error'] = $_FILES[$field_name]['error'][$i];
                $_FILES['single_file']['size'] = $_FILES[$field_name]['size'][$i];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('single_file')) {
                    $upload_data = $this->upload->data();
                    $relative_path = 'assets/uploads';
                    if ($subfolder) {
                        $relative_path .= '/' . $subfolder;
                    }
                    $uploaded_files[] = $relative_path . '/' . $upload_data['file_name'];
                }
            }
        }

        return $uploaded_files;
    }

    // ======================= USERS CRUD =======================

    public function users()
    {
        $data = array(
            'page_title' => 'Manage Users',
            'users' => $this->User_model->get_users()
        );

        $this->load->view('cms/users/list', $data);
    }

    public function user_form($id = NULL)
    {
        $this->load->library('form_validation');

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');

            // Validate username availability
            if ($id) {
                // Edit mode - check if username exists for other users
                if ($this->User_model->username_exists($this->input->post('username'), $id)) {
                    $this->form_validation->set_message('username_available', 'This username is already taken.');
                    $this->form_validation->set_rules('username', 'Username', 'callback_username_available[' . $id . ']');
                }
            } else {
                // Create mode - check if username exists
                if ($this->User_model->username_exists($this->input->post('username'))) {
                    $this->form_validation->set_message('username_available', 'This username is already taken.');
                    $this->form_validation->set_rules('username', 'Username', 'callback_username_available');
                }
            }

            // Password validation
            if (!$id) {
                // New user - password required
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
                $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'matches[password]');
            } elseif ($this->input->post('password')) {
                // Edit user - password optional but if provided must be valid
                $this->form_validation->set_rules('password', 'Password', 'min_length[8]');
                $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'matches[password]');
            }

            if ($this->form_validation->run() === FALSE) {
                if ($id) {
                    $user = $this->User_model->get_by_id($id);
                    $data = array(
                        'page_title' => 'Edit User',
                        'user' => $user
                    );
                    $this->load->view('cms/users/form', $data);
                } else {
                    $data = array(
                        'page_title' => 'Create User',
                        'user' => NULL
                    );
                    $this->load->view('cms/users/form', $data);
                }
            } else {
                $user_data = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'full_name' => $this->input->post('full_name'),
                    'role' => $this->input->post('role', 'user'),
                    'is_active' => $this->input->post('is_active', 0)
                );

                if ($this->input->post('password')) {
                    $user_data['password'] = $this->input->post('password');
                }

                if ($id) {
                    // Update user
                    $this->User_model->update_user($id, $user_data);
                    $this->log_activity('update', 'users', $id, 'Updated user: ' . $user_data['username']);
                    $this->session->set_flashdata('success', 'User updated successfully.');
                } else {
                    // Create user
                    $new_id = $this->User_model->create_user($user_data);
                    $this->log_activity('create', 'users', $new_id, 'Created new user: ' . $user_data['username']);
                    $this->session->set_flashdata('success', 'User created successfully.');
                }

                redirect('cms/users');
            }
        } else {
            if ($id) {
                $user = $this->User_model->get_by_id($id);
                if (!$user) {
                    show_404();
                }
                $data = array(
                    'page_title' => 'Edit User',
                    'user' => $user
                );
                $this->load->view('cms/users/form', $data);
            } else {
                $data = array(
                    'page_title' => 'Create User',
                    'user' => NULL
                );
                $this->load->view('cms/users/form', $data);
            }
        }
    }

    public function user_delete($id)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            show_404();
        }

        // Don't allow deleting yourself
        if ($user->id === $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You cannot delete your own account.');
            redirect('cms/users');
        }

        $this->User_model->soft_delete_user($id);
        $this->log_activity('delete', 'users', $id, 'Deactivated user: ' . $user->username);
        $this->session->set_flashdata('success', 'User deactivated successfully.');
        
        redirect('cms/users');
    }

    // ======================= CHANGE PASSWORD =======================

    public function change_password()
    {
        $this->load->library('form_validation');
        $user_id = $this->session->userdata('user_id');

        if ($this->input->post()) {
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[new_password]');

            if ($this->form_validation->run() === FALSE) {
                $data = array(
                    'page_title' => 'Change Password'
                );
                $this->load->view('cms/change_password', $data);
            } else {
                // Verify old password
                $user = $this->User_model->get_by_id($user_id);
                
                if (!password_verify($this->input->post('old_password'), $user->password)) {
                    $this->session->set_flashdata('error', 'Old password is incorrect.');
                    redirect('cms/change_password');
                }

                // Update password
                $this->User_model->change_password($user_id, $this->input->post('new_password'));
                $this->log_activity('update', 'users', $user_id, 'Changed password');
                
                $this->session->set_flashdata('success', 'Password changed successfully.');
                redirect('cms/dashboard');
            }
        } else {
            $data = array(
                'page_title' => 'Change Password'
            );
            $this->load->view('cms/change_password', $data);
        }
    }

    // Callback function for username validation
    public function username_available($username = '', $user_id = NULL)
    {
        if ($user_id && $user_id !== 'NULL') {
            // Edit mode
            if (!$this->User_model->username_exists($username, $user_id)) {
                return TRUE;
            }
        } else {
            // Create mode
            if (!$this->User_model->username_exists($username)) {
                return TRUE;
            }
        }
        
        $this->form_validation->set_message('username_available', 'This username is already taken.');
        return FALSE;
    }

    // ======================= DRAG & DROP REORDER METHODS =======================
    
    public function reorder_skills()
    {
        header('Content-Type: application/json');
        
        if (!$this->input->is_ajax_request()) {
            http_response_code(403);
            echo json_encode(array('status' => 'error', 'message' => 'Not an AJAX request'));
            exit;
        }

        $order = $this->input->post('order');
        
        if (!$order) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'No order data'));
            exit;
        }

        // Parse JSON if it's a string
        if (is_string($order)) {
            $order = json_decode($order, true);
        }

        if ($order && is_array($order)) {
            foreach ($order as $position => $id) {
                $this->db->where('id', $id);
                $this->db->update('skills', array('display_order' => $position + 1));
            }
            echo json_encode(array('status' => 'success'));
            exit;
        }
        
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid order data'));
        exit;
    }

    public function reorder_experience()
    {
        header('Content-Type: application/json');
        
        if (!$this->input->is_ajax_request()) {
            http_response_code(403);
            echo json_encode(array('status' => 'error', 'message' => 'Not an AJAX request'));
            exit;
        }

        $order = $this->input->post('order');
        
        if (!$order) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'No order data'));
            exit;
        }

        if (is_string($order)) {
            $order = json_decode($order, true);
        }

        if ($order && is_array($order)) {
            foreach ($order as $position => $id) {
                $this->db->where('id', $id);
                $this->db->update('experience', array('display_order' => $position + 1));
            }
            echo json_encode(array('status' => 'success'));
            exit;
        }
        
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid order data'));
        exit;
    }

    public function reorder_education()
    {
        header('Content-Type: application/json');
        
        if (!$this->input->is_ajax_request()) {
            http_response_code(403);
            echo json_encode(array('status' => 'error', 'message' => 'Not an AJAX request'));
            exit;
        }

        $order = $this->input->post('order');
        
        if (!$order) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'No order data'));
            exit;
        }

        if (is_string($order)) {
            $order = json_decode($order, true);
        }

        if ($order && is_array($order)) {
            foreach ($order as $position => $id) {
                $this->db->where('id', $id);
                $this->db->update('education', array('display_order' => $position + 1));
            }
            echo json_encode(array('status' => 'success'));
            exit;
        }
        
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid order data'));
        exit;
    }

    public function reorder_tech_stack()
    {
        header('Content-Type: application/json');
        
        if (!$this->input->is_ajax_request()) {
            http_response_code(403);
            echo json_encode(array('status' => 'error', 'message' => 'Not an AJAX request'));
            exit;
        }

        $order = $this->input->post('order');
        
        if (!$order) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'No order data'));
            exit;
        }

        if (is_string($order)) {
            $order = json_decode($order, true);
        }

        if ($order && is_array($order)) {
            foreach ($order as $position => $id) {
                $this->db->where('id', $id);
                $this->db->update('tech_stack', array('display_order' => $position + 1));
            }
            echo json_encode(array('status' => 'success'));
            exit;
        }
        
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid order data'));
        exit;
    }

    public function reorder_projects()
    {
        header('Content-Type: application/json');
        
        if (!$this->input->is_ajax_request()) {
            http_response_code(403);
            echo json_encode(array('status' => 'error', 'message' => 'Not an AJAX request'));
            exit;
        }

        $order = $this->input->post('order');
        
        if (!$order) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'No order data'));
            exit;
        }

        if (is_string($order)) {
            $order = json_decode($order, true);
        }

        if ($order && is_array($order)) {
            foreach ($order as $position => $id) {
                $this->db->where('id', $id);
                $this->db->update('projects', array('display_order' => $position + 1));
            }
            echo json_encode(array('status' => 'success'));
            exit;
        }
        
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid order data'));
        exit;
    }

    // ======================= PORTFOLIO MANAGEMENT =======================
    
    public function portfolio_settings()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('tagline', 'Tagline', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'trim');
            $this->form_validation->set_rules('location', 'Location', 'trim');

            if ($this->form_validation->run()) {
                // Update all portfolio data
                $this->Portfolio_model->set('name', $this->input->post('name', TRUE));
                $this->Portfolio_model->set('tagline', $this->input->post('tagline', TRUE));
                $this->Portfolio_model->set('about', $this->input->post('about'));
                $this->Portfolio_model->set('email', $this->input->post('email', TRUE));
                $this->Portfolio_model->set('work_email', $this->input->post('work_email', TRUE));
                $this->Portfolio_model->set('phone', $this->input->post('phone', TRUE));
                $this->Portfolio_model->set('location', $this->input->post('location', TRUE));
                $this->Portfolio_model->set('github', $this->input->post('github', TRUE));
                $this->Portfolio_model->set('linkedin', $this->input->post('linkedin', TRUE));
                $this->Portfolio_model->set('aspirations', $this->input->post('aspirations'));
                $this->Portfolio_model->set('clients_stakeholders', $this->input->post('clients_stakeholders'));

                $this->session->set_flashdata('success', 'Portfolio settings updated successfully!');
                redirect('cms/portfolio_settings');
            }
        }

        $data = array(
            'page_title' => 'Portfolio Settings',
            'portfolio_data' => $this->Portfolio_model->get_all()
        );

        $this->load->view('cms/portfolio_settings', $data);
    }
}
