<!-- START CONTENT FRAME -->
<div class="content-frame">                                    
	<div class="row">
		<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
		</div>
	
	
	
	<!-- START CONTENT FRAME BODY -->
	<div class="content-frame-body menu" id="pro" style="margin-left: 10px;" >
		
		<div class="panel panel-default">
			<?php /*<div class="panel-heading">
			   <h4 style="margin:0; padding:0;">View Enquiry Details</h4>
			</div>*/?>
			<div class="panel-body">
				
				<div class="row placeholders">
					<div class="col-xs-12 col-sm-12 placeholder">
					  <div class="starter-template">
						
						
							<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
							
								<?php
								$mail_protocol = isset($services->mail_protocol) ? $services->mail_protocol : '';
								$mail_path = isset($services->mail_path) ? $services->mail_path : '';
								$admin_email = isset($services->admin_email) ? $services->admin_email : '';
								$admin_notify_email = isset($services->admin_notify_email) ? $services->admin_notify_email : '';
								$smtp_host_name = isset($services->smtp_host_name) ? $services->smtp_host_name : '';
								$smtp_username = isset($services->smtp_username) ? $services->smtp_username : '';
								$smtp_password = isset($services->smtp_password) ? $services->smtp_password : '';
								$smtp_port = isset($services->smtp_port) ? $services->smtp_port : '';
								$smtp_timeout = isset($services->smtp_timeout) ? $services->smtp_timeout : '';
								
								$error_message = $this->session->flashdata('error_message');//validation_errors();
								$success_message = $this->session->flashdata('success_message');
								if($error_message):
								?>
								<div class="alert alert-danger"><?php echo $error_message;?></div>
								<?php endif;?>
								<?php if($success_message):?>
								<div class="alert alert-success"><?php echo $success_message;?></div>
								<?php endif;?>
								
								<?php $settings_email = config_item('settings_email');?>
								
								<div class="col-xs-6 col-sm-6">
								<div class="form-group"> <label  class="">Mail Protocol</label>
								<select name="mail_protocol" class="form-control select">
									<?php foreach($settings_email as $settings_key => $settings_value):?>
									<option value="<?php echo $settings_key;?>"<?php if(set_value('mail_protocol', $mail_protocol) == $settings_key):?> selected<?php endif;?>><?php echo $settings_value;?></option>
									<?php endforeach;?>
								</select>
								<div class="err"><?php echo form_error('mail_protocol'); ?></div> </div>
</div><div class="col-xs-6 col-sm-6"><h3 style="margin:30px 0 20px 0;">SMTP Settings</h3></div>
							<div class="col-xs-12 col-sm-12"></div>	
							<div class="col-xs-6 col-sm-6">
							
							<div class="form-group"> <label  class="">Mail Path</label>
								<input type="text" name="mail_path" placeholder="Mail Path" class="form-control" value="<?php echo set_value('mail_path', $mail_path);?>">   <div class="err">
								<?php echo form_error('mail_path'); ?></div></div> 
								
								<div class="form-group"> <label  class="">'From' Email Id <?php echo get_tooltip('tooltip_settings_to_email'); ?></label>
								<input type="text" name="admin_email"  class="form-control" value="<?php echo set_value('admin_email', $admin_email)?>">   
								<div class="err"><?php echo form_error('admin_email'); ?></div>
								</div>
                                
                                <div class="form-group"> <label  class="">Admin Notification Email Id</label>
								<input type="text" name="admin_notify_email"  class="form-control" value="<?php echo set_value('admin_notify_email', $admin_notify_email)?>">   
								<div class="err"><?php echo form_error('admin_notify_email'); ?></div>
								</div>
                                
							</div>	

							
								
								<div class="col-xs-6 col-sm-6">
								
								
								
								<div class="form-group"> <label  class="">SMTP Hostname</label>
								<input type="text" name="smtp_host_name" placeholder="SMTP Hostname" class="form-control" value="<?php echo set_value('smtp_host_name', $smtp_host_name);?>">   <div class="err"><?php echo form_error('smtp_host_name'); ?></div></div> 
																
								<div class="form-group"> <label  class="">SMTP Username</label>
								<input type="text" name="smtp_username" placeholder="SMTP Username" class="form-control" value="<?php echo set_value('smtp_username', $smtp_username);?>">   <div class="err"><?php echo form_error('smtp_username'); ?></div></div>
								
								<div class="form-group"> <label  class="">SMTP Password</label>
								<input type="text" name="smtp_password" placeholder="SMTP Password" class="form-control" value="<?php echo set_value('smtp_password', $smtp_password);?>">   <div class="err"><?php echo form_error('smtp_password'); ?></div></div>
								
								<div class="form-group"> <label  class="">SMTP Port</label>
								<input type="text" name="smtp_port" placeholder="SMTP Port" class="form-control" value="<?php echo set_value('smtp_port', $smtp_port);?>"><small>(Defalt: 25)</small>   <div class="err"><?php echo form_error('smtp_port'); ?></div></div>
								
								<div class="form-group"> <label  class="">SMTP Timeout</label>
								<input type="text" name="smtp_timeout" placeholder="SMTP Timeout" class="form-control" value="<?php echo set_value('smtp_timeout', $smtp_timeout);?>"><small>(in seconds. Default: 5)</small>   <div class="err"><?php echo form_error('smtp_timeout'); ?></div></div>
								</div>	
								
								<div class="col-xs-12 col-sm-12"></div>	
									  <!--  id="ajaxfilemanager"-->
								
								<div class="col-xs-12 col-sm-12"><div class="form-group">  <input type="submit" value="Save" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" />  </div>     
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"></div>	
							</form>

					  </div>
					</div>
				  
				</div>
				
			</div>

		  
				
		</div>
									   
	</div>

</div>
<?php $this->load->view($selected_template_path.'/common/script');?>
<script>
$(document).ready(function() {
	$("body").delegate('input[name=t_background_image]', 'click', function() {
		$t_background_image = $(this).val();
		
		if ($t_background_image == 2) {
			$('.custom_section').show();
		} else {
			$('.custom_section').hide();
		}
	});
});
</script>