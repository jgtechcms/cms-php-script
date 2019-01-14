<?php 
class Page_not_found extends Front_Controller 
{
	public function __construct() 
	{
		parent::__construct(); 
		$this->data = $this->data_common;
	} 

	public function index() 
	{ 
		$this->define_common_component();
		
		$this->output->set_status_header('404'); 

		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/404',$this->data);
	} 
} 