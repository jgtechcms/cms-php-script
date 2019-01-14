<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AfterControllerClass {
	function index() {
		$CI =& get_instance();
		
		$error_message = $CI->session->flashdata('error_message');
		if($error_message) 
		{
			//$CI->data['error_message'] = $error_message;
			MY_Loader::$add_data['error_message'] = $error_message;
		}
	}
}