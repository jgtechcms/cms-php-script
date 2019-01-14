<?php

class User_model extends MY_Model
{	

	protected $_table_name = 'users';
	protected $login_field = 'username';
	protected $password_field = 'password';
	protected $primary_field = 'id';

	public $rules = array(

		'username' => array(

			'field' => 'username', 

			'label' => 'Username', 

			'rules' => 'trim|required|xss_clean'

		), 

		'password' => array(

			'field' => 'password', 

			'label' => 'Password', 

			'rules' => 'trim|required'

		),

	);

	public function __construct ()
	{
		parent::__construct();
	}
	
	public function getTableConfig()
	{		
		$data = array(
			'table_name' => $this->_table_name,
			'primary_field' => $this->primary_field,
			'login_field' => $this->login_field,
			'password_field' => $this->password_field
		);
		return $data;
	}

	public function login ()
	{

		$user = $this->get_by(array(

			'username' => $this->input->post('username'),

			'password' => $this->hash($this->input->post('password')),

		), TRUE);

		

		if (count($user)) {

			// Log in user

			$data = array(

				'username' => $user->username,

				'id' => $user->id,

				'loggedin' => TRUE,

			);

			$this->session->set_userdata($data);

		}

	}

	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}	

	public function get_new(){

		$user = new stdClass();

		$user->name = '';

		$user->email = '';

		$user->password = '';

		return $user;

	}

}