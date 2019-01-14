
				<div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div>  
				
				<div class="panel panel-default" id="editpro">
                            
                    <div class="panel-body"><?php								
						$success_message = $this->session->flashdata('success_message');
						$error_message1 = $this->session->flashdata('error_message');
						if($error_message):
						?>
						<div class="alert alert-danger"><?php echo $error_message;?></div>
                        <?php elseif($error_message1):?>
						<div class="alert alert-danger"><?php echo $error_message1;?></div>
						<?php endif;?>
						<?php if($success_message):?>
						<div class="alert alert-success"><?php echo $success_message;?></div>
						<?php endif;?>
						
                        <div class="block">
                            <a href="<?php echo site_url($customer_admin['dashboard_url'].'/testimonials/add');?>" id="showmenu" class="showmenu btn btn-danger btn-lg"><span class="fa fa-edit"></span> Add Testimonial</a>
                        </div>
						<div class="block in_menu" style="margin-top:30px;">
							<div class="table-responsive">
                            <table id="listProducts" class="table display">
								<thead><tr> <th>Id</th><th>Name</th><th>Company name</th><th>Company url</th>
								<th class="blank_field">Action</th></tr>
								</thead>
								<tbody>
									<?php foreach($articles as $key => $row):?>
										<tr>
											<td><?php echo $row->id;?></td>
											<td><?php echo $row->title;?></td>
											<td><?php echo $row->company;?></td>
											<td><?php echo $row->company_url;?></td>
											<td>
												<a href="<?php echo site_url($customer_admin['dashboard_url'].'/testimonials/edit/'.$row->id);?>">Edit</a> | 
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
					
		</div>		
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
			url: '<?php echo site_url($customer_admin['dashboard_url'].'/testimonials/get_pages');?>',
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
	$('#company').val(res.view_details.company);
	$('#company_url').val(res.view_details.company_url);
	$('#title').val(res.view_details.title);
	$('#body_desc').val(res.view_details.body_desc);
	
	$('#old_file').val(res.view_details.image_name);
	
	var icon_thumb = '<img src="<?php echo site_url();?>'+res.view_details.file_thumb+'" >';
	$('#icon_thumb').html(icon_thumb);
	
}
    </script>


    
    <script type="text/javascript">
 function deleteRow(id)
    {
        if (confirm("Are you sure want to delete the selected testimonial?") == true) {
			var id = id;
			
			$.ajax({          
				url:"<?php echo site_url($customer_admin['dashboard_url'].'/testimonials/delete');?>/"+id,	
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