<?php

class Api_model extends MY_Model

{		

	public function __construct ()
	{
		
		parent::__construct();
		
	}
	
	public function getPage($slug)
	{
		$this->writeDbCache();
		
		$this->db->select('menu.*, pages.title, pages.content');
		$this->db->from('menu');
		if($slug == '')
			$this->db->where('menu.is_home', 1);
		else
			$this->db->where('menu.slug', $slug);
		$this->db->join('pages', 'menu.id = pages.menu_id', 'left');
		$this->db->order_by('menu.order_by');//echo $this->db->get_compiled_select();exit;
		$query = $this->db->get();
		return $query->result();
	}
	
	public function writeDbCache()
	{
		//$this->db->cache_on();
	}
	
	public function deleteDbCache()
	{
		//$this->db->cache_delete_all();
	}
	

}