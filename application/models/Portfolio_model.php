<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($key)
	{
		$query = $this->db->get_where('portfolio_data', array('data_key' => $key));
		
		if ($query->num_rows() > 0) {
			return $query->row()->data_value;
		}
		
		return NULL;
	}

	public function get_all()
	{
		$query = $this->db->get('portfolio_data');
		
		$data = array();
		foreach ($query->result() as $row) {
			$data[$row->data_key] = $row->data_value;
		}
		
		return $data;
	}

	public function set($key, $value, $type = 'string')
	{
		$data = array(
			'data_key' => $key,
			'data_value' => $value,
			'data_type' => $type,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Check if key exists
		$existing = $this->db->get_where('portfolio_data', array('data_key' => $key));
		
		if ($existing->num_rows() > 0) {
			// Update
			$this->db->where('data_key', $key);
			$this->db->update('portfolio_data', $data);
		} else {
			// Insert
			$data['created_at'] = date('Y-m-d H:i:s');
			$this->db->insert('portfolio_data', $data);
		}
	}

	public function get_skills()
	{
		$this->db->where('is_active', 1);
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get('skills');
		
		$skills = array();
		foreach ($query->result() as $skill) {
			$skills[] = array(
				'name' => $skill->name,
				'level' => $skill->level
			);
		}
		
		return $skills;
	}

	public function get_experience()
	{
		$this->db->where('is_active', 1);
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get('experience');
		
		$experience = array();
		foreach ($query->result() as $exp) {
			$responsibilities = explode("\n", $exp->responsibilities);
			$experience[] = array(
				'position' => $exp->position,
				'company' => $exp->company,
				'location' => $exp->location,
				'duration' => $exp->duration,
				'responsibilities' => $responsibilities
			);
		}
		
		return $experience;
	}

	public function get_education()
	{
		$this->db->where('is_active', 1);
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get('education');
		
		$education = array();
		foreach ($query->result() as $edu) {
			$highlights = !empty($edu->highlights) ? explode("\n", $edu->highlights) : array();
			$education[] = array(
				'degree' => $edu->degree,
				'school' => $edu->school,
				'location' => $edu->location,
				'year' => $edu->year,
				'honors' => $edu->honors,
				'highlights' => $highlights
			);
		}
		
		return $education;
	}

	public function get_tech_stack()
	{
		$this->db->where('is_active', 1);
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get('tech_stack');
		
		$tech_stack = array();
		foreach ($query->result() as $tech) {
			$tech_stack[$tech->category] = $tech->technologies;
		}
		
		return $tech_stack;
	}
}
