<?php

class MY_Model extends CI_Model {	

	protected $_table_name = '';

	protected $_primary_key = 'id';

	protected $_primary_filter = 'intval';

	protected $_order_by = '';

	public $rules = array();

	protected $_timestamps = FALSE;

	

	public function __construct() 
	{

		parent::__construct();	

	}	
	
	public function getSlug($field, $title, $id = null, $parent_id = null) 
	{
		if( $this->_table_name != '') {
			$config = array(
				'table' => $this->_table_name,
				'id' => $this->_primary_key,
				'field' => $field,
				//'title' => 'title',
				'replacement' => 'dash' // Either dash or underscore
			);
			
			$this->load->library('slug', $config);
			
			$this->slug->parent_id_value = $parent_id;
			
			return $this->slug->create_uri($title, $id);
		}
		return '';
	}
	
	public function setTableConfig($table_config)
	{
		$this->_table_name = $table_config['table_name'];
		$this->primary_field = $table_config['primary_field'];
		$this->login_field = $table_config['login_field'];
		$this->password_field = $table_config['password_field'];
	}

	public function array_from_post($fields)
	{

		$data = array();

		foreach ($fields as $field) {

			$data[$field] = $this->input->post($field);

		}

		return $data;

	}

	public function get($id = NULL, $single = FALSE)
	{

		if ($id != NULL) {

			$filter = $this->_primary_filter;

			$id = $filter($id);

			$this->db->where($this->_primary_key, $id);

			$method = 'row';

		}
		elseif($single == TRUE) {

			$method = 'row';

		}
		else {

			$method = 'result';

		}		

		if(!count($this->db->order_by($this->_order_by))) {
			$this->db->order_by($this->_order_by);
		}
		// Create a cache in database table//
		//$this->db->cache_on();	  
		return $this->db->get($this->_table_name)->$method();

	}

	public function get_compile($where)
	{
		$this->db->where($where);
		$sql = $this->db->get_compiled_select($this->_table_name);
		echo $sql;
	}	

	public function get_by($where, $single = FALSE)
	{
		// Create a cache in database table//
		//$this->db->cache_on();
	   
		$this->db->where($where);
		return $this->get(NULL, $single);

	}

	// Pagination retrieve	
	public function getbypagination($limit=null,$offset=NULL)
	{
		$this->db->from($this->_table_name);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	//Total count of table	
	public function totalcount()
	{
		return $this->db->count_all_results($this->_table_name);
	}	
	
	public function totalcount_where($where)
	{
		$this->db->where($where);
		$this->db->from($this->_table_name);
		return $this->db->count_all_results();
	}

	public function save($data, $id = NULL)
	{
    
	   // Delete cache in database table//
		$this->db->cache_delete_all();

		// Set timestamps

		if ($this->_timestamps == TRUE) {

			date_default_timezone_set('Europe/London');

			$now = date('Y-m-d H:i:s');

			//$id || $data['created'] = $now;

			//$data['modified'] = $now;

		}
		

		// Insert
		if ($id === NULL) {

			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;

			$this->db->set($data);

			$this->db->insert($this->_table_name);			

			$id = $this->db->insert_id();

		}

		// Update
		else {

			$filter = $this->_primary_filter;

			$id = $filter($id);

			$this->db->set($data);

			$this->db->where($this->_primary_key, $id);

			$this->db->update($this->_table_name);

		}		

		return $id;
		
	}	
	
	public function insert_batch($data)
	{
		$this->db->cache_delete_all();
		
		$this->db->insert_batch($this->_table_name, $data);
	}
	
	public function update_where($data, $where)
	{
		// Delete cache in database table//
		$this->db->cache_delete_all();
		
		$this->db->set($data);

		$this->db->where($where);

		$this->db->update($this->_table_name);
	}

	public function update($data, $id)
	{
		// Delete cache in database table//
		$this->db->cache_delete_all();

		// Set timestamps

		if ($this->_timestamps == TRUE) {

			date_default_timezone_set('Europe/London');

			$now = date('Y-m-d H:i:s');

			//$id || $data['created'] = $now;

			//$data['modified'] = $now;

		}		

		// Insert
		if ($id === NULL) {

			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;

			$this->db->set($data);

			$this->db->insert($this->_table_name);			

			$id = $this->db->insert_id();

		}
		// Update
		else {

			$filter = $this->_primary_filter;

			$id = $filter($id);

			$this->db->set($data);

			$this->db->where($this->_primary_key, $id);

			$this->db->update($this->_table_name);

		}		

		return $id;

	}	

	public function delete($id)
	{
      // Delete cache in database table//
	   $this->db->cache_delete_all();
	
		$filter = $this->_primary_filter;

		$id = $filter($id);		

		if (!$id) {

			return FALSE;

		}

		$this->db->where($this->_primary_key, $id);

		$this->db->limit(1);

		$this->db->delete($this->_table_name);

	}	

	public function active($id)
	{
		// Delete cache in database table//
		$this->db->cache_delete_all();

		$filter = $this->_primary_filter;

		$id = $filter($id);		

		if (!$id) {

			return FALSE;

		}

		$now = date('Y-m-d H:i:s');

		$this->db->where($this->_primary_key, $id);

		$this->db->limit(1);	

			$this->db->set(array(

				'status' => '2'));

			$this->db->update($this->_table_name);			

	}
	
	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}	

}