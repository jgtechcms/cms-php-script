<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_gateway extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('Payment_gateway_model');
		
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();

    }
	
	public function index()
	{
		
		$this->data['page_name'] = 'Payment gateway';
		
		$this->data['payment_gateway'] = $this->Payment_gateway_model->get_by(array('status' => 'enable'));
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/payment_gateway/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function settings($id = null)
	{
		$this->load->model('Payment_gateway_settings_model');
		
		$this->data['page_name'] = 'Settings';
		
		if(is_null($id)) {
			redirect($this->data['customer_admin']['dashboard_url'].'/payment_gateway');
		}
		
		$this->data['payment_gateway'] = $this->Payment_gateway_model->get($id, TRUE);
		$this->data['gateway_settings'] = $gateway_settings = $this->Payment_gateway_settings_model->get_by(array('gateway_id' => $id));
				
		// Form Vaidation
		foreach($gateway_settings as $settings) {
			if($settings->is_required)
				$this->form_validation->set_rules($settings->variable_name, $settings->description, 'required');
		}
		
		// Process the form
		if ($this->form_validation->run() == TRUE) 
		{
			if($this->_isNotEditable()) {
				
				$this->session->set_flashdata('error_message', $this->lang->line('error_permission_denied'));
				
				redirect($this->data['customer_admin']['dashboard_url'].'/payment_gateway/settings/'.$id);
				
			} else {
				foreach($gateway_settings as $settings) {
					$data = array('value' => $this -> input -> post($settings->variable_name));
					$this->Payment_gateway_settings_model->update($data, $settings->id);
				}
				
				// update status in site settings
				$this->Site_settings_model->update(array('is_payment_settings_updated' => 1), $this->data_common['site_settings']->id);
				
				$this->session->set_flashdata('success_message', 'Updated Successfully');
				redirect($this->data['customer_admin']['dashboard_url'].'/payment_gateway/settings/'.$id);
			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/payment_gateway/settings';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	

}