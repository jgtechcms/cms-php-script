
 
				<div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div>  
                                
                <!-- START CONTENT FRAME -->
                <div class="panel panel-default">
                            
                    <div class="panel-body">
					
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
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/article/add');?>" id="showmenu" class="showmenu btn btn-danger btn-lg"><span class="fa fa-edit"></span> Add Post</a>
							</div>
						
                        <div class="block in_menu" style="margin-top:30px;">
                            <table id="listProducts" class="table display" cellspacing="0" width="100%">
								<thead><tr> <th>Id</th><th>Name</th><th>Category Id</th>
								<th class="blank_field">Action</th></tr>
								</thead>
								<tbody>
									<?php foreach($articles as $key => $row):?>
										<tr>
											<td><?php echo $row->id;?></td>
											<td><?php echo $row->title;?></td>
											<td><?php echo $row->article_category_id;?></td>
											<td>
												<a href="<?php echo site_url($customer_admin['dashboard_url'].'/article/edit/'.$row->id);?>">Edit</a> | 
												<a href="javascript:void(0);" onclick="deleteRow(<?php echo $row->id;?>)">Delete</a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
							                       
                        </div>
                        
                    </div>
			</div>
                    <!-- END CONTENT FRAME LEFT -->
					
<?php $this->load->view($selected_template_path.'/common/script');?>

 <script>
    $(document).on("click", ".prolistedit", edit_menu_details);
	function edit_menu_details(){
		var id= $(this).attr('id'); 
		
		$('#title_type').html('Edit');
		$('#btnadd').val('Update');
		
		$('#frmAdd')[0].reset();
		
		$.ajax({
			type: 'POST',
			data: {id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
			url: '<?php echo site_url($customer_admin['dashboard_url'].'/article/get_pages');?>',
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
function renderListform(res){ 
	$('#id').val(res.view_details.id); 
	$('#title').val(res.view_details.title);
	$('#meta_tag').val(res.view_details.meta_tag);
	$('#meta_desc').val(res.view_details.meta_description);
	$('#article_category_id').val(res.view_details.article_category_id);	
	$(tinymce.get('body_desc').getBody()).html(res.view_details.body_desc);
	
	$('.article_category_id').selectpicker('refresh');
	
}
    </script>



<script type="text/javascript">
$(document).on("click", ".showmenu", showmenu);
	function showmenu(){
		$('.editpro').fadeOut("slow");
            $('.menu').fadeIn("slow");
		}
	</script>
    
    <script type="text/javascript">
 function deleteRow(id)
    {
        if (confirm("Are you sure want to delete the post?") == true) {
        var id = id;
        $.ajax({
            url:"<?php echo site_url($customer_admin['dashboard_url'].'/article/delete');?>/"+id,
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
			}
               
            });
        }
    }

</script>