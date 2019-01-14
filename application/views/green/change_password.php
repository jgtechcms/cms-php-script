<?php 
$this->load->view($selected_template_path.'/'.$user_template.'/common/head'); 
$this->load->view($selected_template_path.'/'.$user_template.'/common/header');
$this->load->view($selected_template_path.'/'.$user_template.'/common/breadcrumb'); 
?>
		<section>
		<div class="container inner">
			<div class="row">
				<div class="col-sm-3">
					<?php $this->load->view($selected_template_path.'/'.$user_template.'/account_side_menu'); ?>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="text-center">Change Password</h2>
						<div class="col-sm-4">
							
							<div class="login-form"><!--login form-->
								<div class="error"><?php echo $this->session->flashdata('error');?></div>
								<div class="success"><?php echo $this->session->flashdata('success');?></div>
								<form class="form-horizontal" method="post" action="">
									<div class="form-group">
										<label for="name" class="cols-sm-2 control-label">Current Password</label>
										<input type="password" class="form-control" name="cur_password" id="cur_password" value=""/>
											<span style="color:#e04b4a;"><?php echo form_error('cur_password'); ?></span>
									</div>
									
									<div class="form-group">
										<label for="name" class="cols-sm-2 control-label">New Password</label>
										<input type="password" class="form-control" name="new_password" id="new_password" value=""/>
											<span style="color:#e04b4a;"><?php echo form_error('new_password'); ?></span>
									</div>
									
									<div class="form-group">
										<label for="username" class="cols-sm-2 control-label">Confirm New Password</label>
										<input type="password" class="form-control" name="password" value="" />
											<span style="color:#e04b4a;"><?php echo form_error('password'); ?></span>
									</div>
									
									<div class="form-group">											
										<button type="submit" class="btn btn--ys btn--md">Update</button>
									</div>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								</form>
							</div><!--/login form-->
							
							
							
						</div>
					
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/common/footer'); ?>
