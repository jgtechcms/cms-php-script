<?php
class Social_media_model extends MY_Model
{

	protected $_table_name = 'social_media';

	protected $_order_by = 'id';

	public $rules = array(
		
		'name' => array(

			'field' => 'name', 

			'label' => 'Name', 

			'rules' => 'trim|required|max_length[100]'

		), 
		
		'icon' => array(

			'field' => 'icon', 

			'label' => 'Fa Icon', 

			'rules' => 'trim|required'

		),
		
		'url' => array(

			'field' => 'url', 

			'label' => 'URL', 

			'rules' => 'trim|required|callback__valid_url|max_length[250]'

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