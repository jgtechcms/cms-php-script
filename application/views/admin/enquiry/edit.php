
             
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
                    <!-- END CONTENT FRAME TOP -->
                    
                    
                    <!-- START CONTENT FRAME BODY -->
                    
					<!--  Add Menu -->
                    <div class="content-frame-body menu" id="editpro"  >
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <h4 style="margin:0; padding:0;">Edit Enquiry</h4>
                            </div>
                            <div class="panel-body">
                                
                                <!--Add Menu Type Form-->
								<?php
								$success_message = $this->session->flashdata('success_message');
								$error_message = $this->session->flashdata('error_message');
								?>
								<div class="alert alert-danger<?php if(!$error_message):?> hidden<?php endif;?>">
								<?php
								if($error_message):
								?><?php echo $error_message;?>
								<?php endif;?>
								</div>
								<div class="alert alert-success<?php if(!$success_message):?> hidden<?php endif;?>">
								<?php if($success_message):?>
								<?php echo $success_message;?>
								<?php endif;?>
								</div>
								<div class="col-md-8">
									<form method="POST" role="form" id="frmEdit"> 
										  <div class="form-group"> <label  class="">Name</label>
										  <input type="hidden" name="id" id="id" value="" /> <input type="text" name="name" id="name"  class="form-control" value="">   </div>      
										   <div class="form-group"> <label  class="">Phone Number</label>
										  <input type="text" name="phone" id="phone"  class="form-control" value="">   </div>  
										   <div class="form-group"> <label  class="">Email</label>
										  <input type="text" name="email" id="email"  class="form-control" value="">   </div>  
										   <div class="form-group"> <label  class="">Subject</label>
										  <input type="text" name="subject" id="subject"  class="form-control" value="">   </div>  
										   <div class="form-group"> <label  class="">Comment</label>
										  
										  <textarea name="message" id="message"  class="form-control"></textarea>   </div> 
										   <div class="form-group"> <label  class="">Action Taken</label>
										  
										  <textarea name="action_taken" id="action_taken"  class="form-control"></textarea>
										   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										  </div>                     
										  <div class="form-group">  <input type="button" value="Update" class="btn btn-primary" id="btnedit" />  </div>    
														 
								</form>
								</div>
							</div>                          
                                
						</div>
												   
					</div>
                        
                </div>      
                
                
                
				<?php $this->load->view($selected_template_path.'/common/script');?>