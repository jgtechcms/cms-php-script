<?php
class MY_Input extends CI_Input {	

	 function save_query($query_array) {		
		$CI =& get_instance();		
		$tt= http_build_query($query_array);
		$CI->db->insert('ci_query', array('query_string' =>  html_entity_decode($tt)));
	
		return $CI->db->insert_id();
	}
	
	 function load_query($query_id) {
		
		$CI =& get_instance();
		
		$rows = $CI->db->get_where('ci_query', array('id' => $query_id))->result();
		if (isset($rows[0])) {
			parse_str($rows[0]->query_string, $_GET);		
		}
		
	}
	
}