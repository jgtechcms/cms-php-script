<?php

class Ext_product_category_model extends MY_Model

{	

	protected $_table_name = 'extension_product_category';
	

	function __construct ()
	{
		
		parent::__construct();
		
	}
	
	function getPageCategory()
	{
		$this->db->select('ext_cat.id, menu.id AS menu_id, ext_cat.is_enable, menu.title');
		$this->db->from('menu');
		$this->db->order_by('menu.id');
		$this->db->join('extension_product_category ext_cat', 'ext_cat.menu_id = menu.id', 'left');//echo $this->db->get_compiled_select();
		$query = $this->db->get();
		return $query->result();
	}
	
	/*public function addCategory($data)
	{
		$this->db->cache_delete_all();
		
		$sql = "INSERT INTO extension_product_category (menu_id, is_enable) VALUES('".$data['menu_id']."', '".$data['is_enable']."') ON DUPLICATE KEY UPDATE is_enable='".$data['is_enable']."'";
		$this->db->query($sql);
	}*/
	

}