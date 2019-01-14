<?php
class Pages extends Admin_Controller
{

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('free/Pages_model');
		$this->load->model('free/Menu_model');
		$this->load->model('free/Widget_model');
		$this->load->model('free/Page_widgets_model');
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
		$this->data['error_message'] = '';
	}


	public function index ()
	{
		// unset session for static products
		/*
		if(!$_POST) {
			$this->_resetProductsSession();
			$this->_removeSessionImageFiles();
		}*/
		$this->data['page_name'] = 'Page Content Lists';
		$this->data['pages'] = $this->Pages_model->getRelatedPage();
		$this->data['sub_menu'] = $this->Menu_model->getRelatedMenu();
		$this->data['sub_menu_edit'] = $this->Menu_model->get();

		
			
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/pages/index';

		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	
	function add()
	{
		$this->data['page_name'] = 'Add Page Content';
		$this->data['error_message'] = '';
		
		$this->data['pages'] = $this->Pages_model->getRelatedPage();
		$this->data['sub_menu'] = $this->Menu_model->getRelatedMenu();
		$this->data['sub_menu_edit'] = $this->Menu_model->get();
		
		if(empty($this->data['sub_menu'])) {
			$this->session->set_flashdata('error_message', 'Please create menu and then only you can add page for corresponding menu.');
			redirect($this->data['customer_admin']['dashboard_url'].'/menu/add');
		}
		$this->data['widgets'] = $this->Widget_model->get();
		
		$this->data['product_related_post'] = $this->data['product_related_value'] = array();
		$id=NULL;
		
		// Set up the form
		$rules = $this->Pages_model->rules;
		$this->form_validation->set_rules($rules);	
		// Process the form
		if ($this->form_validation->run() == FALSE and $_POST)
		{
			$this->data['product_related_post'] = $this -> input -> post('product_related');
			$this->data['product_related_value'] = $this -> input -> post('product_related_value');
			
			$this->data['error_message'] = validation_errors();
			
			//$this->session->set_flashdata('error_message', 'Error Found: Please check all the fields are correct');//validation_errors()
		}
		else if ($this->form_validation->run() == TRUE) 
		{
			
			$data['menu_id'] = $this -> input -> post('menu');	
			$data['title'] = $this -> input -> post('title');	
			$data['meta_keywords'] = $this -> input -> post('meta_tag');
			$data['meta_description'] = $this -> input -> post('meta_desc');
			$data['content'] = $this -> input -> post('body_desc');			
			$data['meta_title'] = $this -> input -> post('meta_title');
			$data['h1_title'] = '';//$this -> input -> post('h1_title');
			$page_id = $this->Pages_model->save($data); 
			
			// add related products
			$product_related = $this -> input -> post('product_related');
			$insert_data = array();					
			foreach($product_related as $key => $widget_id) {
				$insert_data[$key] = array('page_id' => $page_id, 'widget_id' => $widget_id, 'order_by' => ($key+1));
			}
			if(!empty($insert_data))
				$this->Page_widgets_model->insert_batch($insert_data);
						
			$message = "Page Created Successfully";
						
			$this->session->set_flashdata('success_message', $message);
			
			redirect($this->data['customer_admin']['dashboard_url'].'/pages');
			
		} else if($_POST) {
			
			$this->data['error_message'] = validation_errors();
		}
		$this->data['product_related'] = array();
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/pages/add';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}

	public function edit ($id)
	{
		$this->data['page_name'] = 'Edit Page Content';
		
		$this->data['pages'] = $this->Pages_model->getRelatedPage();
		$this->data['sub_menu'] = $this->Menu_model->getRelatedMenu();
		$this->data['sub_menu_edit'] = $this->Menu_model->get();
		
		$this->data['page_detail'] = $this->Pages_model->getRelatedPage($id);
		$this->data['widgets'] = $this->Widget_model->get();
		
		$this->data['product_related_post'] = $this->data['product_related_value'] = array();
		
		// Set up the form
		$rules = $this->Pages_model->rules;
		$this->form_validation->set_rules($rules);	
		// Process the form
		if ($this->form_validation->run() == FALSE and $_POST)
		{
			$this->data['product_related_post'] = $this -> input -> post('product_related');
			$this->data['product_related_value'] = $this -> input -> post('product_related_value');
			
			//$this->session->set_flashdata('error_message', 'Error Found: Please check all the fields are correct');//validation_errors()
		}
		else if ($this->form_validation->run() == TRUE) 
		{     
			
			$data['menu_id'] = $this -> input -> post('menu');	
			$data['title'] = $this -> input -> post('title');	
			$data['meta_keywords'] = $this -> input -> post('meta_tag');
			$data['meta_description'] = $this -> input -> post('meta_desc');
			$data['content'] = $this -> input -> post('body_desc');		
			$data['meta_title'] = $this -> input -> post('meta_title');
			$data['h1_title'] = '';//$this -> input -> post('h1_title');
			$page_id = $this->Pages_model->save($data, $id); 
			
			$this->Page_widgets_model->removeProducts($id);
			
			// add related products
			$product_related = $this -> input -> post('product_related');
			$insert_data = array();					
			foreach($product_related as $key => $widget_id) {
				$insert_data[$key] = array('page_id' => $id, 'widget_id' => $widget_id, 'order_by' => ($key+1));
			}
			if(!empty($insert_data))
				$this->Page_widgets_model->insert_batch($insert_data);
						
			$message = "Page Updated Successfully";
			
			$this->session->set_flashdata('success_message', $message);
			
			redirect($this->data['customer_admin']['dashboard_url'].'/pages');
		}
		
		$this->data['product_related'] = array();
		$this->data['product_related'] = $this->Page_widgets_model->getRelatedWidgets($id);
		$this->data['id'] = $id;
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/pages/edit';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	
	public function get_pages()
	{
		
		$id = $this -> input -> post('id');	
		$page = $this->Pages_model->getRelatedPage($id);
		
		echo '{"view_details": ' . json_encode($page) . '}';
		// echo '<pre>'.$this->db->last_query().'</pre>';
	
	}


	public function delete ($id)
	{		
		$this->session->set_flashdata('success_message', 'Page Deleted Successfully');
		$this->Pages_model->delete($id);
        $status['status'] = 1;
		echo json_encode($status);
	}



	public function _unique_menu ($str)
	{

		// Do NOT validate if slug already exists

		// UNLESS it's the slug for the current page


		$id = $this -> input -> post('id');//echo $str;exit;
		
		$this->db->where('menu_id', $str);

		!$id || $this->db->where('id !=', $id);

		$menu = $this->Pages_model->get();

		

		if (count($menu)) {

			$this->form_validation->set_message('_unique_menu', '%s should be unique');

			return FALSE;

		}

		

		return TRUE;

	}
	

}