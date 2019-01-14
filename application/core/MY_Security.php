<?php

class MY_Security extends CI_Security {
    
	function __construct()
    {
        parent::__construct();
    }
 
 
    function csrf_verify()
    {
        
		$http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
		if(empty($http_host))
			$http_host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
		if(empty($http_host))
			$http_host = 'www.jgtech.in';
		
		$base_url = HTTP . '://' . $http_host;
		
		$path_segments = explode('/', $_SERVER['PHP_SELF']);
		$controller_segment_pos = 1;
		foreach($path_segments as $i => $segment) {
			
			$base_url .= $segment . '/';
			
			if($segment == 'index.php') {
				$controller_segment_pos = $i+1;
				break;
			}
		}
		$controller = isset($path_segments[$controller_segment_pos]) ? $path_segments[$controller_segment_pos] : $path_segments[1];
		$method = isset($path_segments[$controller_segment_pos+1]) ? $path_segments[$controller_segment_pos+1] : $path_segments[2];
		
		$exception_arr = array('login', 'register','response');
		$bypass = FALSE;

		if ( $controller == 'api' ) {
			$bypass = TRUE;
		} else if ( $controller == 'products' and in_array($method, $exception_arr) ) {
			$bypass = TRUE;
		}

		if ( ! $bypass) {
			parent::csrf_verify();
		}
    }
}