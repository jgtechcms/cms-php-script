
           
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
					</div>
                    
					                        
                        
                    <div class="content-frame-body editpro" style="margin-left: 10px;">
						
                        <div class="panel panel-default" id="editpro">
                            
                            <div class="panel-body">
							
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
							
								<div class="block">
									<a href="<?php echo site_url($customer_admin['dashboard_url']);?>/media/add_gallery" id="showmenu" class="showmenu btn btn-danger btn-lg"><span class="fa fa-edit"></span> Add Gallery Image</a>
								</div>
                                
                                <!--Add Menu Type Form-->
								<div class="col-md-3 col-md-offset-3">	
									<div class="form-group text-center">
										<label>Select Category</label> 
										<select name="filter_menu_id" id="filter_menu_id" class="form-control select">
											<?php foreach($gallery as $gall):?>
											<option value="<?php echo $gall->id;?>"<?php if($cat_id == $gall->id):?> selected<?php endif;?>><?php echo $gall->title;?></option>
											<?php endforeach;?>
										</select>
									</div>
                                </div>

								<div class="col-md-12">
									
									<div class="add_banner_section">
										
											<div class="">	
												<table id="data_table" class="table display">
													<thead><tr><th class="blank_field">Id</th><th class="blank_field">Gallery Thumb</th><th class="blank_field">Title</th><th class="blank_field">Action</th></tr>
													</thead>
													<tbody>
														<?php foreach($gallery_images as $key => $banner):?>
															<tr>
																<td><?php echo $banner->id;?></td>
																<td>
																<img src="<?php echo site_url(config_item('customer_source_url').'/'.config_item('gallery_folder').'/'.$banner->images);?>" style="width:50px;" >
																</td>
                                                                <td><?php echo $banner->title;?></td>
																<td>
																	<a href="<?php echo site_url($customer_admin['dashboard_url'].'/media/edit_gallery/'.$banner->id);?>">Edit</a> | 
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
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/media/gallery/');?>'+filter_menu_id;
	});
	
	$('#data_table').DataTable();//{"bInfo": false}
});
</script>
<style>
.dataTables_length {padding: 0px 0px 10px;}
.blank_field:before{content: "";}
</style>
<script type="text/javascript">
 function delete_banner(id)
    {
        if (confirm("Are you sure want to delete gallery?") == true) {
			var id = id;
			$.ajax({
				url:"<?php echo site_url($customer_admin['dashboard_url'].'/media/gallery_delete');?>/"+id,
				dataType: "json",
				success:function(result)
				{
					if(result.status == 0 )
					{
						$(".editpro .alert-success").addClass('hidden') ;
						$(".editpro .alert-danger").html(result.statusmsg).removeClass('hidden');	
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