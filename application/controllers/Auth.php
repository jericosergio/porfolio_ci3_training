<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function login()
	{
		// If already logged in, redirect to CMS dashboard
		if ($this->session->userdata('logged_in')) {
			redirect('cms/dashboard');
		}

		// Form submission
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run()) {
				$username = $this->input->post('username', TRUE);
				$password = $this->input->post('password');

				// Authenticate user
				$user = $this->User_model->authenticate($username, $password);

				if ($user) {
					// Set session data
					$session_data = array(
						'user_id' => $user->id,
						'username' => $user->username,
						'full_name' => $user->full_name,
						'email' => $user->email,
						'logged_in' => TRUE
					);
					$this->session->set_userdata($session_data);

					// Update last login
					$this->User_model->update_last_login($user->id);

					// Log activity
					$this->log_activity($user->id, 'login', 'Logged in to CMS');

					// Set success message
					$this->session->set_flashdata('success', 'Welcome back, ' . $user->full_name . '!');

					// Redirect to CMS dashboard
					redirect('cms/dashboard');
				} else {
					// Invalid credentials
					$this->session->set_flashdata('error', 'Invalid username or password');
				}
			}
		}

		// Load login view
		$this->load->view('auth/login');
	}

	public function logout()
	{
		// Log activity before destroying session
		if ($this->session->userdata('user_id')) {
			$this->log_activity($this->session->userdata('user_id'), 'logout', 'Logged out from CMS');
		}

		// Destroy session
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('full_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();

		$this->session->set_flashdata('success', 'You have been logged out successfully');
		redirect('auth/login');
	}

	private function log_activity($user_id, $action, $description = NULL)
	{
		$data = array(
			'user_id' => $user_id,
			'action' => $action,
			'description' => $description,
			'ip_address' => $this->input->ip_address(),
			'user_agent' => substr($this->input->user_agent(), 0, 255),
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('activity_log', $data);
	}
}
