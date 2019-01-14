<?php

class Register_model extends MY_Model

{

	protected $_table_name = 'register';

	protected $_order_by = 'id desc';

	protected $_timestamps = TRUE;

	public $rules = array(
		
		'name' => array(

			'field' => 'name', 

			'label' => 'Name', 

			'rules' => 'trim|required|max_length[150]'

		), 

		'company' => array(

			'field' => 'company', 

			'label' => 'Company', 

			'rules' => 'trim|required|max_length[150]'

		),
		
		'mail' => array(

			'field' => 'mail', 

			'label' => 'Mail', 

			'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'

		), 
		
	
	);
	
}