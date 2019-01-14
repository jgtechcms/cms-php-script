<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {
	
	public function __construct() {
		$this->CI =& get_instance();

		$this->CI->load->model('auth_model');
		$this->CI->load->library('session');
	}

	public function login ($usertype) {
		$this->CI->auth_model->setTableConfig($this->CI->table_config);
		$user = $this->CI->auth_model->getLoginDetail($usertype);		

		if (count($user)) {

			// Log in user
			$data = array(
				'username' 	=> isset($user->username) ? $user->username : '',
				//'email' 	=> $user->email,
				'id' 		=> $user->id,
				'loggedin' 	=> TRUE,
				'data'		=> $user,
				'usertype'	=> $usertype
			);

			$this->CI->session->set_userdata($data);
			return true;
		}
		return false;
	}
	
	public function login_app () {
		$this->CI->auth_model->setTableConfig($this->CI->table_config);
		$user = $this->CI->auth_model->getLoginDetail('user');

		if (count($user)) {
			
			unset($user->password);
			
			return $user;
		}
		return false;
	}

	public function logged_in($user_type = 'user') {
		$loggedin = $this->CI->session->userdata('loggedin');		
		$usertype = $this->CI->session->userdata('usertype');
		
		if($loggedin and $user_type == $usertype)
			return true;
		return false;
	}

	public function logout() {

		// Destroy the session
		//$this->CI->session->sess_destroy();
		$data = array(
			'username', 'id', 'loggedin', 'data'
		);
		$this->CI->session->unset_userdata($data);

	}
}