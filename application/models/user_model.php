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
			if (password_verify($password, $user->password)) {
				return $user;
			}
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

	public function get_by_username($username)
	{
		return $this->db->get_where('users', array('username' => $username))->row();
	}

	// Get all users (active and inactive)
	public function get_users()
	{
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	// Get only active users
	public function get_active_users()
	{
		$this->db->where('is_active', 1);
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	// Create new user
	public function create_user($data)
	{
		$user_data = array(
			'username' => $data['username'],
			'email' => $data['email'],
			'full_name' => $data['full_name'],
			'password' => password_hash($data['password'], PASSWORD_BCRYPT),
			'role' => isset($data['role']) ? $data['role'] : 'user',
			'is_active' => isset($data['is_active']) ? $data['is_active'] : 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('users', $user_data);
		return $this->db->insert_id();
	}

	// Update user
	public function update_user($user_id, $data)
	{
		$update_data = array(
			'updated_at' => date('Y-m-d H:i:s')
		);

		if (isset($data['username'])) {
			$update_data['username'] = $data['username'];
		}
		if (isset($data['email'])) {
			$update_data['email'] = $data['email'];
		}
		if (isset($data['full_name'])) {
			$update_data['full_name'] = $data['full_name'];
		}
		if (isset($data['role'])) {
			$update_data['role'] = $data['role'];
		}
		if (isset($data['is_active'])) {
			$update_data['is_active'] = $data['is_active'];
		}
		// Handle password update - only if password is provided and not empty
		if (isset($data['password']) && !empty($data['password'])) {
			$update_data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		}

		$this->db->where('id', $user_id);
		return $this->db->update('users', $update_data);
	}

	// Change password
	public function change_password($user_id, $new_password)
	{
		$update_data = array(
			'password' => password_hash($new_password, PASSWORD_BCRYPT),
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->db->where('id', $user_id);
		return $this->db->update('users', $update_data);
	}

	// Soft delete user
	public function soft_delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		return $this->db->update('users', array(
			'is_active' => 0,
			'updated_at' => date('Y-m-d H:i:s')
		));
	}

	// Check if username exists
	public function username_exists($username, $exclude_id = NULL)
	{
		$this->db->where('username', $username);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get('users');
		return $query->num_rows() > 0;
	}

	// Check if email exists
	public function email_exists($email, $exclude_id = NULL)
	{
		$this->db->where('email', $email);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get('users');
		return $query->num_rows() > 0;
	}
}
