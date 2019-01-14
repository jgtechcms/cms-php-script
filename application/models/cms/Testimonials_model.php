<?php

class Testimonials_model extends MY_Model

{

	protected $_table_name = 'testimonials';

	protected $_order_by = 'id desc';

	protected $_timestamps = TRUE;

	public $rules = array(

		'title' => array(

			'field' => 'title', 

			'label' => 'Name', 

			'rules' => 'trim|required|max_length[250]'

		), 
		
		'company' => array(

			'field' => 'company', 

			'label' => 'Company name', 

			'rules' => 'trim|required|max_length[150]'

		), 
		
		'company_url' => array(

			'field' => 'company_url', 

			'label' => 'Company url', 

			'rules' => 'trim|prep_url|valid_url|max_length[250]' //callback__valid_url

		),

		'body_desc' => array(

			'field' => 'body_desc', 

			'label' => 'Content', 

			'rules' => 'trim|required'

		)

	);



	public function get_limit ($limit = 4)
	{
		if($limit)
			$this->db->limit($limit);
		$this->db->order_by('created', 'desc');
		
		return parent::get();

	}

	public function get_limit_new ($widget_contents)
	{
		foreach($widget_contents as $content) {
			if($content->slug == 'testimonial' and $content->page_limit) {
				$this->db->limit($content->page_limit);
				break;
			}
		}
		
		$this->db->order_by('created', 'desc');
		
		return parent::get();

	}
	

	public function set_published(){

		$this->db->where('pubdate <=', date('Y-m-d'));

	}

	

	public function get_recent($limit = 3){

		

		// Fetch a limited number of recent articles

		$limit = (int) $limit;

		$this->set_published();

		$this->db->limit($limit);

		return parent::get();

	}



}