<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cc_detail_model extends MY_Model
{	
	var $data;

	public function __construct ()
	{
		parent::__construct();
		
		$this->data['customer_id'] = CUSTOMER_ID;
		$this->data['renewal_status'] = config_item('renewal_status');
		
	}
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	
	public function getCcDetail()
	{
		$customer_id = $this->data['customer_id'];
				
		$this->db->select('cc_detail.*');
		$this->db->from('cc_detail');
		$this->db->join('customers', 'cc_detail.customer_id = customers.id');
		$this->db->where('cc_detail.customer_id', $customer_id);
		
		$query = $this->db->get();
		return $query->row();
		
	}

}