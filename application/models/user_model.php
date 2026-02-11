<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function authenticate($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('is_active', 1);
		$query = $this->db->get('users');

		if ($query->num_rows() === 1) {
			$user = $query->row();
			
			// Verify password
			// if (password_verify($password, $user->password)) {
				return $user;
			// }
		}

		return FALSE;
	}

	public function update_last_login($user_id)
	{
		$data = array(
			'last_login' => date('Y-m-d H:i:s')
		);

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('users', array('id' => $id))->row();
	}

	// Keep legacy methods for backward compatibility
	public function get_users()
	{
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function get_active_users()
	{
		$this->db->where('is_active', 1);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function insert_user($data)
	{
		return $this->db->insert('users', $data);
	}

	public function soft_delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		return $this->db->update('users', array('is_active' => 0));
	}
}

