<script>
$(document).ready(function(){
	<?php /*$('#install').click( function() {
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/category/index/install');?>';
	});
	$('#uninstall').click( function() {
		var sure = confirm("Are you sure want to uninstall this extension?");
		if(sure) {
			window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/category/index/uninstall');?>';
		}
	});
	*/ ?>
	$('.clsGateway').click( function() {
		var id = $(this).data('id'); 
		if(id == '') {
			return false;
		}
		
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/payment_gateway/settings/');?>'+id;
	});
});
</script>
<style>
th{text-align: center;}
</style>

				
<!-- START CONTENT FRAME -->
<div class="content-frame">                                    
	<!-- START CONTENT FRAME TOP -->
	<div class="content-frame-top">       
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">			
			<div class="page-title">                    
				<h2>Settings: <?php echo $payment_gateway->payment_type;?></h2>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<!-- START BREADCRUMB -->
			<ul class="breadcrumb push-down-0">
				<li><a href="<?php echo site_url($customer_admin['dashboard_url']);?>">Home</a></li>
				<li><a href="<?php echo site_url($customer_admin['dashboard_url']);?>/payment_gateway">Payment gateway</a></li>
				<li><a class="active">Settings: <?php echo $payment_gateway->payment_type;?></a></li>              
			</ul>
			<!-- END BREADCRUMB --> 
		</div>				
							  
	</div>
	<!-- END CONTENT FRAME TOP -->
	
	
	
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
							<?php
							$success_message = $this->session->flashdata('success_message');
							$error_message = $this->session->flashdata('error_message');
							if($error_message):
							?>
							<div class="alert alert-danger"><?php echo $error_message;?></div>
							<?php endif;?>
							<?php if($success_message):?>
							<div class="alert alert-success"><?php echo $success_message;?></div>
							<?php endif;?>
							
							<?php
							//$is_installed = $category_extension->is_installed;
							?>
							<div class="form-group" style="text-align:center; padding:20px 0;">															
								<div class="form-group" style="padding:20px 0;">  
									<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
										<table class="table">
											<?php 
											foreach($gateway_settings as $settings):
											?>											
												<tr>
													<td>
														<?php 
														echo $settings->description;
														if($settings->is_required)
															echo ' <span>*</span>';
														?>												
													</td>
													<td>
														<?php
														$settings_value = set_value($settings->variable_name, $settings->value);
														?>
														<input type="text" value="<?php echo $settings_value;?>" name="<?php echo $settings->variable_name;?>" class="form-control" />
														<div class="err"><?php echo form_error($settings->variable_name); ?></div>
													</td>
												</tr>
											<?php endforeach;?>
										</table>
										
										<div class="form-group">  <input type="submit" value="Save" class="btn btn-primary btnadd" id="btnadd" name="siteupdate" />  </div>
										
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									</form>
								</div>
							</div>

						</div>
					</div>
				  
				</div>
				
			</div>

		  
				
		</div>
									   
	</div>

</div>

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