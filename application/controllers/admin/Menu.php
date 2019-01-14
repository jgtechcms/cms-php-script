<?php 
class Menu extends Admin_Controller
{

	public function __construct ()
	{

		parent::__construct();

		$this->load->model('free/Menu_model');
		$this->load->model('free/Menu_type_model');
		$this->load->model('free/Pagetype_model');
		$this->load->model('free/User_menu_model');
		$this->data = $this->data_common;//echo '<pre>';print_r($this->data);echo '</pre>';exit;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();

	}


	public function index ()
	{
		// Fetch all pages
		$this->data['page_name'] = 'Menu Lists';
        
		$this->data['menu'] = $this->Menu_model->get();
		$this->data['page_types'] = $this->Pagetype_model->get_by(array('status' => 1));
		

		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/menu/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	private function _get_menu($id){
		
		$this->db->select('menu.*,user_menu.menu_type_id');
		$this->db->from('menu');
		$this->db->where('menu.id', $id);
		$this->db->join('user_menu', 'menu.id = user_menu.menu_id', 'left');
		$query = $this->db->get();
		$result = $query->result();
		$return = array();
		$m_t_id = '';
		$sep = '';
		foreach ($result as $row)
		{
			if(empty($return)) {				
				$return['id'] = $row->id;
				$return['title'] = $row->title;
				$return['slug'] = $row->slug;
				$return['page_type'] = $row->page_type;
				$return['order_by'] = $row->order_by;
				$return['parent_id'] = $row->parent_id;
				//$return['fa_icon_value'] = $row->fa_icon_value;
				/*$return['is_home'] = $row->is_home;
				$return['is_contact'] = $row->is_contact;
				$return['is_product'] = $row->is_product;*/
			}
			$m_t_id .= $sep . $row->menu_type_id;
			$sep = ',';
		}
		$return['m_t_id'] = $m_t_id;
		//print_r($result);exit;
		//$this->data['menu'] = $this->Menu_model->get($id); 
		return json_encode($return);
	
	}
	
	function process_add()
	{
		
		// Validation the form
		$this -> form_validation -> set_rules('m_t_id[]', 'Menu Type', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('title', 'Menu title', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('slug', 'Slug', 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean');


		if ($this -> form_validation -> run() == FALSE)
		{

			$status['status'] = 0;
			$status['statusmsg'] = validation_errors();
			echo json_encode($status);
		}
		else
		{
			// save menu table
			$data_menu['parent_id'] = $this -> input -> post('parent_id');
			$data_menu['title'] = $this -> input -> post('title');
			$data_menu['slug'] = $this -> input -> post('slug');
			//$data_menu['page_type_id'] = config_item('page_types')['dynamic'];//$this -> input -> post('page_type_id');	
			$data_menu['order_by'] = $this -> input -> post('order_by');
			$data_menu['page_type'] = $this -> input -> post('dynamic_page_type');
			//$data_menu['fa_icon_value'] = $this -> input -> post('fa_icon_value');

			// dynamic page type
			$dynamic_page_type_selected = $this -> input -> post('dynamic_page_type');			
			if($dynamic_page_type_selected != 'other') {
				$this->Menu_model->resetPageType($dynamic_page_type_selected);
			}
			
			$menu_id = $this->Menu_model->save($data_menu);			
			
			// save user_menu table
			$m_t_id = $this -> input -> post('m_t_id');
			foreach($m_t_id as $m_id) {
				$data_user_menu['menu_type_id'] = $m_id;
				$data_user_menu['menu_id'] = $menu_id;
				$this->User_menu_model->save($data_user_menu);
			}
		
			if ($menu_id == FALSE)
			{
				$status['statusmsg'] = "Error: There is a problem while processing your data";
				$status['status'] = 0;
				echo json_encode($status);
			}
			else
			{
				$status['statusmsg'] = "Menu Created Successfully";
				$status['status'] = 1;
				$this->session->set_flashdata('success_message', $status['statusmsg']);
				echo json_encode($status);
			}

		}
	}


	function add()
	{
		$this->data['page_name'] = 'Add Menu';
		
		$this->data['menu_type'] = $this->Menu_type_model->get();
		$this->data['page_types'] = $this->Pagetype_model->get_by(array('status' => 1));
		$this->data['menu'] = $this->Menu_model->get();
		$this->data['sub_menu'] = $this->data['sub_menus'] = $this->data['menu'];
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/menu/add';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}

	public function edit ($id)
	{
		$this->data['page_name'] = 'Edit Menu';
		
		$this->data['menu_type'] = $this->Menu_type_model->get();
		$this->data['page_types'] = $this->Pagetype_model->get_by(array('status' => 1));
		$this->data['menu'] = $this->Menu_model->get();
		$this->data['sub_menu'] = $this->data['sub_menus'] = $this->data['menu'];
		
		$this->data['menu_detail'] = $this->_get_menu($id);
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/menu/edit';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}

	public function process_edit ()
	{
		// Validation the form
		$this -> form_validation -> set_rules('m_t_id[]', 'Choose Menu Type', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('title', 'Enter Menu title', 'required|trim|xss_clean');
		$this -> form_validation -> set_rules('slug', 'Enter a url', 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean');
		$this -> form_validation -> set_rules('order_by', 'Order', 'required|trim|numeric|xss_clean');
		
		// Process the form
		if ($this -> form_validation -> run() == FALSE)
		{

			$status['status'] = 0;
			$status['statusmsg'] = validation_errors();
			echo json_encode($status);
		}
		else
		{
			
			// save menu table
			$id = $this -> input -> post('id');	
			$data_menu['parent_id'] = $this -> input -> post('parent_id');
			$data_menu['title'] = $this -> input -> post('title');
			$data_menu['slug'] = $this -> input -> post('slug');		
			//$data_menu['page_type_id'] = config_item('page_types')['dynamic'];//$this -> input -> post('page_type_id');
			$data_menu['order_by'] = $this -> input -> post('order_by');		
			$data_menu['page_type'] = $this -> input -> post('dynamic_page_type');
			//$data_menu['fa_icon_value'] = $this -> input -> post('fa_icon_value');
			
			// dynamic page type
			$dynamic_page_type_selected = $this -> input -> post('dynamic_page_type');			
			if($dynamic_page_type_selected != 'other') {
				$this->Menu_model->resetPageType($dynamic_page_type_selected);
			}
			
			$menu_id = $this->Menu_model->save($data_menu, $id);			
			
			// delete existing records on user_menu
			$delete_where = array('menu_id' => $id);
			$this->User_menu_model->delete_menu($delete_where);
			// save user_menu table
			$m_t_id = $this -> input -> post('m_t_id');
			foreach($m_t_id as $m_id) {
				$data_user_menu['menu_type_id'] = $m_id;
				$data_user_menu['menu_id'] = $menu_id;
				$this->User_menu_model->save($data_user_menu);
			}
		
			if ($menu_id == FALSE)
			{
				$status['statusmsg'] = "Error: There is a problem while processing your data";
				$status['status'] = 0;
				echo json_encode($status);
			}
			else
			{
				$status['statusmsg'] = "Menu Updated Successfully";
				$status['status'] = 1;
				echo json_encode($status);
			}

		}
	}


	public function delete ($id)
	{

		$this->Menu_model->delete($id);	
		
		$status['statusmsg'] = "Menu Deleted Successfully";
		$this->session->set_flashdata('success_message', "Menu Deleted Successfully");
		$status['status'] = 1;
		echo json_encode($status);

	}
	
	public function _unique_slug ($str)

	{

		// Do NOT validate if email already exists

		// UNLESS it's the email for the current user
		
		$id = $this -> input -> post('id');
		
		$this->db->where('slug', $this->input->post('slug'));

		!$id || $this->db->where('id !=', $id);

		$menu = $this->Menu_model->get();

		

		if (count($menu)) {

			$this->form_validation->set_message('_unique_slug', '%s should be unique');

			return FALSE;

		}

		

		return TRUE;

	}

}