<?php
class Menu_type extends Admin_Controller
{

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('free/Menu_type_model');
		
		$this->data = $this->data_common;//echo '<pre>';print_r($this->data);echo '</pre>';exit;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();

	}



	public function index ()

	{
		// Fetch all pages


		$this->data['menu_type'] = $this->Menu_type_model->get();

		// Load view

		$this->data['subview'] = $this->data['selected_template_path'].'/menu_type/index';

		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	public function get_menu_type(){
		
		$id=$this -> input -> post('id');	
		$this->data['menu_type'] = $this->Menu_type_model->get($id);
		echo '{"view_details": ' . json_encode($this->data['menu_type']) . '}';
		// echo '<pre>'.$this->db->last_query().'</pre>';
	
	}



	function add()
	{
		// Validation the form
		$this -> form_validation -> set_rules('title', 'Enter Menu title', 'required|trim|xss_clean');

		if ($this -> form_validation -> run() == FALSE)
		{

			$status['status'] = 0;
			$status['statusmsg'] = validation_errors();
			echo json_encode($status);
		}
		else
		{
			$data['title'] = $this -> input -> post('title');	
			
			$result= $this->Menu_type_model->save($data);			
		
			if ($result == FALSE)
			{
				$status['statusmsg'] = "This is already exists";
				$status['status'] = 0;
				echo json_encode($status);
			}
			else
			{
				$status['statusmsg'] = "Created Successfully";
				$status['status'] = 1;
				echo json_encode($status);
			}

		}

	}



	public function edit ()

	{
		// Validation the form
		$this -> form_validation -> set_rules('title', 'Enter Menu title', 'required|trim|xss_clean');
		
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
			$data['title'] = $this -> input -> post('title');
			$result=$this->Menu_type_model->save($data, $id); 		
		
			if ($result == FALSE)
			{
				$status['statusmsg'] = "This leads already exists";
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

		/*if ($this->form_validation->run() == TRUE) {
			
			$id = $this -> input -> post('id');
			$data['title'] = $this -> input -> post('title');
			$this->page_m->save($data, $id);          

		}*/


	}



	public function delete ($id)

	{

		$this->Menu_type_model->delete($id);
		//redirect($this->data['customer_admin']['dashboard_url'].'/menu_type');	

	}


}