<?php

class Contact_model extends MY_Model

{

	protected $_table_name = 'enquiry';

	protected $_order_by = 'id';

	public $rules = array(
		
		'name' => array(

			'field' => 'name', 

			'label' => 'Name', 

			'rules' => 'trim|required|max_length[200]'

		), 

		'subject' => array(

			'field' => 'subject', 

			'label' => 'Subject', 

			'rules' => 'trim|required|max_length[250]'

		),
		
		'phone' => array(

			'field' => 'phone', 

			'label' => 'Phone No', 

			'rules' => 'trim|required|numeric|max_length[15]'

		), 
		
		'message' => array(

			'field' => 'message', 

			'label' => 'Message', 

			'rules' => 'trim|required'

		), 
		
		'email' => array(

			'field' => 'email', 

			'label' => 'Mail', 

			'rules' => 'trim|required|valid_email|xss_clean'

		), 
		
	
	);



	public function get_new ()

	{

		$contact = new stdClass();

		$contact->name = '';

		$contact->email = '';

		$contact->phone = '';

		$contact->subject = '';

		$contact->message = '';

		return $page;

	}



		
/* 
	public function delete ($id)

	{

		// Delete a page

		parent::delete($id);

		

		// Reset parent ID for its children

		$this->db->set(array(

			'parent_id' => 0

		))->where('parent_id', $id)->update($this->_table_name);

	}
 */


	public function save_order ($pages)

	{

		if (count($pages)) {

			foreach ($pages as $order => $page) {

				if ($page['item_id'] != '') {

					$data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);

					$this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);

				}

			}

		}

	}



	public function get_nested ()

	{

		$this->db->order_by($this->_order_by);

		$pages = $this->db->get('pages')->result_array();

		

		$array = array();

		foreach ($pages as $page) {

			if (! $page['parent_id']) {

				// This page has no parent

				$array[$page['id']] = $page;

			}

			else {

				// This is a child page

				$array[$page['parent_id']]['children'][] = $page;

			}

		}

		return $array;

	}



	public function get_with_parent ($id = NULL, $single = FALSE)

	{

		$this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');

		$this->db->join('pages as p', 'pages.parent_id=p.id', 'left');

		return parent::get($id, $single);

	}



	public function get_no_parents ()

	{

		// Fetch pages without parents

		$this->db->select('id, title');

		$this->db->where('parent_id', 0);

		$pages = parent::get();

		

		// Return key => value pair array

		$array = array(

			0 => 'No parent'

		);

		if (count($pages)) {

			foreach ($pages as $page) {

				$array[$page->id] = $page->title;

			}

		}

		

		return $array;

	}

}