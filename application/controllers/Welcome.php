<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Project_model');
		$this->load->model('Portfolio_model');
	}

	public function index()
	{
		$this->portfolio();
	}

	public function project($slug = '')
	{
		if (empty($slug)) {
			redirect('portfolio');
		}

		

		// Get all projects data
		$all_projects = $this->get_projects_data();

		// Find the project by slug
		$project = null;
		foreach ($all_projects as $proj) {
			if ($proj['slug'] === $slug) {
				$project = $proj;
				break;
			}
		}

		if (!$project) {
			show_404();
		}

		$data = array(
			'name' => 'Mat Jerico Sergio',
			'project' => $project,
		);

		$this->load->view('project_detail', $data);
	}

	public function training()
	{
		$this->load->controller('Training');
		$this->Training->index();
	}

	public function portfolio()
	{
		// Fetch all data from database
		$portfolio_data = $this->Portfolio_model->get_all();
		
		$data = array(
			'name' => isset($portfolio_data['name']) ? $portfolio_data['name'] : 'Mat Jerico Sergio',
			'tagline' => isset($portfolio_data['tagline']) ? $portfolio_data['tagline'] : 'Web Development Engineer',
			'about' => isset($portfolio_data['about']) ? $portfolio_data['about'] : '',
			'email' => isset($portfolio_data['email']) ? $portfolio_data['email'] : 'jericosergio2@gmail.com',
			'work_email' => isset($portfolio_data['work_email']) ? $portfolio_data['work_email'] : 'mjsergio@sdca.edu.ph',
			'phone' => isset($portfolio_data['phone']) ? $portfolio_data['phone'] : '+63 XXX XXX XXXX',
			'location' => isset($portfolio_data['location']) ? $portfolio_data['location'] : 'Bacoor, Cavite, Philippines',
			'github' => isset($portfolio_data['github']) ? $portfolio_data['github'] : 'https://github.com/jericosergio',
			'linkedin' => isset($portfolio_data['linkedin']) ? $portfolio_data['linkedin'] : 'https://www.linkedin.com/in/jrcsrg',
			'aspirations' => isset($portfolio_data['aspirations']) ? $portfolio_data['aspirations'] : '',
			'clients_stakeholders' => isset($portfolio_data['clients_stakeholders']) ? $portfolio_data['clients_stakeholders'] : '',
			'skills' => $this->Portfolio_model->get_skills(),
			'experience' => $this->Portfolio_model->get_experience(),
			'education' => $this->Portfolio_model->get_education(),
			'tech_stack' => $this->Portfolio_model->get_tech_stack(),
			'projects' => $this->get_projects_data(),
		);

		$this->load->view('portfolio', $data);
	}



	private function get_projects_data()
	{
		// Fetch projects from database instead of hardcoded array
		return $this->Project_model->get_all();
	}

}
