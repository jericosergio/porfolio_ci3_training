<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all($active_only = TRUE)
	{
		if ($active_only) {
			$this->db->where('is_active', 1);
		}
		
		$this->db->order_by('display_order', 'ASC');
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('projects');
		
		$projects = array();
		foreach ($query->result() as $project) {
			$projects[] = $this->build_project_array($project);
		}
		
		return $projects;
	}

	public function get_by_slug($slug)
	{
		$query = $this->db->get_where('projects', array('slug' => $slug, 'is_active' => 1));
		
		if ($query->num_rows() > 0) {
			return $this->build_project_array($query->row());
		}
		
		return NULL;
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('projects', array('id' => $id))->row();
	}

	public function build_project_array($project)
	{
		$data = array(
			'id' => $project->id,
			'slug' => $project->slug,
			'title' => $project->title,
			'description' => $project->description,
			'tech' => $project->tech,
			'image' => $project->image ? base_url($project->image) : NULL,
			'featured' => (bool)$project->featured,
			'timeline' => $project->timeline,
			'full_description' => $project->full_description,
			'is_active' => (bool)$project->is_active,
			'display_order' => $project->display_order,
			'is_training' => (bool)$project->is_training
		);

		if ($project->featured_image) {
			$data['featured_image'] = base_url($project->featured_image);
		}

		if ($project->event) {
			$data['event'] = $project->event;
		}

		// Get metrics
		$metrics = $this->get_project_metrics($project->id);
		if (!empty($metrics)) {
			$data['metrics'] = $metrics;
		}

		// Get highlights
		$highlights = $this->get_project_highlights($project->id);
		if (!empty($highlights)) {
			$data['highlights'] = $highlights;
		}

		// Get images
		$images = $this->get_project_images($project->id);
		if (!empty($images)) {
			$data['images'] = $images;
		}

		return $data;
	}

	public function get_project_metrics($project_id)
	{
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get_where('project_metrics', array('project_id' => $project_id, 'is_active' => 1));
		
		$metrics = array();
		foreach ($query->result() as $metric) {
			$metrics[$metric->metric_label] = $metric->metric_value;
		}
		
		return $metrics;
	}

	public function get_project_highlights($project_id)
	{
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get_where('project_highlights', array('project_id' => $project_id, 'is_active' => 1));
		
		$highlights = array();
		foreach ($query->result() as $highlight) {
			$highlights[] = $highlight->highlight_text;
		}
		
		return $highlights;
	}

	public function get_project_images($project_id)
	{
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get_where('project_images', array('project_id' => $project_id, 'is_active' => 1));
		
		$images = array();
		foreach ($query->result() as $image) {
			// Add base_url() to the image path
			$images[] = base_url($image->image_path);
		}
		
		return $images;
	}

	public function insert($data)
	{
		$project_data = array(
			'slug' => $data['slug'],
			'title' => $data['title'],
			'description' => $data['description'],
			'tech' => $data['tech'],
			'image' => isset($data['image']) ? $data['image'] : NULL,
			'featured_image' => isset($data['featured_image']) ? $data['featured_image'] : NULL,
			'featured' => isset($data['featured']) ? 1 : 0,
			'is_training' => isset($data['is_training']) ? 1 : 0,
			'timeline' => isset($data['timeline']) ? $data['timeline'] : NULL,
			'event' => isset($data['event']) ? $data['event'] : NULL,
			'full_description' => isset($data['full_description']) ? $data['full_description'] : NULL,
			'display_order' => isset($data['display_order']) ? $data['display_order'] : 0,
			'is_active' => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('projects', $project_data);
		$project_id = $this->db->insert_id();

		// Insert metrics
		if (isset($data['metrics']) && is_array($data['metrics'])) {
			$this->save_metrics($project_id, $data['metrics']);
		}

		// Insert highlights
		if (isset($data['highlights']) && is_array($data['highlights'])) {
			$this->save_highlights($project_id, $data['highlights']);
		}

		// Insert images
		if (isset($data['images']) && is_array($data['images'])) {
			$this->save_images($project_id, $data['images']);
		}

		return $project_id;
	}

	public function update($id, $data)
	{
		$project_data = array(
			'slug' => $data['slug'],
			'title' => $data['title'],
			'description' => $data['description'],
			'tech' => $data['tech'],
			'featured' => $data['featured'],
			'is_training' => $data['is_training'],
            'is_active' => $data['is_active'],
			'timeline' => isset($data['timeline']) ? $data['timeline'] : NULL,
			'event' => isset($data['event']) ? $data['event'] : NULL,
			'full_description' => isset($data['full_description']) ? $data['full_description'] : NULL,
			'display_order' => isset($data['display_order']) ? $data['display_order'] : 0,
			'updated_at' => date('Y-m-d H:i:s')
		);

		if (isset($data['image'])) {
			$project_data['image'] = $data['image'];
		}

		if (isset($data['featured_image'])) {
			$project_data['featured_image'] = $data['featured_image'];
		}

		$this->db->where('id', $id);
		$this->db->update('projects', $project_data);

		// Update metrics
		if (isset($data['metrics']) && is_array($data['metrics'])) {
			// Soft delete existing metrics
			$this->db->where('project_id', $id);
			$this->db->update('project_metrics', array('is_active' => 0));
			$this->save_metrics($id, $data['metrics']);
		}

		// Update highlights
		if (isset($data['highlights']) && is_array($data['highlights'])) {
			// Soft delete existing highlights
			$this->db->where('project_id', $id);
			$this->db->update('project_highlights', array('is_active' => 0));
			$this->save_highlights($id, $data['highlights']);
		}

		// Update images
		if (isset($data['remove_images']) && is_array($data['remove_images'])) {
			// Soft delete specific images
			foreach ($data['remove_images'] as $image_url) {
				// Extract just the path without base_url
				$image_path = str_replace(base_url(), '', $image_url);
				$this->db->where('project_id', $id);
				$this->db->where('image_path', $image_path);
				$this->db->update('project_images', array('is_active' => 0));
			}
		}

		if (isset($data['images']) && is_array($data['images'])) {
			$this->save_images($id, $data['images']);
		}

		return TRUE;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('projects');
	}

	private function save_metrics($project_id, $metrics)
	{
		$order = 0;
		foreach ($metrics as $label => $value) {
			$data = array(
				'project_id' => $project_id,
				'metric_label' => $label,
				'metric_value' => $value,
				'display_order' => $order++,
				'is_active' => 1
			);
			$this->db->insert('project_metrics', $data);
		}
	}

	private function save_highlights($project_id, $highlights)
	{
		$order = 0;
		foreach ($highlights as $highlight) {
			$data = array(
				'project_id' => $project_id,
				'highlight_text' => $highlight,
				'display_order' => $order++,
				'is_active' => 1
			);
			$this->db->insert('project_highlights', $data);
		}
	}

	private function save_images($project_id, $images)
	{
		// Get current max display_order for this project
		$this->db->select_max('display_order');
		$this->db->where('project_id', $project_id);
		$query = $this->db->get('project_images');
		$result = $query->row();
		$order = $result->display_order !== NULL ? $result->display_order + 1 : 0;
		
		foreach ($images as $image) {
			$data = array(
				'project_id' => $project_id,
				'image_path' => $image,
				'display_order' => $order++,
				'is_active' => 1
			);
			$this->db->insert('project_images', $data);
		}
	}
}
