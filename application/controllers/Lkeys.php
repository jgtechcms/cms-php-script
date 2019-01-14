<?php

class Lkeys extends Front_Controller {



    public function __construct(){

        parent::__construct();		
		
		$this->data = $this->data_common;
	}
	
	public function update()
	{
		if($_POST) {
			
			$this -> form_validation -> set_rules('lkey', 'Key', 'required|trim|max_length[20]|xss_clean');
			
			if ($this->form_validation->run() == TRUE) 
			{				
				$dataval['lkey'] = $this -> input -> post('lkey');
				
				$domain_name = 'lcalhost';
				if(defined('DOMAIN_WO_WWW'))
					$domain_name = DOMAIN_WO_WWW;
				
				// generate licence key
				$dataval['gen_key'] = $this->Site_settings_model->hash($domain_name.$dataval['lkey']);
				
				$this->Site_settings_model->update($dataval, $this->data['site_settings']->id); 
				
				$message = "Updated Successfully";
				$this->session->set_flashdata('success_message', $message);
				
				redirect('lkeys/update', 'refresh');
			}
		}
		
		$this->load->view('key_update',$this->data);
	}
}