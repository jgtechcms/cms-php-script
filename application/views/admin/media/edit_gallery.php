<style>
.err{color:red;}
</style>
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 
                    
					
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body menu" id="pro">
                        
                        <div class="panel panel-default">
                            <?php /*<div class="panel-heading">
                               <h4 style="margin:0; padding:0;">View Enquiry Details</h4>
                            </div>*/?>
                            <div class="panel-body">
                                
								<div class="row placeholders">
									<div class="col-md-8 placeholder">
									  <div class="starter-template">										
										
											<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
											
												<?php
												//$error_message = $this->session->flashdata('error_message');
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
												
												<div class="form-group required"> 
													<label  class="">Select Category</label>
													<select name="g_id" class="select form-control">
														<?php foreach($gallery as $gallery):?>
															<option value="<?php echo $gallery->id;?>"<?php if($gallery->id == set_value('g_id', $gallery_image->g_id)):?> selected<?php endif;?>><?php echo $gallery->title;?></option>
														<?php endforeach;?>
													</select>
												</div> 
												
												
												<div class="form-group"> <label  class="">Title</label>
													<?php 
													$title = set_value('title', $gallery_image->title);
													?>
													<input type="text" name="title" class="form-control" id="title" value="<?php echo $title;?>" />
												</div> 
												
												<div class="form-group required"> 
													<label  class="">Gallery Image </label>
													<input type="file" name="file" class="form-control" value="">   <br />
													<?php /*<p style="margin: 0;">[Maximum width x height: <?php echo $this->config->item('banner_width') . ' x ' . $this->config->item('banner_height');?>]</p>
													<p style="margin: 0;">[Minimum width: <?php echo $this->config->item('banner_min_width');?>]</p>
													<p style="margin: 0;">[Maximum allowed file size: <?php echo $this->config->item('banner_size') . ' kb';?>]</p>
													<p style="margin: 0;">[Allowed file types: <?php echo $this->config->item('allowed_types');?>]</p>*/?>
													
													<div id="icon_thumb">
													<?php
													$banner_folder = $this->config->item('gallery_folder');
													$customer_banner_folder = $this->config->item('customer_source_url') . '/' . $banner_folder . '/';
													$file_thumb = $customer_banner_folder . $gallery_image->images;
													echo '<img style="width:200px;" src="'.site_url().$file_thumb.'" >';
													?>
													</div>
												</div> 
												
												
													  <!--  id="ajaxfilemanager"-->
												<div class="form-group">  <input type="submit" value="Update" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" /></div>     
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											</form> 

									  </div>
									</div>
								  
								</div>
								
							</div>

                          
                                
                        </div>
                                                       
                    </div>

				</div>
				<?php $this->load->view($selected_template_path.'/common/script');?>