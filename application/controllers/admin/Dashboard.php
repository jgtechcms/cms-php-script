<?php
class Dashboard extends Admin_Controller {

    public function __construct()
	{
        parent::__construct();
				
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
    }

    public function index()
	{
		
		$this->data['page_name'] = 'Dashboard';
		
		$this->load->model('free/Contact_model', 'contactm');
		
		$total_enquirys = 0;
		
		$this->data['total_enquirys'] = $total_enquirys;
		$this->db->order_by('created', 'desc');
		$this->db->limit(5);
		$this->data['contacts'] = $this->contactm->get();
    	
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/dashboard/index';//blank
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
		
		/*
		// call order page
		$this->flexi = new stdClass;	
		
		$sql = "SET sql_mode = ''"; // to prevent -> incompatible with sql_mode=only_full_group_by
		$this->db->query($sql);
		
		$this->load->library('Flexi_cart_admin');
		$this->data['order_data'] = $this->flexi_cart_admin->get_db_order_array();
		
		$this->data['subview'] = $this->data['selected_template_path'].'/'.$this->data['site_models']['ecommerce'].'/orders/orders_view';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
		*/
    }
	
	public function remove_cache()
	{
		// Deletes cache for the currently requested URI
		$this->output->clear_all_cache();
		$this->db->cache_delete_all();
		
		$this->session->set_flashdata('success_message', 'Cache removed successfully');
		redirect($this->data['customer_admin']['dashboard_url']);
	}
}