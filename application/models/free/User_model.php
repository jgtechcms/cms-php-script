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
	
	public $rules_register = array(

		'name' => array(

			'field' => 'name', 

			'label' => 'Name', 

			'rules' => 'trim|required|xss_clean'

		), 

		'email' => array(

			'field' => 'email', 

			'label' => 'Email', 

			'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'

		), 

		'username' => array(

			'field' => 'username', 

			'label' => 'Username', 

			'rules' => 'trim|required|callback__unique_username|xss_clean'

		), 

		'password' => array(

			'field' => 'password', 

			'label' => 'Password', 

			'rules' => 'trim|required'

		),

	);
	
	public $rules_update = array(

			'name' => array(

				'field' => 'name', 

				'label' => 'Name', 

				'rules' => 'trim|required|xss_clean'

			), 

			'email' => array(

				'field' => 'email', 

				'label' => 'Email', 

				'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'

			), 

			/*'username' => array(

				'field' => 'username', 

				'label' => 'Username', 

				'rules' => 'trim|required|callback__unique_username|xss_clean'

			), */

		);

		public $rules_update_password = array(

			'cur_password' => array(

				'field' => 'cur_password', 

				'label' => 'Current Password', 

				'rules' => 'trim|required|callback__current_password|xss_clean'

			), 

			'new_password' => array(

				'field' => 'new_password', 

				'label' => 'New password', 

				'rules' => 'trim|required|xss_clean'

			), 
			'password' => array(

				'field' => 'password', 

				'label' => 'Confirm Password', 

				'rules' => 'trim|required|matches[new_password]|xss_clean'

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
	
	public function save_data()
	{
		$dataval['user_type'] = config_item('user_type')['user'];
		$dataval['name'] = $this -> input -> post('name');	
		$dataval['email'] = $this -> input -> post('email');		   
		$dataval['username'] = $this -> input -> post('username');			
		$dataval['password'] = $this->hash($this -> input -> post('password'));			
		$dataval['created'] = date('Y-m-d H:i:s');			
		$result = $this->save($dataval);
		
		if($result)
			$result = $dataval;
		
		return $result;
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
	
	public function getCustomersWithOrders()
	{
		$this->db->select('users.*, order_summary.ord_order_number');
		$this->db->from('users');
		$this->db->where('users.user_type', config_item('user_type')['user']);
		$this->db->join('order_summary', 'users.id = order_summary.ord_user_fk', 'left');//echo $this->db->get_compiled_select();
		$query = $this->db->get();
		return $query->result();
	}

}