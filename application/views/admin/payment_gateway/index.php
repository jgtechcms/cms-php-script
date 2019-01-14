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
	<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
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
									<table class="table">
										<tr>
											<th>Payment Gateway</th>
											<th>Action</th>
										</tr>
										<?php 
										foreach($payment_gateway as $gateway):
										?>											
											<tr>
												<td><?php echo $gateway->payment_type;?></td>
												<td>
													<input type="button" value="Settings" data-id="<?php echo $gateway->id;?>" class="clsGateway btn btn-primary" />
													<?php /*<input type="button" value="Remove" class="btn btn-primary remove_page" />*/?>
												</td>
											</tr>
										<?php endforeach;?>
									</table>
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