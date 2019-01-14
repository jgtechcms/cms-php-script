<?php
class Vendors extends Admin_Controller {

	public function __construct()
    {
        parent::__construct();
		
		$this->data = $this->data_common;
		
        $this->load->model($this->data['site_models']['ecommerce'] . '/Vendors_model');
        $this->load->library('form_validation');
		
		// set config
        $this->table_config = $this->Vendors_model->getTableConfig();
		$this->data['module_path'] = $this->data['selected_template_path'].'/'.$this->data['site_models']['ecommerce'];
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
    }
	
	public function index()
	{
		$this->data['users'] = $this->Vendors_model->get();
		
		// Load view
		$subview = 'vendors/index';
		$this->_loadView($this->data, $subview);
	}
	
	public function add()
	{
		
		// Load view
		$subview = 'vendors/add';
		$this->_loadView($this->data, $subview);
	}
}