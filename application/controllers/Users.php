<?php
class Users extends Front_Controller {

	public function __construct()
    {
        parent::__construct();
		
        $this->load->model('free/User_model', 'Customers_model');
        $this->load->library('form_validation');	

		
		// Orders
		$this->data = $this->data_common;
		
		// set config
        $this->table_config = $this->Customers_model->getTableConfig();
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
		
    }

    public function login ()
	{
		$this->load->helper('security');		

		// Set form		
		$rules = $this->Customers_model->rules;

		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE) {

			// We can login and redirect
			if ($this->auth->login('user') == TRUE) {				
				
				redirect($this->data['dashborrd']['profile_url']);
			}
			else {
				$this->session->set_flashdata('error', 'That Login name/password combination does not exist');
			}

		}

		$this->define_common_component();
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Login';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$breadcrumb_lists[] = (object) ['title' => 'Login', 'slug' => ''];
		$this->data['breadcrumb_lists'] = $breadcrumb_lists;

		// Load view
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/login',$this->data);
	}

    public function register ()
	{
		$this->load->helper('security');		

		// Set form		
		$rules = $this->Customers_model->rules_register;

		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE) {
			
			$result = $this->Customers_model->save_data();
			
			if($result) {
				$subject = 'Welcome to [SITE_TITLE]';
				$this->_send_mail($result, 'register', $subject);
			}
			
			$this->_clearCacheAll();
				
			$this->session->set_flashdata('reg_succes', '<p style="color:#65AE17;text-align:center;">Registered successfully <br/>Login to continue...</p>');
			redirect($this->data['dashborrd']['login_url']);

		}
		
		$this->define_common_component();
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Register';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$breadcrumb_lists[] = (object) ['title' => 'Signup', 'slug' => ''];
		$this->data['breadcrumb_lists'] = $breadcrumb_lists;

		// Load view
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/register',$this->data);
	}
	
	public function profile()
	{
		$this->load->helper('security');		

		// Set form		
		$rules = $this->Customers_model->rules_update;

		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE) {

			$id = $this->session->userdata('data')->id;
			
			$dataval['name'] = $this -> input -> post('name');	
			$dataval['email'] = $this -> input -> post('email');		   
			//$dataval['username'] = $this -> input -> post('username');			
			//$dataval['password'] = $this->Customers_model->hash($this -> input -> post('password'));			
			$result = $this->Customers_model->save($dataval, $id);
			
			$this->_clearCacheAll();
			$this->session->set_flashdata('success', 'Profile updated successfully');
			redirect($this->data['dashborrd']['profile_url']);		

		}
		
		$this->data['user'] = $this->Customers_model->get($this->session->userdata('data')->id, TRUE);
		
		$this->define_common_component();
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Profile';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$breadcrumb_lists[] = (object) ['title' => 'Profile', 'slug' => ''];
		$this->data['breadcrumb_lists'] = $breadcrumb_lists;

		// Load view
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/profile',$this->data);
	}
	public function change_password()
	{
		$this->load->helper('security');		

		// Set form		
		$rules = $this->Customers_model->rules_update_password;

		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE) {

			$id = $this->session->userdata('data')->id;						
			$dataval['password'] = $this->Customers_model->hash($this -> input -> post('password'));			
			$result = $this->Customers_model->save($dataval, $id);
			
			$this->_clearCacheAll();
			$this->session->set_flashdata('success', 'Password updated successfully');
			redirect($this->data['dashborrd']['change_password_url']);		

		}
		
		$this->data['user'] = $this->Customers_model->get($this->session->userdata('data')->id, TRUE);
		
		$this->define_common_component();
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Change Password';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$breadcrumb_lists[] = (object) ['title' => 'Change Password', 'slug' => ''];
		$this->data['breadcrumb_lists'] = $breadcrumb_lists;

		// Load view
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/change_password',$this->data);
	}
	
	public function forgot_password()
	{
		$this->define_common_component();
		
		$this->data['error_message'] = '';
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[125]');

		if ($this->form_validation->run() == FALSE) {
			
		  //$this->data['error_message'] = validation_errors();
		  
		} else {
		 
			$email = $this->input->post('email');
			
			$user = $this->Customers_model->get_by(array('email' => $email), TRUE);

			if ( count($user) == 1) {
				
				$this->load->helper('string');
				$code = strtolower(random_string('alnum', 15));
				
				$data = array(
				  'forgot_password_code' => $code,
				);
				
				$is_updated = $this->Customers_model->update($data, $user->id);

				if ( $is_updated ) {
					
					// send email
					$mail_data['email'] = $email;
					$mail_data['name'] = $user->name;
					$mail_data['url'] = site_url().'users/new-password/'.$code;
					$subject = '[SITE_TITLE] - Reset Password';
					$mail_sent = $this->_send_mail($mail_data, 'reset_password', $subject);
					
					if ( $mail_sent ) {
						
						$this->session->set_flashdata('success_message', 'An email has been sent to the address provided.');
						redirect('users/forgot-password');
						
					} else {
						
						$this->data['error_message'] = 'Email not sent. Please try again.';
					}
					
				} else {
					
					$this->data['error_message'] = 'Something went wrong whilr processing your data. Please try again.';
				}
				
			} else {
				
				$this->data['error_message'] = 'Email id is not exists.';// Click <a href="'.site_url().'users/register">here</a> to register with us.
			}
		}
		
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Forgot Password';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$breadcrumb_lists[] = (object) ['title' => 'Forgot Password', 'slug' => ''];
		$this->data['breadcrumb_lists'] = $breadcrumb_lists;
		
		// Load view
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/forgot_password',$this->data);
	}
	
	public function new_password($code = '')
	{
		
		$this->define_common_component();
		
		$this->data['error_message'] = '';
		$this->data['error_code'] = '';
		
		if($code) {
			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[5]|max_length[125]');
			$this->form_validation->set_rules('new_password', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('confirm_password', 'Confirmation Password', 'required|min_length[5]|matches[new_password]');
			
			// Get Code from URL and clean up
			$code = xss_clean($code);
			
			$condition = array('forgot_password_code' => $code);
			
			// code validation
			$user = $this->Customers_model->get_by($condition, TRUE);
			
			if ( count($user) == 1) {
			
				if ($this->form_validation->run() == TRUE) {
					
					
					$condition['email'] = $this->input->post('email');
					
					// check if code is valid or not
					$user = $this->Customers_model->get_by($condition, TRUE);

					if ( count($user) == 1) {

						if ($this->form_validation->run() == TRUE) {
							
							$id = $user->id;						
							$dataval['password'] = $this->Customers_model->hash($this -> input -> post('new_password'));
							$dataval['forgot_password_code'] = '';
							$result = $this->Customers_model->save($dataval, $id);
							
							if ( $result ) {
									
								$this->session->set_flashdata('reg_succes', 'Password updated successfully.');
								
								$user_type = $this->config->item('user_type');
								$customer_admin = $this->config->item('customer_admin');
								
								$login_url = 'users/login';
								if( $user->user_type == $user_type['admin'] )
									$login_url = $customer_admin['login_url'];
								
								redirect($login_url);
								
							} else {
								
								$this->data['error_message'] = 'Something went wrong while processing your data. Please try again.';
							}
						}
					} else {
						$this->data['error_code'] = 'yes';
						$this->data['error_message'] = 'Invalid code.';
					}
				}
			} else {
				$this->data['error_code'] = 'yes';
				$this->data['error_message'] = 'Invalid code.';
			}
		} else {
			$this->data['error_code'] = 'yes';
			$this->data['error_message'] = 'Invalid code.';
		}
		
		
		// meta detail
		$meta_obj = new stdClass;
		$meta_obj->title = 'Reset Password';
		$meta_obj->meta_keywords = '';
		$meta_obj->meta_description = '';
		$meta_obj->content = '';
		$this->data['page'] = $meta_obj;
		
		$breadcrumb_lists[] = (object) ['title' => 'Reset Password', 'slug' => ''];
		$this->data['breadcrumb_lists'] = $breadcrumb_lists;
		
		// Load view
		$this->load->view($this->data['selected_template_path'].'/'.$this->data['user_template'].'/new_password',$this->data);
	}	
	
	public function logout ()
	{
		$this->auth->logout();
		$this->_clearCacheAll();
		redirect($this->data['dashborrd']['login_url']);
	}
	
	public function _unique_username ($str)
	{
		
		$id = isset($this->session->userdata('data')->id) ? $this->session->userdata('data')->id : '';
		
		$this->db->where('username', $this->input->post('username'));

		!$id || $this->db->where('id !=', $id);

		$user = $this->Customers_model->get();

		if (count($user)) {

			$this->form_validation->set_message('_unique_username', 'Username already exists');
			return FALSE;

		}

		return TRUE;

	}
	
	public function _unique_email ($str)
	{
		
		$id = isset($this->session->userdata('data')->id) ? $this->session->userdata('data')->id : '';
		
		$this->db->where('email', $this->input->post('email'));

		!$id || $this->db->where('id !=', $id);

		$user = $this->Customers_model->get();

		if (count($user)) {

			$this->form_validation->set_message('_unique_email', 'Email id already exists');
			return FALSE;

		}

		return TRUE;

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