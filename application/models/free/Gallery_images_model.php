<?php

class Gallery_images_model extends MY_Model

{

	protected $_table_name = 'gallery_images';

	protected $_order_by = 'id';
	
	
	public function getWithAssociate($limit = null)
	{
		$this->db->select('gallery_images.*, gallery.title');
		$this->db->from('gallery_images');
		$this->db->join('gallery', 'gallery_images.g_id = gallery.id');
		//$this->db->order_by('gallery.title', 'desc');
		
		if($limit)
			$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result();
	}

	public function getWithAssociate_new ($widget_contents)
	{		
		$this->db->select('gallery_images.*, gallery.title as category_title');
		$this->db->from('gallery_images');
		$this->db->join('gallery', 'gallery_images.g_id = gallery.id');
		//$this->db->order_by('gallery.title', 'desc');
		
		foreach($widget_contents as $content) {
			if($content->slug == 'gallery' and $content->page_limit) {
				$this->db->limit($content->page_limit);
				break;
			}
		}
				
		$query = $this->db->get();
		return $query->result();

	}

}