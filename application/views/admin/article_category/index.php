
	<div class="content-frame">                                    
                <div class="row">
				<?php $this->load->view($selected_template_path.'/components/breadcrumb'); ?>
				</div> 
                
                <div class="content-frame-body menu">
                        
                        <div class="panel panel-default">
                            <?php /*<div class="panel-heading">
                               <h4 style="margin:0; padding:0;">View Enquiry Details</h4>
                            </div>*/?>
                            <div class="panel-body">
                            
                                	<div class="block">
                                        <a href="<?php echo site_url($customer_admin['dashboard_url']);?>/article_category/" class="btn btn-danger btn-lg"><span class="fa fa-edit"></span> 
                                        Add Category
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
                                <div class="col-md-6">                                        
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 style="margin:0; padding:0;">List of Categories <span class="badge badge-success"><?php echo count($article_categories);?></span></h4>
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
                                                	<?php if(count($article_categories)): foreach($article_categories as $article_categories): ?>	
                                                    <tr>
                                                    	<td><?php echo $article_categories->id;?></td>
                                                    	<td><?php echo $article_categories->name;?></td>
                                                    	<td><a href="javascript:void(0);" class="prolistedit" id="<?php echo $article_categories->id;?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteDomain(<?php echo $article_categories->id;?>)">Delete</a></td>
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
                                
                                <div class="col-md-6 menu" id="pro"  >
                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 style="margin:0; padding:0;">Add Category</h4>
                                        </div>
                                        <div class="panel-body">
                                            
                                            <!--Add Menu Type Form-->
                                            <div class="col-md-8">
                                                    <form method="POST" role="form" id="frmAdd" enctype="multipart/form-data"> 
                                                  <div class="form-group required"> <label  class="">Name</label>
                                                   <input type="text" name="name"  class="form-control" value="">   </div>                   
                                                   <div class="form-group">   <button type="submit"  id="addbtn" class="btn btn-primary btnadd">Add</button> <!--<input type="button" value="Save" class="btn btn-primary btnadd" id="btnadd" />-->  </div>     
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">             
                                            </form></div></div>
                
                                      
                                            
                                        </div>
                                                                   
                                    </div>
    
    
    								<div class="col-md-6 editpro" id="editpro"  style="display:none" >
                    
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                               <h4 style="margin:0; padding:0;">Edit Category</h4>
                                            </div>
                                            <div class="panel-body">
                                                
                                                <!--Add Menu Type Form-->
                    
                                                <div class="col-md-8">
                                                <form method="POST" role="form" id="frmEdit"> 
                                                
                                                <div class="form-group required"> <label  class="">Name </label>
                                                <input type="hidden" name="id" id="id"  class="form-control" value="">
                                                <input type="text" name="name" id="name"  class="form-control" value="">   </div>
                                                <!--<div class="form-group"> <label  class="">Url</label>
                                                <input type="text" name="slug" id="slug"  class="form-control" value="">   </div>-->
                                                <div class="form-group">  <input type="submit" value="Update" class="btn btn-primary" id="btnedit" />  </div>     
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">      
                                                </form></div>
                    
                    
                    <!--Edit Menu Type Form-->
                                          
                                                
                                            </div>
                                                                      
                                        </div>
                                      
                    
                                    <!-- END CONTENT FRAME BODY -->
                                </div>
                                
                                </div>	
            				
                            </div>
                        </div>
                 </div>
        </div>
    								

<?php $this->load->view($selected_template_path.'/common/script');?>

 <script>
$(document).on("click", ".prolistedit", edit_menu_details);
function edit_menu_details(){
	$(".alert-danger").addClass('hidden') ;
	$(".alert-success").addClass('hidden') ;
	var id= $(this).attr('id');  
	$('#pro').hide();
	$('#editpro').show();
	
	$.ajax({
		type: 'POST',
		data:{id:id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
		url: '<?php echo site_url($customer_admin['dashboard_url'].'/article_category/get');?>',
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
	$('#name').val(res.view_details.name);
	//$('#slug').val(res.view_details.slug);
	
	$('html,body').animate({
        scrollTop: $("#editpro").offset().top},
        'slow');
}


    </script>

<script>
    setTimeout(function() {$(".alert").addClass('hidden').slideUp("slow") ; }, 10000);
	
	$('html,body').animate({
        scrollTop: $("#pro").offset().top},
        'slow');
	
	/**
 *Add Form
 */		
 $(document).ready(function (e){
		$('#data_table').DataTable({searching: false, bInfo: false, lengthChange: false});
		
		$("#frmAdd").on('submit',(function(e){
		e.preventDefault();
		$.ajax({
			url: "<?php echo site_url($customer_admin['dashboard_url']);?>/article_category/add",
			type: "POST",
			data:  new FormData(this),
				beforeSend: function(){
					$('.image_loader').show();
					},
					complete: function(){
					$('.image_loader').hide();
					},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
			var result = $.parseJSON(data) ;					
			if(result.status == 0 )
			{$(".alert-success").addClass('hidden') ;
				$(".alert-danger").html(result.statusmsg).removeClass('hidden');
				$('html,body').animate({scrollTop:0},0);
			}
			else {
			//$(".alert-danger").addClass('hidden') ;
			//$('#title').val('');
			//$(".alert-success").html(result.statusmsg).removeClass('hidden');
			location.reload(); 
						//$(".spinner").addClass('hidden') ;
						}
		/*$("#addpro")[0].reset();
		$("#add_preview").css("display","none");*/
		}           
		});
		}));
});
</script>
<script type="text/javascript">
	/**
 *Updated Form 
 */	
$(document).ready(function (e){
	$("#frmEdit").on('submit',(function(e){
		e.preventDefault();
		$.ajax({
		url: "<?php echo site_url($customer_admin['dashboard_url']);?>/article_category/edit",
		type: "POST",
		data:  new FormData(this),
		beforeSend: function(){
			$('.image_loader').show();
			},
			complete: function(){
			$('.image_loader').hide();
			},
		contentType: false,
		cache: false,
		processData:false,
		success: function(data){
		var result = $.parseJSON(data) ;					
			if(result.status == 0 )
			{
				$(".alert-success").addClass('hidden') ;
				$(".alert-danger").html(result.statusmsg).removeClass('hidden');
				$('html,body').animate({scrollTop:0},0);
			}
			else 
			{
				//$(".editpro .alert-danger").addClass('hidden') ;
				//$('.editpro #title').val('');
				//$(".editpro .alert-success").html(result.statusmsg).removeClass('hidden');
				location.reload(); 
				//$(".spinner").addClass('hidden') ;
			}
			/*$("#addpro")[0].reset();
			$("#add_preview").css("display","none");*/
		}           
	});
	}));
});		
</script>
<script type="text/javascript">
$(document).on("click", ".showmenu", showmenu);
	function showmenu(){
		$('.editpro').hide();
            $('.menu').show();
		}
	</script>
<script type="text/javascript">
 function deleteDomain(id)
    {
        if (confirm("Are you sure want to delete category?") == true) {
        var id = id;
        //$('#hide'+id).show();
        $.ajax({
            url:"<?php echo site_url($customer_admin['dashboard_url'].'/article_category/delete');?>/"+id,
            //dataType: "json", // data type of response		
			success:function(result)
			{
				location.reload();
				/*
				if(result.status == 0 )
				{
					$(".alert-success").addClass('hidden') ;
					$(".alert-danger").html(result.statusmsg).removeClass('hidden');
				}
				else 
				{
					location.reload();
				}*/
			}
               
            });
        }
    }

</script>