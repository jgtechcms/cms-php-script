 <style>
							  #fileselector {
									margin: 10px; 
									margin-left: 0px; 
								}
								#upload-file-selector {
									display:none;   
								}
								#uploadfile {
									background:#1caf9a;
									    border-radius: 5px;
								}
								#uploadfile:hover {
									background:#262a33;  
									color:#fff;
								}
								.margin-correction {
									margin-right: 10px;   
								}
                              </style>
							  
							  
				<div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 
				
									
				
				<!-- START CONTENT FRAME LEFT -->
				<div class="panel panel-default" id="editpro">
                            
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
							<a href="<?php echo site_url($customer_admin['dashboard_url'].'/sponsors/add');?>" class="showmenu btn btn-danger btn-lg" style="margin-top:20px;"><span class="fa fa-edit"></span> 
							Add Sponsor
							</a>                          
							<!-- <a href="javascript:void(0)" id="showmenu_order" class="showmenu_order btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> Arrange the Menu Order</a>-->
						</div>
						<div class="block in_menu" style="margin-top:30px;">
							<div class="table-responsive">
                            <table id="listProducts" class="table display">
								<thead><tr> <th>Id</th><th>Name</th><th>Url </th>
								<th class="blank_field">Action</th></tr>
								</thead>
								<tbody>
									<?php foreach($sponsors as $key => $row):?>
										<tr>
											<td><?php echo $row->id;?></td>
											<td><?php echo $row->name;?></td>
											<td><?php echo $row->url;?></td>
											<td>
												<a href="<?php echo site_url($customer_admin['dashboard_url'].'/sponsors/edit/'.$row->id);?>">Edit</a> | 
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

	/** Edit Enquiry Start **/

    $(document).on("click", ".prolistedit", edit_menu_details);
	function edit_menu_details(){
	var id= $(this).attr('id');  
	$('#pro').hide();
	$('#editpro').fadeIn("slow");
	
	$.ajax({
		type: 'POST',
		data:{id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
		url: '<?php echo site_url($customer_admin['dashboard_url'].'/sponsors/get_data');?>',
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
		$('#old_icon').val(res.view_details.icon);
		
		var icon_thumb = '<img src="<?php echo site_url();?>'+res.view_details.icon_thumb+'" >';
		$('#icon_thumb').html(icon_thumb);
	}
	
	/** Edit Enquiry End **/
	
</script>

<script type="text/javascript">

/** Delete Enquiry Start **/

function deleteRow(id)
{
	if (confirm("Are you sure want to delete the selected social media?") == true) {
		var id = id;
		window.location.href = "<?php echo site_url($customer_admin['dashboard_url'].'/sponsors/delete');?>/"+id;
	}
}

function deleteRow(id)
{
	if (confirm("Are you sure want to delete the selected social media?") == true) {
	var id = id;
	$.ajax({
		url:"<?php echo site_url($customer_admin['dashboard_url'].'/sponsors/delete');?>/"+id,
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

/** Delete Enquiry End **/

</script>