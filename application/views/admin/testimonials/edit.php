			<div class="content-frame">                                    
                    <div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 


					<!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body menu" id="pro"  >
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
								<div class="col-md-6">
									
									<!--Add Menu Type Form-->
									<?php
									$success_message = $this->session->flashdata('success_message');
									$error_message1 = $this->session->flashdata('error_message');
									if($error_message):
									?>
									<div class="alert alert-danger"><?php echo $error_message;?></div>
									<?php elseif($error_message1):?>
                                    <div class="alert alert-danger"><?php echo $error_message1;?></div>
									<?php endif;?>
									<?php if($success_message):?>
									<div class="alert alert-success"><?php echo $success_message;?></div>
									<?php endif;?>
									
									<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
           
              
										<div class="form-group required"> 
											<label  class="">Name</label>
											<input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title', $testimonial->title)?>">   
										</div>  
										<?php /*<div class="form-group"> 
											<label  class="">Designation</label>
											<input type="text" name="designation"  class="form-control" value="">   
										</div>  */?>
										<div class="form-group required"> 
											<label  class="">Company name</label>
											<input type="text" name="company" id="company" class="form-control" value="<?php echo set_value('company', $testimonial->company)?>">   
										</div>  
										<div class="form-group"> 
											<label  class="">Company url</label>
											<input type="text" name="company_url" id="company_url" class="form-control" value="<?php echo set_value('company_url', $testimonial->company_url)?>">   
										</div>  
										<div class="form-group required"> 
											<label  class="">Image</label>
											<input type="file" name="file" class="form-control" value="">   
											[width x height: <?php echo $this->config->item('testimonial_icon_width') . ' x ' . $this->config->item('testimonial_icon_height');?>]
											<div id="icon_thumb">
											<?php
											$testimonial_icon_folder = $this->config->item('testimonial_icon_folder');
											$customer_testimonial_icon_folder = $this->config->item('customer_source_url') . '/' . $testimonial_icon_folder . '/';
											$file_thumb = $customer_testimonial_icon_folder . $testimonial->image_name;
											echo '<img src="'.site_url().$file_thumb.'" >';
											?>
											</div>
										</div> 
									   
										<div class="form-group required"> <label  class="">Content</label></div> 
										<div class="form-group">
										<textarea name="body_desc" id="body_desc" class="form-control" ><?php echo set_value('body_desc', $testimonial->body_desc)?></textarea>
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> 
										
										 </div>    
										
									   <div class="form-group">  <input type="submit" value="Update" class="btn btn-primary btnadd" id="btnadd" />  </div>     
													 
									</form>
								</div>
							</div>
						
						</div>

                          
                                
                    </div>
			</div>
			
			<?php $this->load->view($selected_template_path.'/common/script');?>