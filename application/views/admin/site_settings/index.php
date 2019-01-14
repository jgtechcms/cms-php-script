	
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
								$site_title = isset($services->site_title) ? $services->site_title : '';
								$address = isset($services->address) ? $services->address : '';
								$phone = isset($services->phone) ? $services->phone : '';
								$background_image = isset($services->background_image) ? $services->background_image : '';
								$gacode = isset($services->ga_code) ? $services->ga_code : '';
								$is_ecommerce_enabled = $services->is_ecommerce_enabled;
								$admin_email = isset($services->admin_email) ? $services->admin_email : '';
								$custom_css = isset($services->custom_css) ? $services->custom_css : '';
								
								$error_message = $this->session->flashdata('error_message');
								$success_message = $this->session->flashdata('success_message');
								if($error_message):
								?>
								<div class="alert alert-danger"><?php echo $error_message;?></div>
								<?php endif;?>
								<?php if($success_message):?>
								<div class="alert alert-success"><?php echo $success_message;?></div>
								<?php endif;?>
						<div class="col-xs-6 col-sm-6">
						
						<div class="form-group"> <label  class="">Site Title <span>*</span></label>
								<input type="text" name="sitetitle" placeholder="Site Title" class="form-control" value="<?php echo set_value('sitetitle', $site_title);?>">  <div class="err"><?php echo form_error('sitetitle'); ?></div> </div> 
								
								<div class="form-group"> <label  class="">Address </label>
								<textarea name="address" placeholder="Address" class="form-control" value=""><?php echo set_value('address', $address);?></textarea>   <div class="err">
								<?php echo form_error('address'); ?></div></div> 
								
								
								<div class="form-group"> <label  class="">Custom CSS</label>
								<textarea name="custom_css" placeholder="Custom CSS Code Here" rows="12" class="form-control" value=""><?php echo set_value('custom_css', $custom_css);?></textarea>
								<div class="err"><?php echo form_error('custom_css'); ?></div>
								</div>
                                
								<?php if(isset($template->has_banner) and $template->has_banner):?>
									<div class="form-group"> 
										<label  class="">Template Background Image</label>
										<?php
											$disabled_checked = '';
											$enabled_checked = '';
											$custom_checked = '';
											$custom_display = 'display:none;';
											if($services->background_image == '0') {
												$disabled_checked = ' checked';
											} else if($services->background_image == '1') {
												$enabled_checked = ' checked';
											} else {
												$custom_checked = ' checked';
												$custom_display = '';
											}
										?>
										<div class="radio">														
										  <label><input type="radio" value="0" name="t_background_image"<?php echo $disabled_checked;?>>Disable</label>
										</div>
										<div class="radio">
										  <label><input type="radio" value="1" name="t_background_image"<?php echo $enabled_checked;?>>Use Default</label>
										</div>
										<div class="radio">
										  <label><input type="radio" value="2" id="custom_background_image" name="t_background_image"<?php echo $custom_checked;?>>Custom</label>
										  
											<div class="form-group custom_section" style="<?php echo $custom_display;?>margin: 10px 20px;"> <div  class="">Select Background Image</div>
												<input type="file" name="background_image" />    <div class="err"><?php echo form_error('background_image'); ?></div>
												[Recommended width x height: <?php echo $this->config->item('template_background_image_width') . ' x ' . $this->config->item('template_background_image_height');?>]
												<?php if($custom_checked):?>
													<img src="<?php echo site_url() . $background_image;?>" width="150" height="100">
												<?php endif;?>
											</div>
										</div>
									</div>
								<?php endif;?>

						</div>
							<div class="col-xs-6 col-sm-6">
							
							<div class="form-group"> <label  class="">Phone No </label>
								<input type="text" name="phone" placeholder="Phone no" class="form-control" value="<?php echo set_value('phone', $phone);?>">   <div class="err"><?php echo form_error('phone'); ?></div></div> 
								
								<div class="form-group"> <label  class="">GA Code</label>
								<textarea name="gacode" placeholder="" class="form-control" value=""><?php echo set_value('gacode', $gacode);?></textarea>   <div class="err">
								<?php echo form_error('gacode'); ?></div></div>
                                
                                <div class="form-group"> <label  class="">Logo</label>
								<input id="uploadBtn" type="file" name="logofile" class="form-control upload" />
                                <div class="err"><?php echo form_error('logofile'); ?></div>
								<?php if(isset($logo)):?>
									<img src="<?php echo site_url() . $logo;?>" width="100" height="50">
								<?php endif;?>
								<div>
									<p style="margin: 0;">[Recommended height: 65]</p>
                                    <p style="margin: 0;">[Maximum width x height: <?php echo $this->config->item('logo_width') . ' x ' . $this->config->item('logo_height');?>]</p>
									<p style="margin: 0;">[Maximum allowed file size: <?php echo $this->config->item('logo_size') . ' kb';?>]</p>
									<p style="margin: 0;">[Allowed file types: <?php echo $this->config->item('allowed_types');?>]</p>
								</div>
								</div>
								
								<div class="form-group"> <label  class="">Favicon</label>
								<input id="uploadfavBtn" type="file" name="favifile" class="form-control upload" />
                                <div class="err"><?php echo form_error('favifile'); ?></div>
								[Recommended width x height: <?php echo $this->config->item('favicon_width') . ' x ' . $this->config->item('favicon_height');?>]
								<?php if(isset($favicon)):?>
									<img src="<?php echo site_url() . $favicon;?>" width="15" height="15">
								<?php endif;?>
								</div> 
								<input type="hidden" value="free" name="templatetype" id="templatetype"></input>
								<input type="hidden" value="free" name="usertype" id="usertype"></input> 
							</div>
							
							<div class="col-xs-12 col-sm-12"><br/>
							</div>
							<div class="col-xs-12 col-sm-12">
							<div class="form-group">  <input type="submit" value="Save" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" />  </div>     
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>
								 
								
								
									  <!--  id="ajaxfilemanager"-->
								
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