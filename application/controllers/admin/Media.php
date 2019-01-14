<?php
class Media extends Admin_Controller

{
	public function __construct ()

	{

		parent::__construct();

        $this->load->model('free/Banner_model', 'banner_m');
		$this->load->model('free/Gallery_model', 'gallery_m');
		$this->load->model('free/Gallery_images_model', 'gallery_images_m');
		$this->load->model('free/Pages_model', 'pagem');
		$this->load->model('free/Menu_model');
		$this->data = $this->data_common;
		$this->load->model('free/Gallery_images_model', 'galleryimages_m');
		$this->data['current_page'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();		
		
	
	}


// Banner Functions Start//	

	public function index ($menu_id = '')
	{
		
		$this->data['page_name'] = 'Slider Lists';
		$banner_folder = $this->config->item('banner_folder');
		$folder_permission = $this->config->item('folder_permission');
		$this->data['customer_banner_url'] = $this->config->item('customer_source_url') . '/' . $banner_folder . '/';
		
		// Fetch all pages
		$this->data['menus'] = $this->Menu_model->get();
		
		if(!$menu_id) {
			$menu_id = isset($this->data['menus'][0]) ? $this->data['menus'][0]->id : '';
		}
		$this->data['menu_id'] = $menu_id;
		$this->data['error_message'] = '';
		
		$this->data['banners'] = $this->banner_m->get_by(array('menu_id' => $menu_id));
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/index';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	public function add_banner()
	{
		
		$this->data['page_name'] = 'Add Slider Image';	
		$this->data['error_message'] = '';
		$this->data['menus'] = $this->Menu_model->get();
		
		if($_POST) {
		
			$banner_folder = $this->config->item('banner_folder');
			$folder_permission = $this->config->item('folder_permission');
			$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder;
			
			if (!is_dir($customer_banner_folder))
			{
				@mkdir($customer_banner_folder, $folder_permission, true);
			}
			$customer_banner_folder .= DIRECTORY_SEPARATOR;
			
			
			if( isset($this->data['err_post_content_length']) ) {
				
				$this->data['error_message'] = $this->data['err_post_content_length'] . ' Please upload image within the given size.';
			
			} else if (!empty($_FILES)) {
				
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = time().strtolower($_FILES['file']['name']);
				
				$uploadary_bimage['upload_path'] = $customer_banner_folder;
				$uploadary_bimage['file_name'] = $fileName;
				$uploadary_bimage['allowed_types'] = $this->config->item('allowed_types');
				$uploadary_bimage['min_width']     = config_item('banner_min_width');
				//$uploadary_bimage['min_height']    = config_item('banner_height');
				$uploadary_bimage['max_width']     = config_item('banner_width');
				$uploadary_bimage['max_size']    = config_item('banner_size');
				
				//Load upload library and initialize configuration
				$this->load->library('upload',$uploadary_bimage);
				$this->upload->initialize($uploadary_bimage);
				
				if($this->upload->do_upload('file')) {
					
					$uploadData_logo = $this->upload->data();
					$fileName = $uploadData_logo['file_name'];
					
					$data = array('banner_image'=>$fileName, 'menu_id'=>$this->input->post('menu_id'), 'description'=>$this->input->post('description'));
					$file_id = $this->banner_m->save($data);
					$message = "Banner Added Successfully";
										
					$this->session->set_flashdata('success_message', $message);
					redirect($this->data['customer_admin']['dashboard_url'].'/media/index/'.$this->input->post('menu_id'));
					
				} else {
					$this->data['error_message'] = $this->upload->display_errors();
					//$return['msg'] = 'File not uploaded. Please try again.';
				}
				
			} else {
				
				$this->data['error_message'] = 'Image is required';
			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/add_banner';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	public function edit_banner($id)
	{
		
		$this->data['page_name'] = 'Edit Slider Image';	
		$this->data['error_message'] = '';
		$this->data['menus'] = $this->Menu_model->get();
		$this->data['banner'] = $this->banner_m->get($id, TRUE);//print_r($this->data['banner']);
		
		if($this->data['banner']) {
		
			if($_POST) {
			
				$banner_folder = $this->config->item('banner_folder');
				$folder_permission = $this->config->item('folder_permission');
				$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder;
				
				$data = array();
				
				if (!is_dir($customer_banner_folder))
				{
					@mkdir($customer_banner_folder, $folder_permission, true);
				}
				$customer_banner_folder .= DIRECTORY_SEPARATOR;
				
				
				if( isset($this->data['err_post_content_length']) ) {
					
					$this->data['error_message'] = $this->data['err_post_content_length'] . ' Please upload image within the given size.';
				
				} else if (!empty($_FILES['file']['tmp_name'])) {
					
					// delete existing
					if( is_file($customer_banner_folder . $this->data['banner']->banner_image) )
						unlink($customer_banner_folder . $this->data['banner']->banner_image);
					
					$tempFile = $_FILES['file']['tmp_name'];
					$fileName = time().strtolower($_FILES['file']['name']);
					
					$uploadary_bimage['upload_path'] = $customer_banner_folder;
					$uploadary_bimage['file_name'] = $fileName;
					$uploadary_bimage['allowed_types'] = $this->config->item('allowed_types');
					$uploadary_bimage['min_width']     = config_item('banner_min_width');
					//$uploadary_bimage['min_height']    = config_item('banner_height');
					$uploadary_bimage['max_width']     = config_item('banner_width');
					$uploadary_bimage['max_size']    = config_item('banner_size');
					
					//Load upload library and initialize configuration
					$this->load->library('upload',$uploadary_bimage);
					$this->upload->initialize($uploadary_bimage);
					
					if($this->upload->do_upload('file')) {
						
						$uploadData_logo = $this->upload->data();
						$fileName = $uploadData_logo['file_name'];
						
						$data['banner_image'] = $fileName;
						
					} else {
						$this->data['error_message'] = $this->upload->display_errors();
						//$return['msg'] = 'File not uploaded. Please try again.';
					}
					
				}
				
				//$id = $this -> input -> post('id');
				if($this->data['error_message'] == '') {
					
					$data['menu_id'] = $this->input->post('menu_id');
					$data['description'] = $this->input->post('description');
					$this->banner_m->save($data, $id);
					$message = "Banner Updated Successfully";
										
					$this->session->set_flashdata('success_message', $message);
					redirect($this->data['customer_admin']['dashboard_url'].'/media/index/'.$this->input->post('menu_id'));
					
				}
			}
			
		} else {
			
			$this->session->set_flashdata('error_message', 'Invalid banner');
			redirect($this->data['customer_admin']['dashboard_url'].'/media');
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/edit_banner';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}

	public function get_banner()
	{
		$id=$this -> input -> post('id');	
		
		$this->data['banner'] = $this->banner_m->get_by(array('page_id' => $id));
		$this->data['banner']['cnt'] = count($this->data['banner']);
		echo '{"view_details": ' . json_encode($this->data['banner']) . '}';		
	}

	public function delete ($id)
	{

		$banner_folder = $this->config->item('banner_folder');
		$folder_permission = $this->config->item('folder_permission');
		$thumpath = 'thumbs_banner';
		$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder . DIRECTORY_SEPARATOR;
		$customer_banner_thumb_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder . DIRECTORY_SEPARATOR . $thumpath . DIRECTORY_SEPARATOR;
		
		$banner = $this->banner_m->get($id);
		
		if($banner) {
			$banner_image = $banner->banner_image;
			if(is_file($customer_banner_folder . $banner_image))
				unlink($customer_banner_folder . $banner_image);
			if(is_file($customer_banner_thumb_folder . $banner_image))
				unlink($customer_banner_thumb_folder . $banner_image);
			$this->banner_m->delete($id);	
			
			$message = "Banner Deleted Successfully";
			$this->session->set_flashdata('success_message', $message);
			$status['status'] = 1;
			echo json_encode($status);
		} else {
			$status['status'] = 0;
			$status['statusmsg'] = "Error: Invalid Banner";
			echo json_encode($status);
		}

	}

	public function banner_upload()
	{
		$banner_folder = $this->config->item('banner_folder');
		$folder_permission = $this->config->item('folder_permission');
		$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder;
		
		if (!is_dir($customer_banner_folder))
		{
			@mkdir($customer_banner_folder, $folder_permission, true);
		}
		$customer_banner_folder .= DIRECTORY_SEPARATOR;
		
		$return['status'] = 0;
		$return['msg'] = 'Image is required';
		
		if( isset($this->data['err_post_content_length']) )
			$return['msg'] = $this->data['err_post_content_length'] . ' Please upload image within the given size.';
		
		if (!empty($_FILES)) 
		{
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = time().strtolower($_FILES['file']['name']);
			
			$uploadary_bimage['upload_path'] = $customer_banner_folder;
			$uploadary_bimage['file_name'] = $fileName;
			$uploadary_bimage['allowed_types'] = $this->config->item('allowed_types');
			$uploadary_bimage['min_width']     = config_item('banner_min_width');
			//$uploadary_bimage['min_height']    = config_item('banner_height');
			$uploadary_bimage['max_width']     = config_item('banner_width');
			$uploadary_bimage['max_size']    = config_item('banner_size');
			
			//Load upload library and initialize configuration
			$this->load->library('upload',$uploadary_bimage);
			$this->upload->initialize($uploadary_bimage);
			
			if($this->upload->do_upload('file')) {
				
				$uploadData_logo = $this->upload->data();
				$fileName = $uploadData_logo['file_name'];
				
				$data = array('banner_image'=>$fileName,'page_id'=>$_POST['id']);
				$file_id = $this->banner_m->save($data);
				$message = "Banner Added Successfully";
				
				$return['status'] = 1;
				$return['msg'] = $message;
				$return['id'] = $file_id;
				
				$this->session->set_flashdata('success_message', $message);
				
			} else {
				$return['msg'] = $this->upload->display_errors();
				//$return['msg'] = 'File not uploaded. Please try again.';
			}
			
			//$this->session->set_flashdata('success_message', $message);
			/*
			if($file_id)
			{
					$this->load->library('image_lib');
					$config['upload_path'] = $customer_banner_folder . $fileName;
					list($image_width, $image_height) = getimagesize($config['upload_path']);
					$this->image_resize('100', '200','banner', 'thumbs_banner', $fileName, $image_width, $image_height);  
					//	   image_resize($height, $width, $path, $thumpath, $file_name, $image_width, $image_height)

			}
			*/

		}
		
		echo json_encode($return);
	}
	
// Banner Function End






// Gallery Functions Start//	
	public function gallery ($cat_id = '')

	{
		$this->data['page_name'] = 'Gallery Images';
		
		// Fetch all pages
		$gallery_folder = $this->config->item('gallery_folder');
		$folder_permission = $this->config->item('folder_permission');
		$this->data['customer_banner_url'] = $this->config->item('customer_source_url') . '/' . $gallery_folder . '/';

		$this->data['gallery'] = $this->gallery_m->get();
		
		$this->data['error_message'] = '';
		if(!$cat_id) {
			$cat_id = isset($this->data['gallery'][0]) ? $this->data['gallery'][0]->id : '';
		}
		$this->data['cat_id'] = $cat_id;
		
		$this->data['gallery_images'] = $this->gallery_images_m->get_by(array('g_id' => $cat_id));

		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/gallery';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
		


	}
	
	public function add_gallery()
	{
		
		$this->data['page_name'] = 'Add Gallery Image';	
		$this->data['error_message'] = '';
		$this->data['gallery'] = $this->gallery_m->get();
		
		if($_POST) {
		
			$gallery_folder = $this->config->item('gallery_folder');
			$folder_permission = $this->config->item('folder_permission');
			$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $gallery_folder;
			
			if (!is_dir($customer_banner_folder))
			{
				@mkdir($customer_banner_folder, $folder_permission, true);
			}
			$customer_banner_folder .= DIRECTORY_SEPARATOR;
			
			
			if( isset($this->data['err_post_content_length']) ) {
				
				$this->data['error_message'] = $this->data['err_post_content_length'] . ' Please upload image within the given size.';
			
			} else if (!empty($_FILES)) {
				
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = time().strtolower($_FILES['file']['name']);
				
				$uploadary_bimage['upload_path'] = $customer_banner_folder;
				$uploadary_bimage['file_name'] = $fileName;
				$uploadary_bimage['allowed_types'] = $this->config->item('allowed_types');
				//$uploadary_bimage['min_width']     = config_item('banner_min_width');
				//$uploadary_bimage['min_height']    = config_item('banner_height');
				//$uploadary_bimage['max_width']     = config_item('banner_width');
				//$uploadary_bimage['max_size']    = config_item('banner_size');
				
				//Load upload library and initialize configuration
				$this->load->library('upload',$uploadary_bimage);
				$this->upload->initialize($uploadary_bimage);
				
				if($this->upload->do_upload('file')) {
					
					$uploadData_logo = $this->upload->data();
					$fileName = $uploadData_logo['file_name'];
					
					$data = array('images'=>$fileName, 'g_id'=> $this->input->post('g_id'), 'title'=> $this->input->post('title'));
					$file_id = $this->gallery_images_m->save($data);
					$message = "Gallery Added Successfully";
										
					$this->session->set_flashdata('success_message', $message);
					redirect($this->data['customer_admin']['dashboard_url'].'/media/gallery/'.$this->input->post('menu_id'));
					
				} else {
					$this->data['error_message'] = $this->upload->display_errors();
					//$return['msg'] = 'File not uploaded. Please try again.';
				}
				
			} else {
				
				$this->data['error_message'] = 'Image is required';
			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/add_gallery';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	
	public function edit_gallery($id)
	{
		
		$this->data['page_name'] = 'Edit Gallery Image';	
		$this->data['error_message'] = '';
		$this->data['gallery'] = $this->gallery_m->get();
		$this->data['gallery_image'] = $this->gallery_images_m->get($id, TRUE);
		
		if($_POST) {
		
			$gallery_folder = $this->config->item('gallery_folder');
			$folder_permission = $this->config->item('folder_permission');
			$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $gallery_folder;
			
			if (!is_dir($customer_banner_folder))
			{
				@mkdir($customer_banner_folder, $folder_permission, true);
			}
			$customer_banner_folder .= DIRECTORY_SEPARATOR;
			
			
			if( isset($this->data['err_post_content_length']) ) {
				
				$this->data['error_message'] = $this->data['err_post_content_length'] . ' Please upload image within the given size.';
			
			} else if (!empty($_FILES['file']['tmp_name'])) {
				
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = time().strtolower($_FILES['file']['name']);
				
				$uploadary_bimage['upload_path'] = $customer_banner_folder;
				$uploadary_bimage['file_name'] = $fileName;
				$uploadary_bimage['allowed_types'] = $this->config->item('allowed_types');
				//$uploadary_bimage['min_width']     = config_item('banner_min_width');
				//$uploadary_bimage['min_height']    = config_item('banner_height');
				//$uploadary_bimage['max_width']     = config_item('banner_width');
				//$uploadary_bimage['max_size']    = config_item('banner_size');
				
				//Load upload library and initialize configuration
				$this->load->library('upload',$uploadary_bimage);
				$this->upload->initialize($uploadary_bimage);
				
				if($this->upload->do_upload('file')) {
					
					$uploadData_logo = $this->upload->data();
					$fileName = $uploadData_logo['file_name'];
					
					$data = array('images'=>$fileName, 'g_id'=> $this->input->post('g_id'), 'title'=> $this->input->post('title'));
					$file_id = $this->gallery_images_m->save($data, $id);
					$message = "Gallery Updated Successfully";
										
					$this->session->set_flashdata('success_message', $message);
					redirect($this->data['customer_admin']['dashboard_url'].'/media/gallery/'.$this->input->post('menu_id'));
					
				} else {
					$this->data['error_message'] = $this->upload->display_errors();
					//$return['msg'] = 'File not uploaded. Please try again.';
				}
				
			} else if($this->input->post('title')) {
				
				$data = array('g_id'=> $this->input->post('g_id'), 'title'=> $this->input->post('title'));
				$file_id = $this->gallery_images_m->save($data, $id);
				
				$this->session->set_flashdata('success_message', "Gallery Updated Successfully");
				redirect($this->data['customer_admin']['dashboard_url'].'/media/gallery/'.$this->input->post('menu_id'));
				
			}else {
				
				$this->data['error_message'] = 'Title is required';
			}
		}
		
		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/edit_gallery';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);
	}
	
	
	public function get_gallery()
	{
		$id=$this -> input -> post('id');	
		
		$this->data['gallery'] = $this->gallery_images_m->get_by(array('g_id' => $id));
		$this->data['gallery']['cnt'] = count($this->data['gallery']);
		echo '{"view_details": ' . json_encode($this->data['gallery']) . '}';		
	}

	public function gallery_delete ($id)
	{

		$gallery_folder = $this->config->item('gallery_folder');
		$gallery_folder = $this->config->item('gallery_folder');
		$thumpath = 'thumbs_gallery';
		$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $gallery_folder . DIRECTORY_SEPARATOR;
		$customer_banner_thumb_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $gallery_folder . DIRECTORY_SEPARATOR . $thumpath . DIRECTORY_SEPARATOR;
		
		$banner = $this->gallery_images_m->get($id);
		
		if($banner) {
			$banner_image = $banner->images;
			if(is_file($customer_banner_folder . $banner_image))
				unlink($customer_banner_folder . $banner_image);
			if(is_file($customer_banner_thumb_folder . $banner_image))
				unlink($customer_banner_thumb_folder . $banner_image);
			
			$this->gallery_images_m->delete($id);	
			
			$message = "Gallery Deleted Successfully";
			$this->session->set_flashdata('success_message', $message);
			
			$status['status'] = 1;
			echo json_encode($status);
		} else {
			$status['status'] = 0;
			$status['statusmsg'] = "Error: Invalid Gallery";
			echo json_encode($status);
		}

	}

	public function gallery_upload()
	{
		$gallery_folder = $this->config->item('gallery_folder');
		$folder_permission = $this->config->item('folder_permission');
		$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $gallery_folder;
		
		if (!is_dir($customer_banner_folder))
		{
			@mkdir($customer_banner_folder, $folder_permission, true);
		}
		$customer_banner_folder .= DIRECTORY_SEPARATOR;
		
		$return['status'] = 0;
		$return['msg'] = 'Image is required';
		
		if (!empty($_FILES)) 
		{
			
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = time().strtolower($_FILES['file']['name']);
			$targetPath = $customer_banner_folder;
			$targetFile = $targetPath . $fileName ;
			$success = move_uploaded_file($tempFile, $targetFile);
			
			if($success) {
				
				$data = array('images'=>$fileName,'g_id'=>$_POST['id']);
				$file_id = $this->gallery_images_m->save($data);
				$message = "Gallery Added Successfully";
				
				$return['status'] = 1;
				$return['msg'] = $message;
				$return['id'] = $file_id;
				
				$this->session->set_flashdata('success_message', $message);
				
			} else {
				
				$return['msg'] = 'File not uploaded. Please try again.';
			}
		

		}
		
		echo json_encode($return);
	}


	public function category ()
	{
		$this->data['page_name'] = 'Gallery Category';

       // $this->data['menu_type'] = $this->Menu_type_model->get();
		//$this->data['menu_types'] = $this->Menu_type_model->get();
		$this->data['cat'] = $this->gallery_m->get();
		//echo '<pre>'.$this->db->last_query().'</pre>';
		//$this->data['sub_menu'] = $this->data['sub_menus'] = $this->data['cat'];

		// Load view
		$this->data['subview'] = $this->data['selected_template_path'].'/media/category';
		$this->load->view($this->data['selected_template_path'].'/_layout_main', $this->data);

	}
	
	public function get_gal_cat(){
		$id=$this -> input -> post('id');
		
		$this->db->select('gallery.*');
		$this->db->from('gallery');
		$this->db->where('gallery.id', $id);		
		$query = $this->db->get();
		$result = $query->result();
		$return = array();		
		foreach ($result as $row)
		{
			if(empty($return)) {				
				$return['id'] = $row->id;
				$return['title'] = $row->title;				
			}
			
		}
	
		$this->data['menu'] = $return;
		echo '{"view_details": ' . json_encode($this->data['menu']) . '}';
		// echo '<pre>'.$this->db->last_query().'</pre>';
	
	}


	function gal_cat_add()
	{
		// Validation the form
		$this -> form_validation -> set_rules('title', 'Category title', 'required|trim|xss_clean');
	


		if ($this -> form_validation -> run() == FALSE)
		{

			$status['status'] = 0;
			$status['statusmsg'] = validation_errors();
			echo json_encode($status);
		}
		else
		{
		
			$data_menu['title'] = $this -> input -> post('title');			
			$result = $this->gallery_m->save($data_menu);		
		
			if ($result == FALSE)
			{
				$status['statusmsg'] = "Error: There is a problem while processing your data";
				$status['status'] = 0;
				echo json_encode($status);
			}
			else
			{
				$this->session->set_flashdata('success_message', "Category Created Successfully");
				$status['statusmsg'] = "Category Created Successfully";
				$status['status'] = 1;
				echo json_encode($status);
			}

		}

	}



	public function gal_cat_edit ()
	{
	// Validation the form
	
	$this -> form_validation -> set_rules('title', 'Category title', 'required|trim|xss_clean');
	
	// Process the form
	if ($this -> form_validation -> run() == FALSE)
	{

		$status['status'] = 0;
		$status['statusmsg'] = validation_errors();
		echo json_encode($status);
	}
	else
	{
		
		// save menu table
		$id = $this -> input -> post('id');	
		
		$data_menu['title'] = $this -> input -> post('title');	
		
		$result = $this->gallery_m->save($data_menu, $id);			
	
		if ($result == FALSE)
		{
			$status['statusmsg'] = "Error: There is a problem while processing your data";
			$status['status'] = 0;
			echo json_encode($status);
		}
		else
		{
			$this->session->set_flashdata('success_message', "Category Updated Successfully");
			$status['statusmsg'] = "Updated Successfully";
			$status['status'] = 1;
			echo json_encode($status);
		}

	}


	}


	public function gal_cat_delete ($id)
	{

		$data = $this->gallery_m->get($id);
		
		if($data)
		{
			$this->gallery_m->delete($id);
			
			$status['status'] = 1;
			echo json_encode($status);
			$this->session->set_flashdata('success_message', "Category Deleted Successfully");
		}
		else
		{
			$status['status'] = 0;
			$status['statusmsg'] = "Error: Invalid Category";
			echo json_encode($status);
		}

	}







// Resize Images Function
public function image_resize($height, $width, $path, $thumpath, $file_name, $image_width, $image_height) 
{
	$banner_folder = $this->config->item('banner_folder');
	$folder_permission = $this->config->item('folder_permission');
	$customer_banner_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder . DIRECTORY_SEPARATOR;
	$customer_banner_thumb_folder = $this->config->item('customer_asset_folder') . DIRECTORY_SEPARATOR . $banner_folder . DIRECTORY_SEPARATOR . $thumpath;
	
	if (!is_dir($customer_banner_thumb_folder))
	{
		@mkdir($customer_banner_thumb_folder, $folder_permission, true);
	}
	$customer_banner_thumb_folder .= DIRECTORY_SEPARATOR;
	
    // Resize image settings
    $config['image_library'] = 'GD2';
	$config['upload_path']= $customer_banner_folder.$file_name;
	$config['upload_paths']= $customer_banner_thumb_folder.$file_name;
	$config['source_image'] = $config['upload_path'];
	$config['new_image'] = $config['upload_paths'];
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $width;
    $config['height'] = $height;
    $config['master_dim'] = 'width';

    $this->image_lib->initialize($config);	
	
    if($image_width >= $config['width'] && $image_height >= $config['height'])
    {
        if (!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
			
        } else {
			
            if(file_exists($config['upload_path'])) 
            {
                list($image_width, $image_height) = getimagesize($config['upload_paths']);
                if($image_width > $width)
                { 
                    $config['source_image'] = $config['upload_paths'];
                   /* $y_axis = $image_height - $height;
				   $x_axis = $image_width - $width;
                  $config['y_axis'] = $y_axis;
                    $config['x_axis'] = x_axis;*/
					
                  $config['y_axis'] = $height;
                    $config['x_axis'] = $width;
					
                    $this->image_lib->initialize($config);
                    if (!$this->image_lib->crop()){
                      echo $this->image_lib->display_errors();
                    }/* else {
                      echo "cropped";    
                    }*/
                }
            }    
			else{
					echo '<script type="text/javascript">alert("images width should be below 1000px")</script>';
				}   
        }
    }else{	echo '<script type="text/javascript">alert("images width should be below 1000px")</script>';}
}
	



}