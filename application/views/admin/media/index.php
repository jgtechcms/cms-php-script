
           
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
					</div>
                    
					                        
                        
                    <div class="content-frame-body editpro" style="margin-left: 10px;">
						
                        <div class="panel panel-default" id="editpro">
                            
                            <div class="panel-body">
							
								<div class="block">
									<a href="<?php echo site_url($customer_admin['dashboard_url']);?>/media/add_banner" style="margin-bottom:20px;" id="showmenu" class="showmenu btn btn-danger btn-lg"><span class="fa fa-edit"></span> Add Slider Image</a>
								</div>
							
								<input type="hidden" name="added_id" id="added_id" value="">
								<?php
								$success_message = $this->session->flashdata('success_message');
								$error_message = $this->session->flashdata('error_message');
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
                                
                                <!--Add Menu Type Form-->

								<div class="col-md-12">
									
									<div class="form-group text-center">
										<label>Select Menu</label> 
										<select name="filter_menu_id" id="filter_menu_id" class="select">
											<?php foreach($menus as $menu):?>
											<option value="<?php echo $menu->id;?>"<?php if($menu_id == $menu->id):?> selected<?php endif;?>><?php echo $menu->title;?></option>
											<?php endforeach;?>
										</select>
									</div>
									
									<div class="add_banner_section">
										
											<div class="">	
												<table id="data_table" class="table display" cellspacing="0" width="100%">
													<thead><tr><th class="blank_field">Id</th><th class="blank_field">Thumb</th><th class="blank_field">Action</th></tr>
													</thead>
													<tbody>
														<?php foreach($banners as $key => $banner):?>
															<tr>
																<td><?php echo $banner->id;?></td>
																<td>
																<img src="<?php echo site_url(config_item('customer_source_url').'/'.config_item('banner_folder').'/'.$banner->banner_image);?>" style="width:50px;" >
																</td>
																<td>
																	<a href="<?php echo site_url($customer_admin['dashboard_url'].'/media/edit_banner/'.$banner->id);?>">Edit</a> | 
																	<a href="javascript:void(0);" onclick="delete_banner(<?php echo $banner->id;?>)">Delete</a>
																</td>
															</tr>
														<?php endforeach;?>
													</tbody>
												</table> 
											</div>
									</div>           

								</div>
                          
                                
                            </div>
                                                      
                        </div>
                      

						<!-- END CONTENT FRAME BODY -->
					</div>
				<!-- END CONTENT FRAME -->
				</div>
<?php $this->load->view($selected_template_path.'/common/script');?>
<script>
$(document).ready(function(){
	$('#filter_menu_id').change( function() {
		var filter_menu_id = $(this).val(); 
		if(filter_menu_id == '') {
			return false;
		}
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/media/index/');?>'+filter_menu_id;
	});
	
	$('#data_table').DataTable({searching: false});//{"bInfo": false}
});
</script>
<style>
.dataTables_length {padding: 0px 0px 10px;}
.blank_field:before{content: "";}
</style>
<script type="text/javascript">
 function delete_banner(id)
    {
        if (confirm("Are you sure want to delete banner?") == true) {
			var id = id;
			$.ajax({
				type: 'POST',
				data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
				url:"<?php echo site_url($customer_admin['dashboard_url'].'/media/delete');?>/"+id,
				dataType: "json", // data type of response		
				success:function(result)
				{
					if(result.status == 0 )
					{
						$(".alert-success").addClass('hidden') ;
						$(".alert-danger").html(result.statusmsg).removeClass('hidden');	
					}
					else 
					{
						location.reload();
					}
				},
			   
			});
        }
    }

</script>