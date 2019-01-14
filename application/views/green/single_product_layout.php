<?php

$add_to_wishlist = '<div class="choose"><ul class="nav nav-pills nav-justified"><li><a href="" class="add_to_wishlist" data-item_id="ITEM_ID"><i class="fa fa-plus-square"></i>Add to wishlist</a></li></ul></div>';
			
$add_to_cart = 'ADD_TO_CART';

echo $layout = '<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<div class="product_img"><img src="IMAGE_URL" alt="" /></div>
								<h2 class="STRIKE">ITEM_DISPLAY_PRICE</h2>
								ITEM_OFFER_PRICE
								<p>ITEM_NAME</p>
							</div>
							
							<div class="product-overlay" style="" >
								<div class="overlay-content">
									<h2 class="STRIKE">ITEM_DISPLAY_PRICE</h2>
									ITEM_OFFER_PRICE
									<p>ITEM_NAME</p>
									<p>Quantity: <input type="text" id="quantity_ITEM_ID" value="1" class="width_50 validate_integer" style="width:20%;"/></p>'.
									$add_to_cart.'&nbsp&nbsp
									<a href="'.site_url().'products/product_details/ITEM_SLUG" class="btn btn-default add-to-cart"><i class="fa fa-view"></i>View</a>
								</div>
							</div>
						</div>'.
						$add_to_wishlist.'
					</div>
				</div>';
?>