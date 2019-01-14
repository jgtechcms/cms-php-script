<?php
class Templates extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('cms/Template_model');
		
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();

    }
	
	public function index($id = null)
	{
		
		$this->data['page_name'] = 'Templates';
		
		$this->data['all_templates'] = $this->Template_model->get();
		
		$this->data['site_settings'] = $this->Site_settings_model->get(NULL, TRUE);
		
		$this->data['is_activate_template'] = $this->Template_model->isActivateTemplate($this->data['site_settings']);
		
		if(!is_null($id)) {
			// validate if activate or not
			if($this->_isNotEditable()) {
				
				$this->session->set_flashdata('error_message', $this->lang->line('error_permission_denied'));
				
				redirect($this->data['customer_admin']['dashboard_url'].'/templates');
				
			} else if( !$this->data['is_activate_template'] ) {
				
				$this->session->set_flashdata('error_message', 'Template is not updated. Please try again.');				
				redirect($this->data['customer_admin']['dashboard_url'].'/templates');
				
			} else {
				
				// update templates
				$update_data['template_id'] = $id;
				$update_data['template_modified'] = date('Y-m-d');
				$update_where = array('id' => $this->data['site_settings']->id);
				$status = $this->Site_settings_model->update_where($update_data, $update_where);
				
				
				if ($status === FALSE)
				{
					$this->session->set_flashdata('error_message', 'Template is not updated. Please try again.');				
					redirect($this->data['customer_admin']['dashboard_url'].'/templates');
				}
				else
				{
					$this->session->set_flashdata('success_message', 'Your new template activated.');		
					redirect($this->data['customer_admin']['dashboard_url'].'/templates');
				}
			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/templates/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function activate($id = null)
	{
		// update templates
		$update_data['template_id'] = $id;
		$update_data['template_request_id'] = NULL;
		$update_data['template_modified'] = date('Y-m-d');
		$update_where = array('id' => $this->data['site_settings']->id);
		$status = $this->Site_settings_model->update_where($update_data, $update_where);
	}
	
	public function add()
	{
		$this->data['page_name'] = 'Add a Template';
		
		$this->data['all_templates'] = $this->Template_model->get();
		
		$config = array(
			'table' => 'templates',
			'id' => 'id',
			'field' => 'slug',
			'title' => 'title',
			'replacement' => 'dash' // Either dash or underscore
		);
		$this->load->library('slug', $config);
		


		// Form Vaidation
		$rules = $this->Template_model->rules;
		$this->form_validation->set_rules($rules);	
		
		// Process the form
		if ($this->form_validation->run() == TRUE) 
		{
			if($this -> input -> post('id')==NULL){$id=NULL;}else{$id = $this -> input -> post('id');}        
			$dataval['name'] = $this -> input -> post('templatename');	
			$tamplatename = $this -> input -> post('templatename');	
			
			$dataval['slug'] = $this->slug->create_uri($tamplatename);
			
			$result = $this->Template_model->save($dataval, $id); 
			redirect($this->data['customer_admin']['dashboard_url'].'/templates');
		}
		else
		{
			$this->session->set_flashdata('errors', validation_errors());
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/templates/templates_add';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function delete($id)
	{
		if($this->_isNotEditable()) {
				
			$this->session->set_flashdata('error_message', $this->lang->line('error_permission_denied'));
			
			redirect($this->data['customer_admin']['dashboard_url'].'/templates/add');
			
		} else {
		
			$this->Template_model->delete($id);
			redirect($this->data['customer_admin']['dashboard_url'].'/templates/add');
		}
	}
	

}