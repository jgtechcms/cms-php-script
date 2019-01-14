<?php

class Template_model extends MY_Model

{	

	protected $_table_name = 'templates';

	public $rules = array(

		'templatename' => array(

			'field' => 'templatename', 

			'label' => 'Template Name', 

			'rules' => 'trim|required|max_length[140]|xss_clean'

		), 

	);

	function __construct ()
	{
		parent::__construct();
	}
	
	
	
	function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL)
	{
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;
	 
		if($key)$params["$key !="] = $value;
	 
		while ($t->db->where($params)->get($table)->num_rows())
		{  
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			 
			$params [$field] = $slug;
		}  
		return $slug;  
	}
	
	function isActivateTemplate($site_settings)
	{
		$template_modified = $site_settings->template_modified;
		
		if($this->validateDate($template_modified)) {
			$today_date = date('Y-m-d');
			
			$time = strtotime($template_modified);
			$expired_date = date('Y-m-d', strtotime("+1 month", $time));
			
			if($expired_date <= $today_date) {
				return true;
			}
			
			return false;
		}
		return true;
	}

	function validateDate($date)
	{
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
	}

}