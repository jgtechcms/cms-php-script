<?php 
class Enquiry extends Admin_Controller

{

	public function __construct ()

	{

		parent::__construct();

		$this->load->model('free/Contact_model', 'contactm');
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
		
	}



	public function index ()

	{
		
		$this->data['page_name'] = 'Enquiry';
		$this->data['enquiry'] = $this->contactm->get();
		
		// Fetch all pages       

		$this->data['subview'] = $this->data['selected_template_path'].'/enquiry/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	
	public function edit ()

	{
		
		// Validation the form
		$rules = $this->contactm->rules;

		$this->form_validation->set_rules($rules);	
		
		// Process the form

		if ($this -> form_validation -> run() == FALSE)
		{

			$status['status'] = 0;
			$status['statusmsg'] = validation_errors();
			echo json_encode($status);
		}
		else
		{
			
			$id = $this -> input -> post('id');
			$data['name'] = $this -> input -> post('name');
			$data['phone'] = $this -> input -> post('phone');
			$data['email'] = $this -> input -> post('email');
			$data['subject'] = $this -> input -> post('subject');
			$data['message'] = $this -> input -> post('message');
			$data['action_taken'] = $this -> input -> post('action_taken');
			$result=$this->contactm->save($data,$id); 		
			if ($result == FALSE)
			{
				$status['statusmsg'] = "This already exists";
				$status['status'] = 0;
				echo json_encode($status);
			}
			else
			{
				$status['statusmsg'] = "Updated Successfully";
				$status['status'] = 1;
				echo json_encode($status);
			}

		}

	}
	
	
	
	public function get_data()
	{
		$id=$this -> input -> post('id');	
		$this->data['enq'] = $this->contactm->get($id);
		echo '{"view_details": ' . json_encode($this->data['enq']) . '}';
	}


	public function delete ($id)
	{

		$this->contactm->delete($id);
		//redirect('admin/enquiry');
	

	}

}