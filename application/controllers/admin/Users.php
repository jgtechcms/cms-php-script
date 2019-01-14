<?php
class Users extends Admin_Controller {

	public function __construct()
    {
        parent::__construct();
		
        $this->load->model('free/User_model', 'Customers_model');
        $this->load->library('form_validation');
		
		// set config
        $this->table_config = $this->Customers_model->getTableConfig();
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
    }
	
	public function index()
	{
		$this->data['page_name'] = 'Customers';
		$this->data['users'] = $this->Customers_model->getCustomersWithOrders();
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/customers/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}

    public function login ($hash_data = null)
	{
		if($hash_data) {
			$this->load->library('encryption');
			$this->encryption->initialize(array(
								'cipher' => 'blowfish',
								'mode' => 'cbc',
								'key' => 'jEvMob',
								'hmac_digest' => 'sha224'
						));
			$hash_data = urldecode($hash_data);
			$hash_data = strtr($hash_data, array('.' => '+', '-' => '=', '~' => '/'));
			$dec_text = $this->encryption->decrypt(
				$hash_data
				);
			
			$user_data = explode('|', $dec_text);//print_r($user_data);exit;
			
			if(count($user_data) == 2) {
				// set post data
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST['username'] = $user_data[0];
				$_POST['password'] = $user_data[1];
			}
		}
		
		$this->load->helper('security');		

		// Set form		
		$rules = $this->Customers_model->rules;

		$this->form_validation->set_rules($rules);		

		// Process form
		if ($this->form_validation->run() == TRUE) {

			// We can login and redirect
			if ($this->auth->login('admin') == TRUE) {
				redirect($this->data['customer_admin']['dashboard_url']);
			}
			else {
				$this->session->set_flashdata('error', 'That Login name/password combination does not exist');
			}

		}		

		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/customers/login';
		$this->load->view($this->data['selected_template_path'].'/_layout_modal', $this->data);
	}
	
	public function logout ()
	{
		$this->auth->logout();
		redirect($this->data['customer_admin']['login_url']);
	}
	
	public function change_password()
	{
		$this->data['page_name'] = 'Change Password';
		
		$this->load->helper('security');		

		// Set form		
		$rules = $this->Customers_model->rules_update_password;

		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE) {

			$id = $this->session->userdata('data')->id;						
			$dataval['password'] = $this->Customers_model->hash($this -> input -> post('password'));			
			$result = $this->Customers_model->save($dataval, $id);
			
			//$this->_clearCacheAll();
			$this->session->set_flashdata('success', 'Password updated successfully');
			redirect($this->data['customer_admin']['dashboard_url'].'/users/change_password');		

		}
		
		$this->data['user'] = $this->Customers_model->get($this->session->userdata('data')->id, TRUE);
		

		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/customers/change_password';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function _current_password ($str)
	{
		
		$id = isset($this->session->userdata('data')->id) ? $this->session->userdata('data')->id : '';
		$dataval['password'] = $this->Customers_model->hash($this -> input -> post('cur_password'));
		$this->db->where('password', $dataval['password']);

		$id || $this->db->where('id =', $id);

		$user = $this->Customers_model->get();

		if (count($user)==0) {
			$this->form_validation->set_message('_current_password', 'Current password is not matched ');
			return FALSE;
		}

		return TRUE;

	}
}