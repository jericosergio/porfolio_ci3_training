<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');

	}

	public function index()
	{
		$data['users'] = $this->user_model->get_active_users();
		$this->load->view('welcome_message', $data);
	}

	public function portfolio()
	{
		$this->load->view('portfolio');
	}

	public function insert_user()
	{
		$data = array(
			'first_name' => $this->input->post('fname'),
			'last_name' => $this->input->post('lname'),
			'middle_name' => $this->input->post('mname'),
			'created_date' => date('Y-m-d H:i:s'),
		);

		if ($this->user_model->insert_user($data)) {
			$this->session->set_flashdata('msg_box', 'User added successfully!');
		} else {
			$this->session->set_flashdata('msg_box', 'Failed to insert user. Please try again.');
		}
		$this->index();
	}

	public function delete_user($user_id)
	{
		if ($this->user_model->soft_delete_user($user_id)) {
			$this->session->set_flashdata('msg_box', 'User deleted successfully!');
		} else {
			$this->session->set_flashdata('msg_box', 'Failed to delete user. Please try again.');
		}
		$this->index();
	}
	public function public_method()
	{
		echo "This is a public method.";
		echo '<br>';
		$this->private_method();
	}
	private function private_method()
	{
		echo "This is a private method.";
	}
}
