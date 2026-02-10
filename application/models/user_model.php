<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function get_users()
    {
        // select * from users;
        $query = $this->db->get('users');
        return $query->result_array();
        //         return $query->result_array();
        // return $query->result_row();

    }
	public function get_active_users()
    {
        // select * from users where valid = '1';
        $this->db->where('valid', 1);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function insert_user($data)
    {
        // insert into users (username, password) values ('john', '1234');
        return $this->db->insert('users', $data);
    }

    public function soft_delete_user($user_id)
    {
        // update users set valid = '0' where id = $user_id;
        $this->db->where('id', $user_id);
        return $this->db->update('users', array('valid' => 0));
    }
}
