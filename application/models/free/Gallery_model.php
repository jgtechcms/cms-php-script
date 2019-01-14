<?php

class Gallery_model extends MY_Model

{

	protected $_table_name = 'gallery';

	protected $_order_by = 'title desc';

	public function getWithAssociate()
	{
		$this->db->select('gallery.*');
		$this->db->from('gallery');
		$this->db->join('gallery_images', 'gallery.id = gallery_images.g_id');
		$this->db->group_by('gallery.id');
		//$this->db->order_by('gallery.title', 'desc');
				
		$query = $this->db->get();
		return $query->result();
	}
} 