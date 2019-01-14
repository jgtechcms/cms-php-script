<?php 
$this->load->view($selected_template_path.'/'.$user_template.'/common/head'); 
$this->load->view($selected_template_path.'/'.$user_template.'/common/header');
$this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
          
							
				<div class="login-form"><!--login form-->
												
						<div style="margin: 30px 0 20px 0;">
							<?php
							$success_message = $this->session->flashdata('success_message');
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
							
							<?php if(empty($error_code)):?>
							
								<form action="" class="form-horizontal" autocomplete="off" method="post">
									<div class="form-group">
                                    <input class="form-control" type="text" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>"/>
									<span style="color:#e04b4a;"><?php echo form_error('email'); ?></span>
									</div>
                                    
                                    <div class="form-group">
									<input class="form-control" type="password" placeholder="New Password" name="new_password" value="<?php echo set_value('new_password'); ?>"/>
									<span style="color:#e04b4a;"><?php echo form_error('new_password'); ?></span>									
									</div>
                                    
                                    <div class="form-group">
									<input class="form-control" type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>"/>
									<span style="color:#e04b4a;"><?php echo form_error('confirm_password'); ?></span>
									</div>
                                    
                                    <div class="form-group text-center">								
										<input type="submit" name="submit" class="btn btn-default" value="Submit" />
                                    </div>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								</form>
							<?php endif;?>
						</div>
					</div><!--/login form-->
				
                    
         
        
        </div>
    </div>
</div>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/footer'); ?>