<?php
class Volunteer_registration extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('free/Custom_model');
		
		$tbl = 'volunteer_registration';
		$order_by = 'id';		
		$this->Custom_model->setParam($tbl, $order_by);
		
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();

    }
	
	public function index($id = null)
	{
		
		$this->data['page_name'] = 'Volunteer Registration';
		$this->data['error_message'] = '';
		
		$this->data['registrations'] = $this->Custom_model->get();	
		
		$view = 'index';
		$layout = '_layout_main';

		if($id)	{
			
			$this->data['row'] = $this->Custom_model->get($id, TRUE);
			
			$view = 'view';
			$layout = '_layout_content_only';
			
			if($this->data['row']) {
				
			} else {
				$this->data['error_message'] = 'Invalid Id';
			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/volunteer_registration/'.$view;
		$this->load->view($this->data['selected_template_path'].'/'.$layout, $this->data);
	}
	
	public function delete($id)
	{
		$this->session->set_flashdata('success_message', 'Volunteer Registration detail has been deleted.');
		//$this->Custom_model->delete($id);
	}
	

}