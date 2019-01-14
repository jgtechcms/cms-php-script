<?php $this->load->view($selected_template_path.'/'.$user_template.'/header'); ?>

<div class="container inner" style="min-height:500px;">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
          
							
				<div class="login-form"><!--login form-->
						<h2>Forgot your password?</h2>
						
						<h5>Enter your email address to reset your password</h5>
						
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
							
							<form action="" class="form-horizontal" autocomplete="off" method="post">
								<input type="text" placeholder="Email Address" name="email" value="<?php echo set_value('email'); ?>"/>
								<span style="color:#e04b4a;"><?php echo form_error('email'); ?></span>
							
								<input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit" style="color:#fff;" />
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
							</form>
						</div>
					</div><!--/login form-->
				
                    
         
        
        </div>
    </div>
</div>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/footer'); ?>
</body>
</html>