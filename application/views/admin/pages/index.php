 <?php
 $edit_id = $this -> input -> post('id');
 $edit_mode = false;
 if($edit_id)
	 $edit_mode = true;
 ?>
<style>
.placeholder {
    position: absolute;
    top: 434px;
    left: 26px;
    pointer-events: none;
	color:#a9a7a7;
}

td p{ text-align:justify;}	

.layout-section{
	border: 1px solid #e6e6e6;
    padding: 10px 0;
    display: table;
}
a.blockShadow{color:#22262e;display: block;text-decoration: none;margin-bottom: 20px;}
a.blockShadow:hover {
    box-shadow: 0px 0px 6px #428bca;
}

.more span{ display:none;}
.more:hover span { display:inline-block; color: #ee2e23; z-index:1; position:absolute; top:0%; right:15px; background:#333; color:#fff; cursor: default; padding:5px;}
</style>            
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <div class="row">
					<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
					</div>
                    
					                    
					
                    <!-- START CONTENT FRAME LEFT -->
                    <div class="panel panel-default">
					<div class="panel-body">
                        <div class="block">
                            <a href="<?php echo site_url($customer_admin['dashboard_url'].'/pages/add');?>" class="showmenu btn btn-danger btn-lg" style="margin-bottom:20px;"><span class="fa fa-edit"></span> Add Page Content</a>
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
                            <table id="listProducts" class="table display" cellspacing="0" width="100%">
								<thead><tr> <th>Id</th><th>Menu Name</th><th>H1 Title</th><th>Page Title </th>
								<th class="blank_field">Action</th></tr>
								</thead>
								<tbody>
									<?php foreach($pages as $key => $row):?>
										<tr>
											<td><?php echo $row->id;?></td>
											<td><?php echo $row->menu_title;?></td>
											<td><?php echo $row->h1_title;?></td>
											<td><?php echo $row->title;?></td>
											<td>
												<a href="<?php echo site_url($customer_admin['dashboard_url'].'/pages/edit/'.$row->id);?>">Edit</a> | 
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
                    <!-- END CONTENT FRAME LEFT -->
			</div>
                 
				
<?php $this->load->view($selected_template_path.'/common/script');?>


<script>
    setTimeout(function() {$(".alert").addClass('hidden').slideUp("slow") ; }, 10000);
	
	/**
 *Add Form
 */		

 
</script>

    
    <script type="text/javascript">
 function deleteRow(id)
    {
        if (confirm("Are you sure want to delete the selected page?") == true) {
        var id = id;
        $('#hide'+id).show();
		$.ajax({
			type: 'POST',
			data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
			url:"<?php echo site_url($customer_admin['dashboard_url'].'/pages/delete');?>/"+id,
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