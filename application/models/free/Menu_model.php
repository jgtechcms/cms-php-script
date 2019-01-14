<?php
class Menu_model extends MY_Model
{

	protected $_table_name = 'menu';

	protected $_order_by = 'order_by';
	
	var $breadcrumb_lists = array();

	public $rules = array(

			

		'title' => array(

			'field' => 'title', 

			'label' => 'Title', 

			'rules' => 'trim|required|max_length[100]|xss_clean'

		), 


	);



	public function get_new ()

	{

		$page = new stdClass();

		$page->title = '';		

		return $page;

	}
	
	
	public function getRelatedMenu()
	{
		$this->db->select('menu.*');
		$this->db->from('menu');
		$this->db->where('pages.id', NULL);
		$this->db->join('pages', 'menu.id = pages.menu_id', 'left');
		$this->db->order_by('menu.order_by');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function resetPageType($dynamic_page_type_selected)
	{
		$data = array(
				'page_type' => 'other'
		);

		$this->db->update('menu', $data, array('page_type' => $dynamic_page_type_selected));
	}



	public function get_archive_link(){

		$page = parent::get_by(array('template' => 'news_archive'), TRUE);

		return isset($page->slug) ? $page->slug : '';

	}
	

	public function setBreadcrumbLists($current_menu)
	{
		
		$t_menu = array();
		$t_menu[$current_menu->id] = $current_menu;
		$this->breadcrumb_lists = array_merge($this->breadcrumb_lists, $t_menu);
		
		$parent_id = $current_menu->parent_id;
				
		if($parent_id) {
			
			$menu = $this->get($parent_id, TRUE);
			
			if($menu->parent_id != 0)
				$this->setBreadcrumbLists($menu);
		}
		
	}


	public function getBreadcrumbLists()
	{
		
		return $this->breadcrumb_lists;
	}


}