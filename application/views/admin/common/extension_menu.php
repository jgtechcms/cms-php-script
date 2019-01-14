					<li class="xn-openable <?php  if($current_page == 'category/index' || in_array($current_page, $featured_url) || $current_page == 'manufacture/index'){ echo 'active'; }?>">
                        <a href="<?php echo site_url($customer_admin['dashboard_url'].'/extension/')?>" title="Extension"><span class="fa fa-puzzle-piece"></span> <span class="xn-text">Extension</span></a>  
						<ul>
							<li class="<?php  if(in_array($current_page, $featured_url)){ echo 'active'; }?>"><a href="<?php echo site_url($customer_admin['dashboard_url'].'/products/featured')?>"><span class="fa fa-send"></span>Featured Products</a></li>
							<li class="<?php  if($current_page == 'category/index'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/extension/category')?>" title="General">
								<span class="fa fa-send"></span> <span class="xn-text">Category</span></a>
							</li>
							<li class="<?php  if($current_page == 'manufacture/index'){ echo 'active'; }?>">
								<a href="<?php echo site_url($customer_admin['dashboard_url'].'/extension/manufacture')?>" title="General">
								<span class="fa fa-send"></span> <span class="xn-text">Manufacture</span></a>
							</li>
						</ul>					
                    </li>