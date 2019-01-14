
	<div class="content-frame">                                    
                <div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 
                
                <div class="content-frame-body menu">
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                            
                                	<div class="block">
                                        <a href="<?php echo site_url($customer_admin['dashboard_url']);?>/social_media/" class="btn btn-danger btn-lg"><span class="fa fa-edit"></span> 
                                        Add Social Media
                                        </a>  
                                    </div>
                                 <br />
                                
                				<!-- START CONTENT FRAME -->
              				  <div class="row">  
                            
										<?php
                                        $success_message = $this->session->flashdata('success_message');
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
                    
					                    
					
                    <!-- START CONTENT FRAME LEFT -->
                                <div class="col-md-6 col-xs-6">                                        
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 style="margin:0; padding:0;">List of Social Media <span class="badge badge-success"><?php echo count($social_medias);?></span></h4>
                                        </div>
                                        <div class="panel-body">
                                        	
											<table id="data_table" class="table table-responsive">
                                            	<thead>
                                                	<tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php if(count($social_medias)): foreach($social_medias as $social_media): ?>	
                                                    <tr>
                                                    	<td><?php echo $social_media->id;?></td>
                                                    	<td><?php echo $social_media->name;?></td>
                                                    	<td><a href="javascript:void(0);" class="prolistedit" id="<?php echo $social_media->id;?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteDomain(<?php echo $social_media->id;?>)">Delete</a></td>
                                                    </tr>
                                                    <?php endforeach; ?>
													<?php else: ?>
                                                        <tr>
                                                            <td colspan="2">We could not find any Gallery category.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
											
											
                                        </div>                        
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-6 col-xs-6 menu">
                                
                                <?php
								$id = set_value('id');
								$add = 'Add';
								$add_btn = 'Add';
								if($id)
								{
									$add = 'Edit';
									$add_btn = 'Update';
								}
								?>
                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 style="margin:0; padding:0;"><span id="add_edit_label"><?php echo $add;?></span> Social Media</h4>
                                        </div>
                                        <div class="panel-body">
                                            
                                            <!--Add Menu Type Form-->
                                            <div class="col-md-8">
                                            	<form action="<?php echo site_url($customer_admin['dashboard_url'].'/social_media/');?>" method="POST" role="form" id="frmAdd" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" id="id" value="<?php echo set_value('id')?>" />
                                                    <div class="form-group required"> <label  class="">Name</label>
                                                    <input type="text" name="name" id="name"  class="form-control" value="<?php echo set_value('name')?>" >   
                                                    </div>      
                                                    <div class="form-group required"> <label  class="">Fa Icon</label> 
                                                    <input type="text" name="icon" id="icon" class="form-control" value="<?php echo set_value('icon')?>" />
                                                    <p>(Get the fa icon from <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>)</p>
                                                    </div>  
                                                    <div class="form-group required"> <label  class="">URL</label>
                                                    <input type="text" name="url" id="url" placeholder="http://" class="form-control" value="<?php echo set_value('url')?>" >
                                                    </div>  
                                                    <div class="form-group required"> <label  class="">Status</label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="1" selected>Active</option>
                                                            <option value="0">In-Active</option>
                                                        </select>
                                                    </div>  
                                                    
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                      
                                                    <div class="form-group">  <input type="submit" value="<?php echo $add;?>" class="btn btn-primary" id="btnadd" />  </div>   
            
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
    								

<?php $this->load->view($selected_template_path.'/common/script');?>
<script>
	$(document).ready(function (e){
		$('#data_table').DataTable({searching: false, bInfo: false, lengthChange: false});
	});

	/** Edit Enquiry Start **/

    $(document).on("click", ".prolistedit", edit_menu_details);
	function edit_menu_details(){
		var id= $(this).attr('id');  
		
		$('#add_edit_label').html('Edit');
		$('#btnadd').val('Update');
	
		$.ajax({
			type: 'POST',
			data:{id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
			url: '<?php echo site_url($customer_admin['dashboard_url'].'/social_media/get_data');?>',
			dataType: "json", // data type of response		
			beforeSend: function(){
			$('.image_loader').show();
			},
			complete: function(){
			$('.image_loader').hide();
			},success:renderListform
		
		})
		return false;
	}
	function renderListform(res)
	{
		
		$('#id').val(res.view_details.id);
		$('#name').val(res.view_details.name);
		$('#url').val(res.view_details.url);

		$('#status').val(res.view_details.status);
		$('#icon').val(res.view_details.icon);
		
	}
	
	/** Edit Enquiry End **/
	
</script>

<script type="text/javascript">

/** Delete Enquiry Start **/

function deleteDomain(id)
{
	if (confirm("Are you sure want to delete the selected social media?") == true) {
		var id = id;
		window.location.href = "<?php echo site_url($customer_admin['dashboard_url'].'/social_media/delete');?>/"+id;
	}
}

/** Delete Enquiry End **/

</script>