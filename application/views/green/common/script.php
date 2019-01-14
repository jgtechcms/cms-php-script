<?php
$page_type = isset($current_menu->page_type) ? $current_menu->page_type : '';
?>

<script src="<?php echo site_url();?><?php echo $asset_path;?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url();?><?php echo $asset_path;?>/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('#myCarousel').carousel({
        interval: 5000 //changes the speed
    })
	
	$('#quote-carousel').carousel({
		pause: true,
		interval: 4000,
	  });
	
	 $('#itemslider').carousel({ interval: 3000 });

	$('.carousel-showmanymoveone .item').each(function(){
	var itemToClone = $(this);
	
	for (var i=1;i<6;i++) {
	itemToClone = itemToClone.next();
	
	if (!itemToClone.length) {
	itemToClone = $(this).siblings(':first');
	}
	
	itemToClone.children(':first-child').clone()
	.addClass("cloneditem-"+(i))
	.appendTo($(this));
	}
	});
	  
	  
	  
	  $('.filter a').click(function(e) {
  e.preventDefault();
  var a = $(this).attr('href');
  a = a.substr(1);
  $('.gallery a').each(function() {
    if (!$(this).hasClass(a) && a != 'all')
      $(this).addClass('hide');
    else
      $(this).removeClass('hide');
  });

});

$('.gallery a').click(function(e) {
  e.preventDefault();
  var $i = $(this);
  $('.gallery a').not($i).toggleClass('pophide');
  $i.toggleClass('pop');
  $('html,body').animate({
        scrollTop: ($("#breadcrum").offset().top) + 100},
        'slow');
});
    </script>
    
    <?php if($page_type == 'is_contact') :?>
	<script type="text/javascript">
						   
		// contact-form verify function
		$(document).ready(function()
		{
			$('#contact_form').submit(function(e){
				e.preventDefault();
				var name = $('#first_name').val();
				var email = $('#email').val();
				var phone = $('#phone').val();
				var subject = $('#subject').val();
				var content = $('#comment').val();
				var ck_name = /^[A-Za-z ]{3,20}$/; 
				var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
				var ck_number = /^\+?\(?([0-9]{2,3})\)?[-. ]?([0-9]{2,10})[-. ]?([0-9]{2,8})$/;
				var phone_valid = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
				
				var proceed = true;
				
				if(name == '')
				{
					$('.error_block1').html('Enter First Name'); 
					proceed = false;
				}
				else if(!ck_name.test(name))
				{
					$('.error_block1').html('Enter Valid Name'); 
					proceed = false;
				}
				else
				{
					$('.error_block1').html('');

				}	
				
				if(email == '')
				{
					$('.error_block2').html('Enter Email'); 
					proceed = false;
				}
				else if(!ck_email.test(email))
				{
				  $('.error_block2').html('Enter Valid Email'); 
				  proceed = false;
				}
			   else
				{
				  $('.error_block2').html('');

				}			   
				
				 if(phone == '')
			   {
				  $('.error_block3').html('Enter Phone Number'); 
				  proceed = false;
			   }
			   else if(!ck_number.test(phone))
			   {
					if(!phone.match(phone_valid)) {
						$('.error_block3').html('Enter Valid Phone Number'); 
						proceed = false;
					}
			   }
			   else
				{
				  $('.error_block3').html('');

				}

				if(subject == '')
				{
					$('.error_block4').html('Enter Subject'); 
					proceed = false;
				}
				else
				{
					$('.error_block4').html('');
				}					
				
				if(content == '')
				{
					$('.error_block5').html('Enter Message'); 
					proceed = false;
				}
				else if(content.length > 10)
				 {
					$('.error_block5').html('');
					
				 }
				 else
				 {
				   $('.error_block5').html('The Message Should be Minimum 10 Character');
				   proceed = false;

				 }

				if(proceed) {
			
					var post = $("#contact_form").serialize();
					//$(".spinner").removeClass('hidden') ;
					$.post('<?php echo site_url($customer_url_base);?>contact/add', post, function(data){
						var result = $.parseJSON(data) ;					
						if(result.status == 0 )
						{
							$(".alert-success").addClass('hidden') ;
							$(".alert-danger").html(result.statusmsg).removeClass('hidden');	
						}
						else {
							$(".alert-danger").addClass('hidden') ;
							$('#email').val('');
							$('#phone').val('');
							$('#first_name').val('');
							$('#subject').val('');
							$('#comment').val('');
							$(".alert-success").html(result.statusmsg).removeClass('hidden');
							//location.reload(); 
							//$(".spinner").addClass('hidden') ;
						}
					});
				}
			});
		});			
	</script>
	<?php endif;?>
	