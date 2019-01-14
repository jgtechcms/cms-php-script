<?php
class User_menu_model extends MY_Model
{

	protected $_table_name = 'user_menu';

	protected $_order_by = 'id';
	
	public function delete_menu($where)
	{		
		$this->db->where($where);
		$this->db->delete('user_menu');
	}
	
	public function getUserMenu($requested_menu)
	{
		$menu_types = $this->config->item('menu_types');
		
		$user_menu_values = array();
		foreach($menu_types as $menu_type => $menu_type_id) {
			if($menu_type == $requested_menu) {
				break;
			}
		}
		if(isset($menu_type_id)) {
			$this->db->select('menu.*,user_menu.menu_type_id');
			$this->db->from('menu');
			$this->db->where('user_menu.menu_type_id', $menu_type_id);
			//$this->db->where('menu.parent_id', 0);
			if($requested_menu == 'header')
				$this->db->order_by('menu.parent_id, menu.order_by');
			else
				$this->db->order_by('menu.order_by');
			$this->db->join('user_menu', 'menu.id = user_menu.menu_id');
			$query = $this->db->get();
			$result = $query->result();
			
			// get parent only
			$parent_ids = array();
			$new_result = array();
			foreach($result as $row) {
				if(in_array($row->parent_id, $parent_ids)) {
					$parent_ids[] = $row->id;
					continue;
				}
				$parent_ids[] = $row->id;
				$new_result[] = $row;
				
			}//print_r($new_result);exit;
			
			$user_menu_values = array();
			foreach($new_result as $menu) {
				if($menu->is_home)
					$menu->slug = '';
				$menu->sub_menu = $this->_getUserMenu($menu->id);
				$user_menu_values[] = $menu;
			}
			/*
			$user_menus = $this->get_by(array('customer_id' => $customer_id, 'menu_type_id' => $menu_type_id));
			foreach($user_menus as $user_menu) {
				$user_menu_values[] = $this->_getUserMenu($user_menu->menu_id);
			}
			*/
		
			/*if(empty($user_menu_values)) {
				$this->db->select('menu.*,user_menu.menu_type_id');
				$this->db->from('menu');
				$this->db->where('user_menu.menu_type_id', $menu_type_id);
				$this->db->where('menu.parent_id', 0);
				$this->db->order_by('menu.order_by');
				$this->db->join('user_menu', 'menu.id = user_menu.menu_id');
				$query = $this->db->get();
				$result = $query->result();
				$user_menu_values = array();
				foreach($result as $menu) {
					if($menu->is_home)
						$menu->slug = '';
					$menu->sub_menu = $this->_getUserMenu($menu->id);
					$user_menu_values[] = $menu;
				}
			}*/
		}
		
		return $user_menu_values;
	}
	
	public function _getUserMenu($menu_id)
	{		
		$this->load->model('free/Menu_model');
		
		$sub_menu = array();
		
		$child_menu = $this->Menu_model->get_by(array('parent_id' => $menu_id));
		
		foreach($child_menu as $key => $child_menu_detail) {
			$child_menu_detail->sub_menu = $this->_getUserMenu($child_menu_detail->id);
			$sub_menu[] = $child_menu_detail;
		}
		
		return $sub_menu;
	}
	
}