<?php
class MY_Loader extends CI_Loader {
    static $add_data = array();
    public function view($view, $vars = array(), $return = FALSE)
    {
       	$data = array_merge($vars, self::$add_data);
	   
	   	if (method_exists($this, '_ci_object_to_array'))
		{
				return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($data), '_ci_return' => $return));
		} else {
				return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($data), '_ci_return' => $return));
		}
	   
       	//return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array(self::$add_data), '_ci_return' => $return));
    }
}
?>