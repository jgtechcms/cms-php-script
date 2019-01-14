<script>
$(document).ready(function(){
	<?php /*$('#install').click( function() {
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/manufacture/index/install');?>';
	});
	$('#uninstall').click( function() {
		var sure = confirm("Are you sure want to uninstall this extension?");
		if(sure) {
			window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/manufacture/index/uninstall');?>';
		}
	});
	*/ ?>
	$('.insert_status').click( function() {
		var menu_id = $(this).data('id'); 
		if(menu_id == '') {
			return false;
		}
		var status = $('#is_enable_'+menu_id).val();
		
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/manufacture/insert/');?>'+menu_id+'/'+status;
	});
	$('.update_status').click( function() {
		var cat_id = $(this).data('id'); 
		if(cat_id == '') {
			return false;
		}
		var status = $('#is_enable_update_'+cat_id).val();
		
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/manufacture/update/');?>'+cat_id+'/'+status;
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
					
					<div class="col-xs-12 col-sm-12 placeholder">
						<div class="starter-template">
							<?php
							//$is_installed = $manufacture_extension->is_installed;
							?>
							<div class="form-group" style="text-align:center; padding:20px 0;">															
								<div class="form-group table-responsive" style="padding:20px 0;">  
									<table class="table">
										<tr>
											<th>Page name</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										<?php 
										foreach($manufacture_extension_data as $extension_data):
											$id = $extension_data->menu_id;
											$status_id = 'is_enable_'.$id;
											$status = 'insert_status';
											if($extension_data->id) {
												$id = $extension_data->id;
												$status_id = 'is_enable_update_'.$id;
												$status = 'update_status';
											}
										?>											
											<tr>
												<td><?php echo $extension_data->title;?></td>
												<td>
													<select id="<?php echo $status_id;?>" class="select">
														<option value="1"<?php if($extension_data->is_enable == 1):?> selected<?php endif;?>>Enable</option>
														<option value="0"<?php if($extension_data->is_enable == 0):?> selected<?php endif;?>>Disable</option>
													</select>
												</td>
												<td>
													<input type="button" value="Update" data-id="<?php echo $id;?>" class="btn btn-primary <?php echo $status;?>" />
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