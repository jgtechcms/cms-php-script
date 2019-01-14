					<li class="xn-openable <?php  if(in_array($current_page, $product_url)){ echo 'active'; }?>">
                        <a href="#" title="Product Management"><span class="fa fa-bitcoin"></span> <span class="xn-text">Product Management</span></a>
                        <ul>  
							<li class="<?php  if(in_array($current_page, $category_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/category')?>"><span class="fa fa-send"></span>Product Category</a></li> 
							<li class="<?php  if(in_array($current_page, $manufactures_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/manufactures')?>"><span class="fa fa-send"></span>Manufacturer</a></li>	
                            <li class="<?php  if(in_array($current_page, $item_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/index')?>"><span class="fa fa-send"></span>Products</a></li>						
							<li class="<?php  if($current_page=='products/reviews' || $current_page=='products/add_review'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/reviews/')?>" title="Reviews">
								<span class="fa fa-send"></span> <span class="xn-text">Reviews</span></a>
								
							</li>
							<li class="<?php  if(in_array($current_page, $filter_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/filter')?>"><span class="fa fa-send"></span>Filter</a></li>
							<li class="<?php  if(in_array($current_page, $filter_values_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/filter_values')?>"><span class="fa fa-send"></span>Filter Values</a></li>
							<li class="<?php  if(in_array($current_page, $featured_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/featured')?>"><span class="fa fa-send"></span>Featured Products</a></li>
							<li class="<?php  if($current_page == 'category/index'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/extension/category')?>" title="General">
								<span class="fa fa-send"></span> <span class="xn-text">Category In Pages</span></a>
							</li>
							<li class="<?php  if($current_page == 'manufacture/index'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/extension/manufacture')?>" title="General">
								<span class="fa fa-send"></span> <span class="xn-text">Manufacture In Pages</span></a>
							</li>
                        </ul>
                    </li>
					<li class="xn-openable <?php  if(in_array($current_page, $product_settings_url)){ echo 'active'; }?>">
                        <a href="#" title="Cart Management"><span class="fa fa-shopping-cart"></span> <span class="xn-text">Cart Management</span></a>
                        <ul>
							<li class="<?php  if(in_array($current_page, $location_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/location_types')?>"><span class="fa fa-send"></span>Location Types</a></li> 
							<li class="<?php  if(in_array($current_page, $zone_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/zones')?>"><span class="fa fa-send"></span>Zones</a></li>
							<li class="<?php  if(in_array($current_page, $shipping_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/shipping')?>"><span class="fa fa-send"></span>Shipping Options</a></li>
							<li class="<?php  if(in_array($current_page, $tax_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/tax')?>"><span class="fa fa-send"></span>Tax</a></li>
                            <li class="<?php  if(in_array($current_page, $currency_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/currency')?>"><span class="fa fa-send"></span>Currencies</a></li> 
                            <li class="<?php  if(in_array($current_page, $cart_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/cart_default')?>"><span class="fa fa-send"></span>Cart Default Settings</a></li>
                            <li class="<?php  if(in_array($current_page, $cart_config_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/cart_config')?>"><span class="fa fa-send"></span>Cart Configuration</a></li>
						</ul>
                    </li>
					<li class="xn-openable <?php  if(in_array($current_page, $product_discount_url)){ echo 'active'; }?>">
                        <a href="#" title="Discount Management"><span class="fa fa-strikethrough"></span> <span class="xn-text">Discount Management</span></a>
                        <ul>
                            <li class="<?php  if(in_array($current_page, $discount_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/item_discounts')?>"><span class="fa fa-send"></span>Item Discounts</a></li>  
                            <li class="<?php  if(in_array($current_page, $summary_discount_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/summary_discounts')?>"><span class="fa fa-send"></span>Summary Discounts</a></li>
                            <li class="<?php  if(in_array($current_page, $discount_group_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/discount_groups')?>"><span class="fa fa-send"></span>Discount Groups</a></li>
						</ul>
                    </li>	
					<li class="<?php  if($current_page == 'payment_gateway/index' || $current_page == 'payment_gateway/settings'){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/payment_gateway/')?>" title="Payment Gateway"><span class="fa fa-credit-card"></span> <span class="xn-text">Payment Gateway</span></a>                        
                    </li>
					<li class="<?php  if(in_array($current_page, $order_url)){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/orders')?>" title="Order Management"><span class="fa fa-money"></span> <span class="xn-text">Order Management</span></a>                        
                    </li>					
					<li class="xn-openable <?php  if(in_array($current_page, $reports_url)){ echo 'active'; }?>">
						<a href="#" title="Reports"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Reports</span></a>
                        <ul>
							<li class="<?php  if($current_page == 'reports/sales'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/reports/sales')?>" title="Menu">
								<span class="fa fa-send"></span> <span class="xn-text">Sales Report</span></a>
							</li>
							<li class="<?php  if($current_page == 'reports/product_purchased'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/reports/product_purchased')?>" title="Menu">
								<span class="fa fa-send"></span> <span class="xn-text">Products Purchased Report</span></a>
							</li>
							<li class="<?php  if($current_page == 'reports/customer_order'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/reports/customer_order')?>" title="Menu">
								<span class="fa fa-send"></span> <span class="xn-text">Customer Orders Report</span></a>
							</li>
						</ul>
                        
                    </li>