<?php
class Widgets extends Admin_Controller

{
	public function __construct ()

	{

		parent::__construct();

		$this->load->model('free/Widget_model');
		$this->load->model('free/Widget_type_model');
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();		
		
	
	}


	public function index ($menu_id = '')
	{
		
		$this->data['page_name'] = 'Widget Lists';
		$this->data['error_message'] = '';		
		
		$this->data['widgets'] = $this->Widget_model->getAssociate();
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/widgets/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	public function create()
	{
		
		$this->data['page_name'] = 'Add Widget';	
		$this->data['error_message'] = '';
		$this->data['widget_types'] = $this->Widget_type_model->get();
		
		if($_POST) {
			
			$rules = $this->Widget_model->rules;
			if($this -> input -> post('widget_type_id') == 5)
				unset($rules['page_limit']);
			$this->form_validation->set_rules($rules);
			
			if ($this -> form_validation -> run() == FALSE)
			{

				$message = validation_errors();
				$this->data['error_message'] = $message;
			}
			else
			{
				
				if(empty($this->data['error_message']))
				{
					
					$data['name'] = $this -> input -> post('name');
					$data['widget_type_id'] = $this -> input -> post('widget_type_id');
					$data['page_limit'] = $this -> input -> post('page_limit');
					$data['disable_in_mobile'] = $this -> input -> post('disable_in_mobile');
					$data['section_title'] = $this -> input -> post('section_title');
					
					$data['content_layout'] = '';
					$data['single_column_content'] = '';
					$data['two_column_content'] = '';
					$data['three_column_content'] = '';
					$data['four_column_content'] = '';
					
					if($data['widget_type_id'] == 5) {
						$data['content_layout'] = $this -> input -> post('content_layout');
						
						if($data['content_layout'] == 'single_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							
						} else if($data['content_layout'] == 'two_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							$data['two_column_content'] = $this -> input -> post('two_column_content');
							
						} else if($data['content_layout'] == 'three_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							$data['two_column_content'] = $this -> input -> post('two_column_content');
							$data['three_column_content'] = $this -> input -> post('three_column_content');
							
						} else if($data['content_layout'] == 'four_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							$data['two_column_content'] = $this -> input -> post('two_column_content');
							$data['three_column_content'] = $this -> input -> post('three_column_content');
							$data['four_column_content'] = $this -> input -> post('four_column_content');
						}
					}
					
					$result= $this->Widget_model->save($data);			
				
					if ($result == FALSE)
					{
						$message = "Something wrong while processing your data. Please try again";
						$this->data['error_message'] = $message;
					}
					else
					{
						$message = "Widget Created Successfully";
						
						$this->session->set_flashdata('success_message', $message);
						redirect($this->data['customer_admin']['dashboard_url'].'/widgets');
					}
				}

			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/widgets/create';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function edit($id)
	{
		
		$this->data['page_name'] = 'Edit Widget';	
		$this->data['error_message'] = '';
		$this->data['widget_types'] = $this->Widget_type_model->get();
		$this->data['widget'] = $this->Widget_model->get($id, TRUE);//print_r($this->data['banner']);
		
		if($this->data['widget']) {
		
			if($_POST) {
			
				$rules = $this->Widget_model->rules;
				$this->form_validation->set_rules($rules);
				
				if ($this -> form_validation -> run() == FALSE)
				{
	
					$message = validation_errors();
					$this->data['error_message'] = $message;
				}
				else
				{
					
					if(empty($this->data['error_message']))
					{
						
						$data['name'] = $this -> input -> post('name');
					$data['widget_type_id'] = $this -> input -> post('widget_type_id');
					$data['page_limit'] = $this -> input -> post('page_limit');
					$data['disable_in_mobile'] = $this -> input -> post('disable_in_mobile');
					$data['section_title'] = $this -> input -> post('section_title');
					
					$data['content_layout'] = '';
					$data['single_column_content'] = '';
					$data['two_column_content'] = '';
					$data['three_column_content'] = '';
					$data['four_column_content'] = '';
					
					if($data['widget_type_id'] == 5) {
						$data['content_layout'] = $this -> input -> post('content_layout');
						
						if($data['content_layout'] == 'single_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							
						} else if($data['content_layout'] == 'two_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							$data['two_column_content'] = $this -> input -> post('two_column_content');
							
						} else if($data['content_layout'] == 'three_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							$data['two_column_content'] = $this -> input -> post('two_column_content');
							$data['three_column_content'] = $this -> input -> post('three_column_content');
							
						} else if($data['content_layout'] == 'four_column') {
							
							$data['single_column_content'] = $this -> input -> post('single_column_content');
							$data['two_column_content'] = $this -> input -> post('two_column_content');
							$data['three_column_content'] = $this -> input -> post('three_column_content');
							$data['four_column_content'] = $this -> input -> post('four_column_content');
						}
					}
						$result= $this->Widget_model->save($data, $id);			
					
						if ($result == FALSE)
						{
							$message = "Something wrong while processing your data. Please try again";
							$this->data['error_message'] = $message;
						}
						else
						{
							$message = "Widget Updated Successfully";
							
							$this->session->set_flashdata('success_message', $message);
							redirect($this->data['customer_admin']['dashboard_url'].'/widgets');
						}
					}
	
				}
			}
			
		} else {
			
			$this->session->set_flashdata('error_message', 'Invalid widget');
			redirect($this->data['customer_admin']['dashboard_url'].'/widgets');
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/widgets/edit';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}

	function get()
	{
		$txt = $this -> input -> post('txt');
		
		$this->data['products'] = $this->Widget_model->getLikeWidgets($txt);
		
		echo '{"view_details": ' . json_encode($this->data['products']) . '}';
	}

	public function delete ($id)
	{
		
		$widget = $this->Widget_model->get($id);
		
		if($widget) {
			
			$this->Widget_model->delete($id);	
			
			$message = "Widget Deleted Successfully";
			$this->session->set_flashdata('success_message', $message);
			$status['status'] = 1;
			echo json_encode($status);
		} else {
			$status['status'] = 0;
			$status['statusmsg'] = "Error: Invalid Widget";
			echo json_encode($status);
		}

	}
	
	public function _unique_widget_type ($str)
	{
		
		if($this->input->post('widget_type_id') == 5)
			return TRUE;
		
		$id = $this -> input -> post('id');
		
		$this->db->where('widget_type_id', $this->input->post('widget_type_id'));

		!$id || $this->db->where('id !=', $id);

		$menu = $this->Widget_model->get();

		if (count($menu)) {

			$this->form_validation->set_message('_unique_widget_type', '%s already exists');

			return FALSE;

		}

		return TRUE;
	}
	
}