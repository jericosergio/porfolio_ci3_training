<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
}

class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// Check if user is logged in
		if (!$this->session->userdata('logged_in')) {
			$this->session->set_flashdata('error', 'Please login to access the CMS');
			redirect('auth/login');
		}
	}

	protected function log_activity($action, $table_name = NULL, $record_id = NULL, $description = NULL)
	{
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'action' => $action,
			'table_name' => $table_name,
			'record_id' => $record_id,
			'description' => $description,
			'ip_address' => $this->input->ip_address(),
			'user_agent' => substr($this->input->user_agent(), 0, 255),
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('activity_log', $data);
	}
}
