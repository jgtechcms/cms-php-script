<?php
class Custom_model extends MY_Model
{

	protected $_table_name;

	protected $_order_by;
	
	function setParam($tbl, $order_by)
	{
		$this->_table_name = $tbl;
		
		$this->_order_by = $order_by;
	}

}