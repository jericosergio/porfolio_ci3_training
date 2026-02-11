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
			'image' => $project->image,
			'featured' => (bool)$project->featured,
			'timeline' => $project->timeline,
			'full_description' => $project->full_description
		);

		if ($project->featured_image) {
			$data['featured_image'] = $project->featured_image;
		}

		if ($project->event) {
			$data['event'] = $project->event;
		}

		if ($project->is_training) {
			$data['is_training'] = TRUE;
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
		$query = $this->db->get_where('project_metrics', array('project_id' => $project_id));
		
		$metrics = array();
		foreach ($query->result() as $metric) {
			$metrics[$metric->metric_label] = $metric->metric_value;
		}
		
		return $metrics;
	}

	public function get_project_highlights($project_id)
	{
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get_where('project_highlights', array('project_id' => $project_id));
		
		$highlights = array();
		foreach ($query->result() as $highlight) {
			$highlights[] = $highlight->highlight_text;
		}
		
		return $highlights;
	}

	public function get_project_images($project_id)
	{
		$this->db->order_by('display_order', 'ASC');
		$query = $this->db->get_where('project_images', array('project_id' => $project_id));
		
		$images = array();
		foreach ($query->result() as $image) {
			$images[] = $image->image_path;
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
			'featured' => isset($data['featured']) ? 1 : 0,
			'is_training' => isset($data['is_training']) ? 1 : 0,
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
			$this->db->delete('project_metrics', array('project_id' => $id));
			$this->save_metrics($id, $data['metrics']);
		}

		// Update highlights
		if (isset($data['highlights']) && is_array($data['highlights'])) {
			$this->db->delete('project_highlights', array('project_id' => $id));
			$this->save_highlights($id, $data['highlights']);
		}

		// Update images
		if (isset($data['images']) && is_array($data['images'])) {
			$this->db->delete('project_images', array('project_id' => $id));
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
				'display_order' => $order++
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
				'display_order' => $order++
			);
			$this->db->insert('project_highlights', $data);
		}
	}

	private function save_images($project_id, $images)
	{
		$order = 0;
		foreach ($images as $image) {
			$data = array(
				'project_id' => $project_id,
				'image_path' => $image,
				'display_order' => $order++
			);
			$this->db->insert('project_images', $data);
		}
	}
}
