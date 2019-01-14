<?php
class Customers_model extends MY_Model
{

	protected $_table_name = 'customers';
	protected $_order_by = 'id desc';
	protected $_timestamps = TRUE;
	protected $primary_field = 'id';
	protected $login_field = 'login_name';
	protected $password_field = 'login_password';
	
	public $rules = array(

		'login_name' => array(

			'field' => 'login_name', 

			'label' => 'Login name', 

			'rules' => 'trim|required|xss_clean'

		), 

		'login_password' => array(

			'field' => 'login_password', 

			'label' => 'Password', 

			'rules' => 'trim|required'

		)

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
	
	public function getCustomerBySubdomain($domain_name)
	{
		$customer = $this->get_by(array(
			'subdomain_name' => $domain_name
		), TRUE);
		
		return $customer;
	}
}