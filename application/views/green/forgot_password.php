<?php 
$this->load->view($selected_template_path.'/'.$user_template.'/common/head'); 
$this->load->view($selected_template_path.'/'.$user_template.'/common/header');
$this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
          
						<div class="form-group">
                        						
						<h5>Enter your email address to reset your password</h5>
                        
                        </div>
						
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
							
							<form action="" class="form-horizontal" autocomplete="off" method="post">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>"/>
									<span style="color:#e04b4a;"><?php echo form_error('email'); ?></span>
								</div>
								
								<div class="form-group text-center">
									<input type="submit" name="submit" class="btn btn-default" value="Submit"/>
								</div>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							</form>
				
                    
         
        
        </div>
    </div>
</div>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/footer'); ?>