<?php 
class Social_media extends Admin_Controller
{

	public function __construct ()

	{

		parent::__construct();

		$this->load->model('free/Social_media_model');
		$this->data = $this->data_common;
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
		
	}



	public function index ()
	{
		
		$this->data['page_name'] = 'Social Media';
		$this->data['social_medias'] = $this->Social_media_model->get();
		$this->data['error_message'] = '';
		
		if($_POST) {
			
			$id = NULL;
			if( $this -> input -> post('id') ) 
				$id = $this -> input -> post('id');
			
			$social_icon_folder = $this->config->item('social_icon_folder');
			$folder_permission = $this->config->item('folder_permission');
			$customer_social_icon_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $social_icon_folder;
			
			// Validation the form
			$rules = $this->Social_media_model->rules;
			$this->form_validation->set_rules($rules);
			
			if ($this -> form_validation -> run() == FALSE)
			{

				$message = validation_errors();
				$this->data['error_message'] = $message;
			}
			else
			{
				
				if(empty($this->data['error_message']))
				{
					
					$data['name'] = $this -> input -> post('name');
					$data['url'] = $this -> input -> post('url');
					$data['status'] = $this -> input -> post('status');
					$data['icon'] = $this -> input -> post('icon');
					$result= $this->Social_media_model->save($data, $id);			
				
					if ($result == FALSE)
					{
						$message = "Error: There is a problem while processing your data";
						$this->data['error_message'] = $message;
					}
					else
					{
						$message = "Social Media Created Successfully";
						if($id)
							$message = "Social Media Updated Successfully";
						$this->session->set_flashdata('success_message', $message);
						redirect($this->data['customer_admin']['dashboard_url'].'/social_media');
					}
				}

			}
		}
		$error_message = $this->session->flashdata('error_message');
		if($error_message)
			$this->data['error_message'] = $error_message;

		$this->data['subview'] = $this->data['selected_template_path'].'/social_media/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	
	
	public function get_data()
	{

		$social_icon_folder = $this->config->item('social_icon_folder');
		$customer_social_icon_folder = $this->config->item('customer_source_url') . '/' . $social_icon_folder . '/';
		
		$id = $this -> input -> post('id');	
		$this->data['media'] = $this->Social_media_model->get($id);
		$this->data['media']->icon_thumb = $customer_social_icon_folder . $this->data['media']->icon;
		echo '{"view_details": ' . json_encode($this->data['media']) . '}';
	}


	public function delete ($id)
	{

		$social_icon_folder = $this->config->item('social_icon_folder');
		$customer_social_icon_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $social_icon_folder . DIRECTORY_SEPARATOR;
		
		$media = $this->Social_media_model->get($id);
		
		if($media) {
			
			$this->Social_media_model->delete($id);
			
			$message = "Social Media Deleted Successfully";
			$this->session->set_flashdata('success_message', $message);
			redirect($this->data['customer_admin']['dashboard_url'].'/social_media');
		} else {
			$this->session->set_flashdata('error_message', 'Invalid Social Media');
			redirect($this->data['customer_admin']['dashboard_url'].'/social_media');
		}
	

	}

}