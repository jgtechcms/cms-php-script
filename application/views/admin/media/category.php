


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
                                        <a href="<?php echo site_url($customer_admin['dashboard_url']);?>/media/category/" class="btn btn-danger btn-lg"><span class="fa fa-edit"></span> 
                                        Add Gallery Category
                                        </a>  
                                    </div>
                                 <br />
                                
                				<!-- START CONTENT FRAME -->
              				  <div class="row">  
                            
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
                    
					                    
					
                    <!-- START CONTENT FRAME LEFT -->
                                <div class="col-md-6">                                        
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 style="margin:0; padding:0;">List of Gallery Category <span class="badge badge-success"><?php echo count($cat);?></span></h4>
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
                                                	<?php if(count($cat)): foreach($cat as $cat): ?>
                                                    <tr>
                                                    	<td><?php echo $cat->id;?></td>
                                                    	<td><?php echo $cat->title;?></td>
                                                    	<td><a href="javascript:void(0);" class="prolistedit" id="<?php echo $cat->id;?>">Edit</a> | <a href="javascript:void(0);" onclick="deleteDomain(<?php echo $cat->id;?>)">Delete</a></td>
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
                                
                                    <!-- END CONTENT FRAME LEFT -->
                                    
                                    <!-- START CONTENT FRAME BODY -->
                                    
                                    <!--  Add Menu -->
                                    <div class="col-md-6 menu" id="pro"  >
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                               <h4 style="margin:0; padding:0;">Add Gallery Category</h4>
                                            </div>
                                            <div class="panel-body">
                                                
                                                <!--Add Menu Type Form-->                
                                                <div class="col-md-8">
                                                    <form method="POST" role="form" id="frmAdd"> 
                                                        
                                                        <div class="form-group required"> <label  class="">Title</label>
                                                        <input type="text" name="title"  class="form-control" value="">   </div> 
                                                        <!--<div class="form-group"> <label  class="">Url</label>
                                                        <input type="text" name="slug"  class="form-control" value="">   </div> -->
                
                                                        <div class="form-group">  <input type="button" value="Add" class="btn btn-primary btnadd" id="btnadd" />  </div>     
                                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">		 
                                                    </form>
                                                </div>
                                            </div>                          
                                                
                                        </div>
                                                                   
                                    </div>
                        
                        
                       				<!--Edit Menu--> 
                                     <div class="col-md-6 editpro" id="editpro"  style="display:none" >
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 style="margin:0; padding:0;">Edit Gallery Category</h4>
                                        </div>
                                        <div class="panel-body">
                                            
                                            <!--Add Menu Type Form-->
            
                                            <div class="col-md-8">
                                            <form method="POST" role="form" id="frmEdit"> 
                                            
                                            <div class="form-group required"> <label  class="">Title </label>
                                            <input type="hidden" name="id" id="id"  class="form-control" value="">
                                            <input type="text" name="title" id="title"  class="form-control" value="">   </div>
                                            <!--<div class="form-group"> <label  class="">Url</label>
                                            <input type="text" name="slug" id="slug"  class="form-control" value="">   </div>-->
                                            <div class="form-group">  <input type="button" value="Update" class="btn btn-primary" id="btnedit" />  </div>     
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
$(document).ready(function(){
	
	$('#data_table').DataTable({searching: false, bInfo: false, lengthChange: false});//{"bInfo": false}
});
</script>
<script>
    $(document).on("click", ".prolistedit", edit_menu_details);
	function edit_menu_details(){
	var id= $(this).attr('id');  
	$('#pro').hide();
	$('#editpro').show();
	
	$(".alert-danger").addClass('hidden') ;
	$(".alert-success").addClass('hidden') ;
	
	$.ajax({
		type: 'POST',
		data: {id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
		url: '<?php echo site_url($customer_admin['dashboard_url'].'/media/get_gal_cat');?>',
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
$(document).on("click", "#btnadd", add);
		function add(){
			var post = $("#frmAdd").serialize();
			$(".spinner").removeClass('hidden') ;
			$.post('<?php echo site_url($customer_admin['dashboard_url']);?>/media/gal_cat_add', post, function(data){
					var result = $.parseJSON(data) ;					
					if(result.status == 0 )
					{$(".alert-success").addClass('hidden') ;
						$(".alert-danger").html(result.statusmsg).removeClass('hidden');
						$('html,body').animate({scrollTop:0},0);
					}
					else {
					//$(".menu .alert-danger").addClass('hidden') ;
					//$('.menu #title').val('');
					//$(".menu .alert-success").html(result.statusmsg).removeClass('hidden');
					location.reload(); 
				//$(".spinner").addClass('hidden') ;
				}
			})
		}
</script>
<script type="text/javascript">
	/**
 *Updated Form 
 */	
		
$(document).on("click", "#btnedit", edits);
 function edits(){
			$(".alert-danger").addClass('hidden') ;
			$(".alert-success").addClass('hidden') ;
			
			var post = $("#frmEdit").serialize();
			$(".spinner").removeClass('hidden') ;
			$.post('<?php echo site_url($customer_admin['dashboard_url'].'/media/gal_cat_edit');?>', post, function(data){
					var result = $.parseJSON(data) ;					
					if(result.status == 0 )
					{
						$(".alert-success").addClass('hidden') ;
						$(".alert-danger").html(result.statusmsg).removeClass('hidden');	
						$('html,body').animate({scrollTop:0},0);
					}
					else {
					//$(".editpro .alert-danger").addClass('hidden') ;
					//$(".editpro .alert-success").html(result.statusmsg).removeClass('hidden');
					location.reload(); 
				//$(".spinner").addClass('hidden') ;
				}
			})
		}		
</script>
<script type="text/javascript">
$(document).on("click", ".showmenu", showmenu);
	function showmenu(){
		$('.editpro').hide();
            $('.menu').show();
		}
		
		$(document).on("click", ".showmenu_order", showmenu_order);
	function showmenu_order(){
		$('.editpro').hide();
            $('.menu').hide();
			 $('.menu_order').show();
		}
		
	</script>
    
<script type="text/javascript">
 function deleteDomain(id)
    {
		
        if (confirm("Are you sure want to delete the selected category?") == true) {
		  var id = id;
        $.ajax({
			url:"<?php echo site_url($customer_admin['dashboard_url'].'/media/gal_cat_delete');?>/"+id,
			dataType: "json",
            success:function(result)
            {
         		if(result.status == 0 )
				{
					$(".alert-success").addClass('hidden') ;
					$(".alert-danger").html(result.statusmsg).removeClass('hidden');	
					$('html,body').animate({scrollTop:0},0);
				}
				else 
				{
					//$('#'+id).hide();
					location.reload();
				}
            },
               
            });
        }
    }

</script>