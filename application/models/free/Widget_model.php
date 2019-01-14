<?php
class Widget_model extends MY_Model
{

	protected $_table_name = 'widgets';

	protected $_order_by = 'id';

	public $rules = array(
			

		'name' => array(

			'field' => 'name', 

			'label' => 'Widget name', 

			'rules' => 'trim|required|max_length[100]|xss_clean'

		), 
		
		'widget_type_id' => array(
		
			'field' => 'widget_type_id', 
			
			'label' => 'Widget type', 
			
			'rules' => 'trim|required'//|callback__unique_widget_type
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
	
	public function getLikeWidgets($txt = '')
	{
		//$this->db->like('item_name', $txt);
		//return $this->get();
		
		$this->db->select('widgets.*');
		$this->db->from('widgets');
		if($txt)
			$this->db->like('name', $txt);
		$this->db->order_by('widgets.name DESC');
		$this->db->limit(100); // avoid loading issue in related products
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getAssociate()
	{
		$this->db->select('widgets.*, widget_types.name as widget_type_name');
		$this->db->from('widgets');
		$this->db->join('widget_types', 'widget_types.id = widgets.widget_type_id');
		$this->db->order_by('widgets.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}


}