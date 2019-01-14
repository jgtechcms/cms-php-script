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
		$('#old_icon').val(res.view_details.icon);
		
		var icon_thumb = '<img src="<?php echo site_url();?>'+res.view_details.icon_thumb+'" >';
		$('#icon_thumb').html(icon_thumb);
	}
	
	/** Edit Enquiry End **/
	
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
	if (confirm("Are you sure want to delete the selected social media?") == true) {
		var id = id;
		window.location.href = "<?php echo site_url($customer_admin['dashboard_url'].'/social_media/delete');?>/"+id;
	}
}

/** Delete Enquiry End **/

</script>
              
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
                    <!-- END CONTENT FRAME TOP -->
                    
					                    
					
                    <!-- START CONTENT FRAME LEFT -->
                    <div class="content-frame-left">
                        <div class="block">
                            <a href="javascript:void(0)" id="showmenu" class="showmenu btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> Add Social Media</a>
                        </div>
						<div class="block in_menu">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item active"><span class="fa fa-inbox"></span> List of Social Media <span class="badge badge-success"><?php echo count($social_medias);?></span></a>
                                <?php if(count($social_medias)): foreach($social_medias as $social_media): ?>	
									<a href="javascript:void(0);"  class="prolistedit list-group-item" id="<?php echo $social_media->id;?>" ><span class="fa fa-star"></span> <?php echo $social_media->name;?> <span class="badge badge-warning" onclick="deleteDomain(<?php echo $social_media->id;?>)">X</span></a><?php endforeach; ?>
								<?php else: ?>
										We could not find any social media.
								<?php endif; ?>	                     
                            </div>                        
                        </div>
                        
                    </div>
                    <!-- END CONTENT FRAME LEFT -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body menu" id="pro"  >
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <h4 style="margin:0; padding:0;">Add Social Media</h4>
                            </div>
                            <div class="panel-body">
                                
                                <!--Add Menu Type Form-->
								<?php
								$success_message = $this->session->flashdata('success_message');
								if($error_message):
								?>
								<div class="alert alert-danger"><?php echo $error_message;?></div>
								<?php endif;?>
								<?php if($success_message):?>
								<div class="alert alert-success"><?php echo $success_message;?></div>
								<?php endif;?>
								<div class="col-md-8">
									<form action="<?php echo site_url($customer_admin['dashboard_url'].'/social_media/');?>" method="POST" role="form" id="frmAdd" enctype="multipart/form-data">
										<div class="form-group"> <label  class="">Name <span>*</span></label>
										<input type="text" name="name"   class="form-control" value="<?php echo set_value('name')?>" >   
										</div>      
										<div class="form-group"> <label  class="">Icon <span>*</span></label> 
										
										<div style="clear:both;"></div>
<input id="uploadFile" placeholder="Choose File" disabled="disabled" class="upload_txt_box"  style=" "/>
<div class="fileUpload btn btn-primary">
    <span> Upload</span>
    <input id="product_image" type="file" name="icon" class="upload" />
</div>
<div style="clear:both;"></div>

		<script>
			document.getElementById("product_image").onchange = function () {
				document.getElementById("uploadFile").value = this.value;
			};
		</script>
		<style>
		.upload_txt_box{
				float:left;
				padding: 4px 12px;
				font-size: 14px;
				line-height: 1.42857143;
				color: #555;   
				border: 1px solid #ccc;
				border-radius: 4px;
				-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
				-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
				-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
				transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			}
			.fileUpload {
				position: relative;
				overflow: hidden; margin-left:2px;
				
			}
			.fileUpload input.upload {
				position: absolute;
				top: 0;
				right: 0;
				margin: 0;
				padding: 0;
				font-size: 20px;
				cursor: pointer;
				opacity: 0;
				filter: alpha(opacity=0);
			}
		</style>
										
										
										 <!--<div id="fileselector">
												<label class="btn btn-default" id="uploadfile" for="upload-file-selector">
										<input type="file" id="upload-file-selector" name="icon"/><i class="glyphicon glyphicon-search" style="margin-top: 1px;"></i>Browse</label>
												</div>-->
										[width x height: <?php echo $this->config->item('social_icon_width') . ' x ' . $this->config->item('social_icon_height');?>]
										</div>  
										<div class="form-group"> <label  class="">URL <span>*</span></label>
										<input type="text" name="url" placeholder="http://" class="form-control" value="<?php echo set_value('url')?>" >
										</div>  
										<div class="form-group"> <label  class="">Status</label>
											<select name="status">
												<option value="1" selected>Active</option>
												<option value="0">In-Active</option>
											</select>
										</div>  
										
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										                  
										<div class="form-group">  <input type="submit" value="Save" class="btn btn-primary" id="btnadd" />  </div>   

									</form>
								</div>
							</div>
						
						</div>

                          
                                
                    </div>
                            
                        
                        
                    <div class="content-frame-body editpro" id="editpro"  style="display:none" >
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <h4 style="margin:0; padding:0;">Edit Social Media</h4>
                            </div>
                            <div class="panel-body">
                                
                                <!--Edit Menu Type Form-->

								<div class="alert alert-danger hidden"></div>
								<div class="alert alert-success hidden"></div>

								<div class="col-md-8">
									<form action="<?php echo site_url($customer_admin['dashboard_url'].'/social_media/');?>" method="POST" role="form" id="frmEdit" enctype="multipart/form-data">
										<input type="hidden" name="id" id="id" value="" />
										<input type="hidden" name="old_icon" id="old_icon" value="" />
										<div class="form-group"> <label  class="">Name <span>*</span></label>
										<input type="text" name="name" id="name"  class="form-control" value="" >   </div>      
										<div class="form-group"> <label  class="">Icon <span>*</span></label> 
										<div style="clear:both;"></div>
<input id="uploadFile" placeholder="Choose File" disabled="disabled" class="upload_txt_box"  style=" "/>
<div class="fileUpload btn btn-primary">
    <span> Upload</span>
    <input id="icon" type="file" name="icon" class="upload" />
</div>
<div style="clear:both;"></div>

		<script>
			document.getElementById("icon").onchange = function () {
				document.getElementById("uploadFile").value = this.value;
			};
		</script>
											<!--<input type="file" name="icon"/>-->
											[width x height: <?php echo $this->config->item('social_icon_width') . ' x ' . $this->config->item('social_icon_height');?>]
											<div id="icon_thumb"></div>
										</div>  
										<div class="form-group"> <label  class="">URL <span>*</span></label>
										<input type="text" name="url" id="url"  class="form-control" value="" >   </div>  
										<div class="form-group"> <label  class="">Status</label>
											<select name="status" id="status">
												<option value="1" selected>Active</option>
												<option value="0">In-Active</option>
											</select>
										</div> 

									
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									                  
										<div class="form-group">  <input type="submit" value="Update" class="btn btn-primary" id="btnedit" />  </div>    

									</form>
								</div>


                          
                                
                            </div>
                                                      
                        </div>
					
					</div>
                      

                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->