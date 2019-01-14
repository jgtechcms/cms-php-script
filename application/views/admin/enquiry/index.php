			<div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
					</div>
                                
			<!-- START CONTENT FRAME -->
			<div class="row">   
									
				
				<!-- START CONTENT FRAME LEFT -->
				<div class="col-md-12 col-xs-12">
					<!--<div class="block">
						<a href="javascript:void(0)" id="showmenu" class="showmenu btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> Add a Menu Type</a>
					</div>-->
					<div class="panel panel-default" id="editpro">
                            
                            <div class="panel-body">
							<table id="listProducts" class="table table-striped table-bordered">
								<thead><tr> <th>Id</th>
                                            <th>Date</th><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($enquiry as $key => $row):?>
										<tr>
											<td><?php echo $row->id;?></td>
                                          <td><?php echo date('j', strtotime($row->created));?> <?php echo date('M', strtotime($row->created)), ' ', date('Y', strtotime($row->created));?> </td>
											<td><?php echo $row->name;?></td>
											<td><?php echo $row->email;?></td>
											<td><?php echo $row->phone;?></td>
											<td><?php echo $row->subject;?></td>
											<td><?php echo $row->message;?></td>
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
	
	$(".editpro .alert-danger").addClass('hidden') ;
	$(".editpro .alert-success").addClass('hidden') ;
	
	$.ajax({
		type: 'POST',
		data:{id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
		url: '<?php echo site_url($customer_admin['dashboard_url']).'/enquiry/get_data';?>',
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
		$('#email').val(res.view_details.email);
		$('#phone').val(res.view_details.phone);
		$('#subject').val(res.view_details.subject);
		$('#action_taken').val(res.view_details.action_taken);
		$('#message').val(res.view_details.message);	
	}
	
	/** Edit Enquiry End **/
	
</script>
	
	

<script>
    setTimeout(function() {$(".alert").addClass('hidden').slideUp("slow") ; }, 20000);
			
</script>

<script type="text/javascript">

	/** Update Enquiry **/
	$(document).on("click", "#btnedit", ed);
		function ed(){ 
			var post = $("#frmEdit").serialize();
			$(".spinner").removeClass('hidden') ;
			$.post('<?php echo site_url($customer_admin['dashboard_url']).'/enquiry/edit';?>', post, function(data){
					var result = $.parseJSON(data) ;					
					if(result.status == 0 )
					{$(".editpro .alert-success").addClass('hidden') ;
						$(".editpro .alert-danger").html(result.statusmsg).removeClass('hidden');	
					}
					else {
					$(".editpro .alert-danger").addClass('hidden') ;
					$('.editpro #title').val('');
					$(".editpro .alert-success").html(result.statusmsg).removeClass('hidden');
				$(".spinner").addClass('hidden') ;}
			})
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

/** Delete Enquiry Start **/

function deleteDomain(id)
{
	if (confirm("Are you sure!") == true) {
	var id = id;
	$('#hide'+id).show();
	$.ajax({
		url:"<?php echo site_url($customer_admin['dashboard_url']).'/enquiry/delete';?>/"+id,
		success:function(data)
		{
	   
		$('#'+id).hide();
		location.reload();
		   
		},
		   
		});
	}
}

/** Delete Enquiry End **/

</script>
          