		<ul class="nav navbar-nav navbar-right">
            <?php 
			$inc = 1;
			$header_menu_clone = $header_menu;
			foreach($header_menu as $key => $menu) {
				
				if($inc > 5)
					break;
				
				unset($header_menu_clone[$key]);
				display_menu($menu, $customer_url_base);
			}
			?>
          </ul>			
<?php
function display_menu($menu, $customer_url_base)
{
	
	$sub_menu = $menu->sub_menu;
	
	$dropdown_caret = '';
	$li_class = '';
	$dropdown_class = '';
	
	$sub_menu = $menu->sub_menu;
	
	if($sub_menu) {
		$dropdown_class = ' class="dropdown-toggle" data-toggle="dropdown"';
		$dropdown_caret = '<b class="caret"></b>';
		$li_class = ' class="dropdown"';
	}
	?>
    <li<?php echo $li_class;?>>
	<a<?php echo $dropdown_class;?> href="<?php echo site_url().$customer_url_base;?><?php echo $menu->slug;?>"><?php echo $menu->title;?> <?php echo $dropdown_caret;?></a>
		<?php if($sub_menu):?>
            <ul class="dropdown-menu">
                <?php 
                foreach($sub_menu as $list_sub_menu) {?>
                	<?php display_menu($list_sub_menu, $customer_url_base);?>
				<?php
                }
				?>
            </ul>
        <?php endif;?>
    </li>
    <?php
}
?>