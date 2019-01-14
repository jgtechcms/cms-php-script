<?php $this->load->view($selected_template_path.'/'.$user_template.'/header'); ?>

		<section>
		<div class="container inner">
			<div class="row">
				<div class="col-sm-3">
					<?php $this->load->view($selected_template_path.'/'.$user_template.'/account_side_menu'); ?>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Change Password</h2>
						<div class="col-sm-4">
							
							<div class="login-form"><!--login form-->
						<div class="error"><?php echo $this->session->flashdata('error');?></div>
					<div class="success"><?php echo $this->session->flashdata('success');?></div>
						 <form class="form-horizontal" method="post" action="">
						 <label for="name" class="cols-sm-2 control-label">Current Password</label>
							<input type="password" class="form-control" name="cur_password" id="cur_password"  placeholder="Current Password" value="<?php echo set_value('cur_password'); ?>"/>
									<span style="color:#e04b4a;"><?php echo form_error('cur_password'); ?></span>
							<label for="name" class="cols-sm-2 control-label">New Password</label>
							<input type="password" class="form-control" name="new_password" id="new_password"  placeholder="New Password" value="<?php echo set_value('new_password'); ?>"/>
									<span style="color:#e04b4a;"><?php echo form_error('new_password'); ?></span>
							<label for="username" class="cols-sm-2 control-label">Confirm New Password</label>
							<input type="password" class="form-control" placeholder="Confirm Password" name="password" value="<?php echo set_value('password'); ?>" />
									<span style="color:#e04b4a;"><?php echo form_error('password'); ?></span>
									
							<button type="submit" class="btn btn-primary" style="color:#fff;">Update</button>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						</form>
					</div><!--/login form-->
							
							
							
						</div>
					
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
<?php $this->load->view($selected_template_path.'/'.$user_template.'/footer'); ?>
</body>
</html>