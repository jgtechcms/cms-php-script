<?php

class Menu_type_model extends MY_Model

{

	protected $_table_name = 'menu_type';

	protected $_order_by = 'id';

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



	public function get_archive_link(){

		$page = parent::get_by(array('template' => 'news_archive'), TRUE);

		return isset($page->slug) ? $page->slug : '';

	}



}