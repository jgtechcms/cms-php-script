 <script>
    $(document).on("click", ".prolistedit", edit_menu_details);
	function edit_menu_details(){
	var id= $(this).attr('id');  
	$('#pro').hide();
	$('#editpro').fadeIn("slow");
	
	$.ajax({
		type: 'POST',
		data: {id: id, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
		url: '<?php echo site_url($customer_admin['dashboard_url'].'/menu_type/get_menu_type');?>',
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
			$.post('<?php echo site_url($customer_admin['dashboard_url']);?>/menu_type/add', post, function(data){
					var result = $.parseJSON(data) ;					
					if(result.status == 0 )
					{$(".menu .alert-success").addClass('hidden') ;
						$(".menu .alert-danger").html(result.statusmsg).removeClass('hidden');	
					}
					else {
					$(".menu .alert-danger").addClass('hidden') ;
					$('.menu #title').val('');
					$(".menu .alert-success").html(result.statusmsg).removeClass('hidden');
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
 function edits(){  //alert('kkk');
			var post = $("#frmEdit").serialize();
			$(".spinner").removeClass('hidden') ;
			$.post('<?php echo site_url($customer_admin['dashboard_url'].'/menu_type/edit');?>', post, function(data){
					var result = $.parseJSON(data) ; 					
					if(result.status == 0 )
					{$(".editpro .alert-success").addClass('hidden') ;
						$(".editpro .alert-danger").html(result.statusmsg).removeClass('hidden');	
					}
					else {
					$(".editpro .alert-danger").addClass('hidden') ;
					$(".editpro .alert-success").html(result.statusmsg).removeClass('hidden');
					location.reload(); 
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
 function deleteDomain(id)
    {
        if (confirm("Are you sure!") == true) {
        var id = id;
        $('#hide'+id).show();
        $.ajax({
            type: 'POST',
			data: {<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'},
			url:"<?php echo site_url($customer_admin['dashboard_url'].'/menu_type/delete');?>/"+id,
            success:function(data)
            {
           
            $('#'+id).hide();
			location.reload();
               
            },
               
            });
        }
    }

</script>





 
 <!-- START BREADCRUMB -->
                <ul class="breadcrumb push-down-0">
                    <li><a href="#">Home</a></li>
                    <li><a href="#" class="active">Menu Type</a></li>                   
                </ul>
                <!-- END BREADCRUMB -->                
                                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-file-text"></span> Menu Type </h2>
                        </div>                                                                                
                        
                        <!--<div class="pull-right">                            
                            <button class="btn btn-default"><span class="fa fa-cogs"></span> Settings</button>
                            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                        </div>-->                        
                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
					                    
					
                    <!-- START CONTENT FRAME LEFT -->
                    <div class="content-frame-left">
                        <?php /* for paid user
						<div class="block">
                            <a href="javascript:void(0)" id="showmenu" class="showmenu btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> Add a Menu Type</a>
                        </div>
						*/?>
                        <div class="block">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item active"><span class="fa fa-inbox"></span> List of Menu Types <span class="badge badge-success"><?php echo count($menu_type);?></span></a>
                                <?php if(count($menu_type)): foreach($menu_type as $menu_type): ?>	
                                <?php /* for paid user <a href="javascript:void(0);"  class="prolistedit list-group-item" id="<?php echo $menu_type->id;?>" >*/?>
								<a  class="list-group-item"><span class="fa fa-star"></span> <?php echo $menu_type->title;?> </a>
								<?php /* for paid user <span class="badge badge-warning" onclick="deleteDomain(<?php echo $menu_type->id;?>)">X</span></a>*/?>
								<?php endforeach; ?>
<?php else: ?>
		We could not find any menu type.
<?php endif; ?>	
                               <!-- <a href="#" class="list-group-item"><span class="fa fa-rocket"></span> Sent</a>
                                <a href="#" class="list-group-item"><span class="fa fa-flag"></span> Flagged</a>
                                <a href="#" class="list-group-item"><span class="fa fa-trash-o"></span> Deleted <span class="badge badge-default">1.4k</span></a>   -->                         
                            </div>                        
                        </div>
                        
                    </div>
                    <!-- END CONTENT FRAME LEFT -->
                    
					<?php /* for paid user
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body menu" id="pro"  >
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <h4 style="margin:0; padding:0;">Add Menu Type</h4>
                            </div>
                            <div class="panel-body">
                                
                                <!--Add Menu Type Form-->

								<div class="alert alert-danger hidden"></div>
								<div class="alert alert-success hidden"></div>
								<div class="col-md-4">
								<form method="POST" role="form" id="frmAdd"> 
								<div class="form-group"> <label  class="">Title</label>
								<input type="text" name="title"  class="form-control" value="">   </div>                         
								<div class="form-group">  <input type="button" value="Save" class="btn btn-primary btnadd" id="btnadd" />  </div>     
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								</form></div></div>

                          
                                
                            </div>
                                                       
                        </div>
                        */?>
                        
                         <div class="content-frame-body editpro" id="editpro"  style="display:none" >
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <h4 style="margin:0; padding:0;">Edit Menu Type</h4>
                            </div>
                            <div class="panel-body">
                                
                                <!--Add Menu Type Form-->

								<div class="alert alert-danger hidden"></div>
								<div class="alert alert-success hidden"></div>

								<div class="col-md-4">
								<form method="POST" role="form" id="frmEdit"> 
								<div class="form-group"> <label  class="">Title</label>
								<input type="hidden" name="id" id="id" value="" /> <input type="text" name="title" id="title"  class="form-control" value="">   </div>                         
								<div class="form-group">  <input type="button" value="Update" class="btn btn-primary" id="btnedit" />  </div>    
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

								</form></div>


  <!--Edit Menu Type Form-->
                          
                                
                            </div>
                                                      
                        </div>
                      

                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->