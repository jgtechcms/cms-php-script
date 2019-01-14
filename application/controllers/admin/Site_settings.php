<?php

class Site_settings extends Admin_Controller {



    public function __construct(){

        parent::__construct();		
	
		$this->data = $this->data_common;
		$this->load->model('cms/Template_model');	
		$this->customer_admin = $this->config->item( 'customer_admin' );
		$this->data['customer_admin'] = $this->customer_admin;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
		
		if($_POST) {
			if($this->_isNotEditable()) {
				$this->session->set_flashdata('error_message', $this->lang->line('error_permission_denied'));
				
				redirect($this->data['customer_admin']['dashboard_url'].'/'.$this->data['current_page']);
			}			
		}
	}


	public function index() 
	{
		$this->data['page_name'] = 'Settings';
		$customer_asset_folder = $this->config->item('customer_asset_folder');		
		$customer_source_url = $this->config->item('customer_source_url');
		
		// Fetch site settings data
		$this->data['services'] = $this->Site_settings_model->get(NULL, TRUE);
		$this->data['template'] = $this->Template_model->get_by(array('id'=> $this->data['services']->template_id), TRUE);
		
		// Form Vaidation
		$rules = $this->Site_settings_model->rules_edit;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) 
		{
			// Update Site settings table data
			$dataval['site_title'] = $this -> input -> post('sitetitle');	
			$dataval['address'] = $this -> input -> post('address');		   
			$dataval['phone'] = $this -> input -> post('phone');
			$dataval['admin_email'] = $this -> input -> post('admin_email');			
			$dataval['template_type'] = $this -> input -> post('templatetype');			
			$dataval['ga_code'] = $this -> input -> post('gacode');			
			$dataval['copy_right'] = $this -> input -> post('copy_right');			
			$dataval['is_ecommerce_enabled'] = $this -> input -> post('is_ecommerce_enabled');		
			$dataval['custom_css'] = $this -> input -> post('custom_css');
			
			$upload_err_msg = '';

			//Check whether user upload Logo
			if(!empty($_FILES['logofile']['name']))
			{
				$uploadary_logo['upload_path'] = $customer_asset_folder;
				$uploadary_logo['file_name'] = $_FILES['logofile']['name'];
				$uploadary_logo['allowed_types'] = $this->config->item('allowed_types');
				$uploadary_logo['max_width']     = config_item('logo_width');
                $uploadary_logo['max_height']    = config_item('logo_height');
                $uploadary_logo['max_size']    = config_item('logo_size');
				
				//Load upload library and initialize configuration
				$this->load->library('upload',$uploadary_logo);
				$this->upload->initialize($uploadary_logo);
				
				if($this->upload->do_upload('logofile')){
					$uploadData_logo = $this->upload->data();
					$logofile = $uploadData_logo['file_name'];
				}else{
					$logofile = '';
					$upload_err_msg = $this->upload->display_errors();
				}
				
				$dataval['logo'] = $logofile;
			}
			else
			{
				$logofile = '';
			}
			
			//Check whether user upload favicon
			if(!empty($_FILES['favifile']['name']))
			{
				$uploadary_favi['upload_path'] = $customer_asset_folder;
				$uploadary_favi['file_name'] = $_FILES['favifile']['name'];
				$uploadary_favi['allowed_types'] = $this->config->item('allowed_types').'|ico';
				$uploadary_favi['max_width']     = config_item('favicon_width');
                $uploadary_favi['max_height']    = config_item('favicon_height');
				
				//Load upload library and initialize configuration
				$this->load->library('upload',$uploadary_favi);
				$this->upload->initialize($uploadary_favi);
				
				if($this->upload->do_upload('favifile')){
					$uploadData_favi = $this->upload->data();
					$favifile = $uploadData_favi['file_name'];
				}else{
					$favifile = '';
					$upload_err_msg .= $this->upload->display_errors();
				}
				
				$dataval['favicon'] = $favifile;
			}
			else
			{
				$favifile = '';
			}
			
			//Check whether user upload background image
			$t_background_image = $this -> input -> post('t_background_image');
			if($t_background_image == 2 and isset($_FILES['background_image']['name']) and !empty($_FILES['background_image']['name']))
			{
				$uploadary_bimage['upload_path'] = $customer_asset_folder;
				$uploadary_bimage['file_name'] = $_FILES['background_image']['name'];
				$uploadary_bimage['allowed_types'] = $this->config->item('allowed_types');
				$uploadary_bimage['min_width']     = config_item('template_background_image_width');
                $uploadary_bimage['min_height']    = config_item('template_background_image_height');
                $uploadary_bimage['max_size']    = config_item('template_background_size');
				
				//Load upload library and initialize configuration
				$this->load->library('upload',$uploadary_bimage);
				$this->upload->initialize($uploadary_bimage);
				
				if($this->upload->do_upload('background_image')) {
					$uploadData_logo = $this->upload->data();
					$dataval['background_image'] = $uploadData_logo['file_name'];
				} else {
					$upload_err_msg .= $this->upload->display_errors();
				}
				
				
			} else if($t_background_image != 2) {
				$dataval['background_image'] = $t_background_image;
			}
			
			if(empty($upload_err_msg)) {
				$this->Site_settings_model->update($dataval, $this->data['services']->id); 
				$message = "Settings Updated Successfully";
				$this->session->set_flashdata('success_message', $message);
				
				redirect($this->data['customer_admin']['dashboard_url'].'/site_settings');
			} else {
				$this->session->set_flashdata('error_message', $upload_err_msg);
			}
		} else if($_POST) {
			$this->session->set_flashdata('error_message', 'Please check all the fields are correct.');
		}
		
		// check logo
		if(isset($this->data['services']->logo) and is_file($customer_source_url .'/' . $this->data['services']->logo))		
			$this->data['logo'] = $customer_source_url .'/' . $this->data['services']->logo;
		// check favicon
		if(isset($this->data['services']->favicon) and is_file($customer_source_url .'/' . $this->data['services']->favicon))		
			$this->data['favicon'] = $customer_source_url .'/' . $this->data['services']->favicon;
		// check background image
		if($this->data['services']->background_image and is_file($customer_source_url .'/' . $this->data['services']->background_image))		
			$this->data['background_image'] = $customer_source_url .'/' . $this->data['services']->background_image;
	
				
		$this->data['subview'] = $this->data['selected_template_path'].'/site_settings/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	public function email()
	{
		$this->data['page_name'] = 'Email Settings';
		
		$this->data['services'] = $this->Site_settings_model->get(NULL, TRUE);
		
		$settings_email = config_item('settings_email');
		
		if($_POST) {
			
			$valid_status = TRUE;
			
			if($this -> input -> post('mail_protocol') == 'smtp') {
				// Form Vaidation
				$rules = $this->Site_settings_model->rules_email_smtp;
				$this->form_validation->set_rules($rules);
				$valid_status = $this->form_validation->run();
			}
			
			if ($valid_status == TRUE) 
			{			
				// Update email settings data
				$dataval['mail_protocol'] = $this -> input -> post('mail_protocol');
				$dataval['admin_email'] = $this -> input -> post('admin_email');
				$dataval['admin_notify_email'] = $this -> input -> post('admin_notify_email');
				$dataval['mail_path'] = $this -> input -> post('mail_path');		   
				$dataval['smtp_host_name'] = $this -> input -> post('smtp_host_name');			
				$dataval['smtp_username'] = $this -> input -> post('smtp_username');			
				$dataval['smtp_password'] = $this -> input -> post('smtp_password');			
				$dataval['smtp_port'] = $this -> input -> post('smtp_port');			
				$dataval['smtp_timeout'] = $this -> input -> post('smtp_timeout');
				
				$this->Site_settings_model->update($dataval, $this->data['services']->id); 
				$message = "Settings Updated Successfully";
				$this->session->set_flashdata('success_message', $message);
				
				redirect($this->data['customer_admin']['dashboard_url'].'/site_settings/email', 'refresh');
			} else {
				
				$this->session->set_flashdata('error_message', 'Please check all the fields are correct.');
			}
		}
		
		$this->data['subview'] = $this->data['selected_template_path'].'/site_settings/email';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function _unique_subdomain ($str)

	{

		// Do NOT validate if subdomain_name already exists

		// UNLESS it's the subdomain_name for the current user
		
		$id = $this->data['customer_id'];
		
		!$id || $this->db->where('id !=', $id);
		
		$this->db->where('subdomain_name', $this->input->post('subdomain'));

		$customer = $this->servicescustomerm->get();

		if (count($customer)) {

			$this->form_validation->set_message('_unique_subdomain', '%s should be unique');

			return FALSE;

		}

		return TRUE;

	}
	
	public function _unique_loginname ($str)

	{
		
		// Do NOT validate if login_name already exists

		// UNLESS it's the login_name for the current user

		$id = $this->data['customer_id'];
		
		$this->db->where('login_name', $this->input->post('name'));
		
		!$id || $this->db->where('id !=', $id);

		$customer_name = $this->servicescustomerm->get();

		if (count($customer_name)) {

			$this->form_validation->set_message('_unique_loginname', '%s should be unique');

			return FALSE;

		}

		return TRUE;
		
	}

}