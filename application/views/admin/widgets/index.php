<script>
$(document).ready(function(){
	$('#filter_menu_id').change( function() {
		var filter_menu_id = $(this).val(); 
		if(filter_menu_id == '') {
			return false;
		}
		window.location = '<?php echo site_url($customer_admin['dashboard_url'].'/media/index/');?>'+filter_menu_id;
	});
	
	$('#listProducts').DataTable();//{"bInfo": false}
});
</script>
<style>
.dataTables_length {padding: 0px 0px 10px;}
.blank_field:before{content: "";}
</style>


<script type="text/javascript">
$(document).on("click", ".showmenu", showmenu);
	function showmenu(){
		$('.editpro').fadeOut("slow");
            $('.menu').fadeIn("slow");
		}
	</script>
<script type="text/javascript">
 function delete_row(id)
    {
        if (confirm("Are you sure want to delete widget?") == true) {
			var id = id;
			$.ajax({
				type: 'POST',
				data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
				url:"<?php echo site_url($customer_admin['dashboard_url'].'/widgets/delete');?>/"+id,
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
           
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
                    </div>
                    
					                        
                        
                    <div class="content-frame-body">
                    
                        <div class="panel panel-default" id="editpro">
                        
                            <div class="panel-body">
					
                                <div class="block">
                                    <a href="<?php echo site_url($customer_admin['dashboard_url']);?>/widgets/create" id="showmenu" class="showmenu btn btn-danger btn-lg" style="margin-bottom:20px;"><span class="fa fa-edit"></span> Add Widget</a>
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
                                

								<div class="block in_menu">
									
									<div class="table-responsive">	
                                        <table id="listProducts" class="table table-striped">
                                            <thead><tr><th>Id</th><th>Widget name</th><th>Widget type</th><th>Display limit</th><th>Section title</th><th class="blank_field">Action</th></tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($widgets as $key => $widget):?>
                                                    <tr>
                                                        <td><?php echo $widget->id;?></td>
                                                        <td><?php echo $widget->name;?></td>
                                                        <td><?php echo $widget->widget_type_name;?></td>
                                                        <td><?php echo $widget->page_limit;?></td>
                                                        <td><?php echo $widget->section_title;?></td>
                                                        <td>
                                                            <a href="<?php echo site_url($customer_admin['dashboard_url'].'/widgets/edit/'.$widget->id);?>">Edit</a> | 
                                                            <a href="javascript:void(0);" onclick="delete_row(<?php echo $widget->id;?>)">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table> 
                                    </div>       

								</div>
                          
                                
                            </div>
                                                      
                        </div>
                      

						<!-- END CONTENT FRAME BODY -->
					</div>
				<!-- END CONTENT FRAME -->
				</div>
                
                <?php $this->load->view($selected_template_path.'/common/script');?>