<?php
class Widget_type_model extends MY_Model
{

	protected $_table_name = 'widget_types';

	protected $_order_by = 'name';

	public $rules = array(
		
		/*'menu_id' => array(
		
			'field' => 'menu', 
			
			'label' => 'Menu', 
			
			'rules' => 'trim|required|callback__unique_menu|xss_clean'
		),*/
			

		'title' => array(

			'field' => 'title', 

			'label' => 'Title', 

			'rules' => 'trim|required|max_length[100]|xss_clean'

		), 
		/*'slug' => array(
			'field' => 'slug', 
			'label' => 'Slug', 
			'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
		),*/ 
		
		'body' => array(

			'field' => 'body_desc', 

			'label' => 'Body', 

			'rules' => 'max_length[50000]'

		)

	);



	public function getRelatedPage ($page_id = '')

	{

		$this->db->select('pages.*, menu.title AS menu_title, menu.page_type');
		$this->db->from('pages');
		$this->db->join('menu', 'menu.id = pages.menu_id');
		
		if($page_id)
			$this->db->where('pages.id', $page_id);
		
		$this->db->order_by('menu.order_by');
		$query = $this->db->get();
		
		if($page_id)
			return $query->row();
		else
			return $query->result();

	}


}