<script>
$(document).ready(function(){
	$('#filter_page_id').change( function() {
		var filter_page_id = $(this).val(); 
		if(filter_page_id == '') {
			return false;
		}
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/products/featured/');?>'+filter_page_id;
	});
	
	$('#listProducts').DataTable();
});
</script>
<style>
.dataTables_length {padding: 0px 0px 10px;}
.blank_field:before{content: "";}
</style>
             
				
<!-- START CONTENT FRAME -->
<div class="content-frame">                                    
	<!-- START CONTENT FRAME TOP -->
	<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>    
	<!-- END CONTENT FRAME TOP -->
	
		
		
	<div class="content-frame-body menu" id="pro" style="margin-left: 10px;" >
		<?php /*
		<div class="block" style="width: 300px;">
			<a href="<?php echo site_url($customer_admin['dashboard_url']);?>/products/add_featured" class="showmenu btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> Add featured Product</a>
		</div>
		*/?>
		
		
		<input type="hidden" name="added_id" id="added_id" value="">
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
		
		<div class="panel panel-default" id="editpro">
			<div class="panel-heading add_banner_section">
			   <h4 style="margin:0; padding:0;">List of users<span class="banner_name"></span> </h4>
			</div>
			<div class="panel-body">
	
				
				<!--Add Menu Type Form-->

				<div class="col-md-12">
					   
					<form method="POST" role="form" id="frmAdd" enctype="multipart/form-data">
						<div class="table-responsive">
						<table id="listProducts" class="table display" cellspacing="0" width="100%">
							<thead><tr> <th>S.No</th><th>Created</th><th>Name</th><th>Username</th><th>Email</th><th class="blank_field">Action</th></tr>
							</thead>
							<tbody>
								<?php foreach($users as $key => $user):?>
									<tr>
										<td><?php echo $key+1;?></td>
										<td><?php echo $user->created;?></td>
										<td><?php echo $user->name;?></td>
										<td><?php echo $user->username;?></td>
										<td><?php echo $user->email;?></td>
										<td>
											<?php if($user->ord_order_number):?>
												<a href="<?php echo site_url($customer_admin['dashboard_url']); ?>/products/orders/<?php echo $user->id;?>">Orders</a>
											<?php endif;?>
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table> 
						</div>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					</form>
					


				</div>
		  
				
			</div>
									  
		</div>
	  

		<!-- END CONTENT FRAME BODY -->
	</div>
<!-- END CONTENT FRAME -->
</div>