<?php
function getPageName($page_type, $page_types)
{
	foreach($page_types as $pagetype) {
		
		if($page_type == $pagetype->slug)
			return $pagetype->name;
	}
	
	return $page_type;
}
?>
   <div class="content-frame">                                    
	<div class="row">
		<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
		</div>
                    
					                    
					
			<div class="content-frame-body menu">
				
				<div class="panel panel-default">
					
					<div class="panel-body">
						<div class="block">
                            <a href="<?php echo site_url($customer_admin['dashboard_url'].'/menu/add');?>" id="showmenu" class="showmenu btn btn-danger btn-lg" style="margin-bottom:20px;"><span class="fa fa-edit"></span> 
							Add Menu
							</a>                          
                            <!-- <a href="javascript:void(0)" id="showmenu_order" class="showmenu_order btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> Arrange the Menu Order</a>-->
                        </div>
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
                            <table id="listProducts" class="table display">
								<thead><tr> <th>Id</th><th>Title</th><th>Slug </th><th>Order by </th><th>Page type</th>
								<th class="blank_field">Action</th></tr>
								</thead>
								<tbody>
									<?php foreach($menu as $key => $row):?>
										<tr>
											<td><?php echo $row->id;?></td>
											<td><?php echo $row->title;?></td>
											<td><?php echo $row->slug;?></td>
											<td><?php echo $row->order_by;?></td>
											<td><?php echo getPageName($row->page_type, $page_types);?></td>
											<td>
												<a href="<?php echo site_url($customer_admin['dashboard_url'].'/menu/edit/'.$row->id);?>">Edit</a> | 
												<a href="javascript:void(0);" onclick="deleteRow(<?php echo $row->id;?>)">Delete</a>
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
                    <!-- END CONTENT FRAME LEFT -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    
        </div>                
                       
				<?php $this->load->view($selected_template_path.'/common/script');?>
				
				<script>

				$(document).on("click", ".prolistedit", edit_menu_details);
					function edit_menu_details(){
					var id= $(this).attr('id');  
					$('#pro').hide();
					$('#editpro').fadeIn("slow");
					
					$(".editpro .alert-danger").addClass('hidden') ;
					$(".editpro .alert-success").addClass('hidden') ;
					
					$.ajax({
						type: 'POST',
						data: {id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
						url: '<?php echo site_url($customer_admin['dashboard_url'].'/menu/get_menu');?>',
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
					$('#slug').val(res.view_details.slug);
					$('#order_by').val(res.view_details.order_by);
					$('#cnt input').filter(':checkbox').prop('checked',false);
					$('#rad input[value='+res.view_details.page_type_id+']').filter(':radio').prop('checked',true);
					$('#parent_id').val(res.view_details.parent_id);
					$('#fa_icon_value').val(res.view_details.fa_icon_value);
					$('.parent_id').selectpicker('refresh');
					 // $('select[name="page_type_id"]').val(res.view_details.page_type_id); 
					  
					var myArray=[];
					if(res.view_details.m_t_id)
						myArray = res.view_details.m_t_id.split(',');	
					
					 for(var i=0;i<myArray.length;i++){      
						 $('#cnt input[value='+myArray[i]+']').filter(':checkbox').prop('checked',true);
					}
					var page_type = res.view_details.page_type;
					$(".editpro input[name=dynamic_page_type][value="+page_type+"]").prop('checked', true);
					
				}
					</script>

				<script>
					setTimeout(function() {$(".alert").addClass('hidden').slideUp("slow") ; }, 10000);
					
					/**
				 *Add Form
				 */		
				$(document).on("click", "#btnadd", add);
						function add(){
							var post = $("#frmAdd").serialize();
							$(".spinner").removeClass('hidden') ;
							$.post('<?php echo site_url($customer_admin['dashboard_url']);?>/menu/add', post, function(data){
									var result = $.parseJSON(data) ;					
									if(result.status == 0 )
									{$(".menu .alert-success").addClass('hidden') ;
										$(".menu .alert-danger").html(result.statusmsg).removeClass('hidden');	
									}
									else {
									$(".menu .alert-danger").addClass('hidden') ;
									//$('.menu #title').val('');
									//$(".menu .alert-success").html(result.statusmsg).removeClass('hidden');
									location.reload(); 
								$(".spinner").addClass('hidden') ;}
							})
						}
				</script>
				<script type="text/javascript">
					/**
				 *Updated Form 
				 */	
						
				$(document).on("click", "#btnedit", edits);
				 function edits(){
							$(".editpro .alert-danger").addClass('hidden') ;
							$(".editpro .alert-success").addClass('hidden') ;
							
							var post = $("#frmEdit").serialize();
							$(".spinner").removeClass('hidden') ;
							$.post('<?php echo site_url($customer_admin['dashboard_url'].'/menu/edit');?>', post, function(data){
									var result = $.parseJSON(data) ; 					
									if(result.status == 0 )
									{
										$(".editpro .alert-success").addClass('hidden') ;
										$(".editpro .alert-danger").html(result.statusmsg).removeClass('hidden');	
									}
									else {
									$(".editpro .alert-danger").addClass('hidden') ;
									$(".editpro .alert-success").html(result.statusmsg).removeClass('hidden');
									//location.reload(); 
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
						
						$(document).on("click", ".showmenu_order", showmenu_order);
					function showmenu_order(){
						$('.editpro').fadeOut("slow");
							$('.menu').fadeOut("slow");
							 $('.menu_order').fadeIn("slow");
						}
						
					</script>
					
				<script type="text/javascript">
				 function deleteRow(id)
					{
						
						if (confirm("Are you sure want to delete the selected menu?") == true) {
						  var id = id;
						$('#hide'+id).show();
						$.ajax({
							type: 'POST',
							data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
							url:"<?php echo site_url($customer_admin['dashboard_url'].'/menu/delete');?>/"+id,
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