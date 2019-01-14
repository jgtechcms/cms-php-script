<script>
$(document).ready(function(){
	$('#install').click( function() {
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/category/index/install');?>';
	});
	$('#uninstall').click( function() {
		var sure = confirm("Are you sure want to uninstall this extension?");
		if(sure) {
			window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/category/index/uninstall');?>';
		}
	});
	
	$('.update_status').click( function() {
		var cat_id = $(this).data('id'); 
		if(cat_id == '') {
			return false;
		}
		var status = $('#is_enable_'+cat_id).val();
		
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/'.$site_models['extension'].'/category/update/');?>'+cat_id+'/'+status;
	});
});
</script>
<style>
th{text-align: center;}
</style>

<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>				
				
<!-- START CONTENT FRAME -->
<div class="content-frame">                                    
	<!-- START CONTENT FRAME TOP -->
	<div class="content-frame-top">                        
		<div class="page-title">                    
			<h2><span class="fa fa-file-text"></span> <?php echo $page_name;?> </h2>
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
							$is_installed = $category_extension->is_installed;
							?>
							<div class="form-group" style="text-align:center; padding:20px 0;">
							<?php /*<select name="is_installed" class="select">
									<option value="1"<?php if(set_value('is_installed', $is_installed) == 1):?> selected<?php endif;?>>Enable</option>
									<option value="0"<?php if(set_value('is_installed', $is_installed) == 0):?> selected<?php endif;?>>Disable</option>
								</select>*/?>
								<?php if($is_installed):?>
									<div class="form-group">  <input type="button" value="Uninstall" class="btn btn-primary btnadd" id="uninstall" />  </div>
									
									<div class="form-group" style="padding:20px 0;">  
										<table class="table">
											<tr>
												<th>Page name</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											<?php foreach($category_extension_data as $category_data):?>
												<tr>
													<td><?php echo $category_data->title;?></td>
													<td>
														<select id="is_enable_<?php echo $category_data->id;?>" class="select">
															<option value="1"<?php if($category_data->is_enable == 1):?> selected<?php endif;?>>Enable</option>
															<option value="0"<?php if($category_data->is_enable == 0):?> selected<?php endif;?>>Disable</option>
														</select>
													</td>
													<td>
														<input type="button" value="Update" data-id="<?php echo $category_data->id;?>" class="btn btn-primary update_status" />
														<?php /*<input type="button" value="Remove" class="btn btn-primary remove_page" />*/?>
													</td>
												</tr>
											<?php endforeach;?>
										</table>
									</div>
								<?php else:?>
									<div class="form-group">  <input type="button" value="Install" class="btn btn-primary btnadd" id="install" />  </div>
								<?php endif;?>
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