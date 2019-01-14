<?php
function dates_format($var){
	return date('d/m/Y', strtotime($var));
	}
	function times_format($var){
	return date('H:i:s', strtotime($var));
	}
	function dates_times_format($var){
	return date('d/m/Y H:i:s', strtotime($var));
	}
	
	function add_dates_times_format($var){
	return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $var)));
	}
	function add_dates_format($var){
	return date('Y-m-d', strtotime(str_replace('/', '-', $var)));
	}


function display_pages() {
	$CI =& get_instance();
   return $result = $CI->db->get('menu')->result_array();
   /*foreach ($result as $row) {      
            echo $row['slug'];
   }*/
   }
function getProductByPlaceholder($type = 'grid', $customer_id, $static_products, $place_holder_start, $limit = 3)
{
	$limit = $limit+$place_holder_start;
	$return = '';
	
	$CI =& get_instance();
	$free_product_folder = $CI->config->item('free_product_folder');
	$customer_free_product_folder = $CI->config->item('customer_source_url') . $customer_id . '/' . $free_product_folder . '/';
	
	if($type == 'grid')
		$return .= '<div class="row">';
	foreach($static_products as $static_product){
			if($static_product->placeholder_id >= $place_holder_start and $static_product->placeholder_id < $limit) {
				$image_url = site_url() . $customer_free_product_folder .'/thumb/'. $static_product->image_name;
				
				if($type == 'grid') {
					$return .= '<div class="col-lg-4 col-md-4 marginBottom">
									<img class="img-responsive" src="'.$image_url.'" alt="product1">
									<h3 class="title">'.$static_product->title.'</h3>
									<p class="description">'.$static_product->description.'</p>
									<h3 class="h-color text-bold prices"><s>'.$static_product->strike_price.'</s> - '.$static_product->price.'</h3>
								</div>';
				} else {
					$return .= '<div class="col-lg-12">
                      <div class="row effect">
                       <div class="col-sm-4 col-md-4 col-lg-3">
                       <img class="img-responsive" src="'.$image_url.'" alt="product1">
                       </div>
                       <div class="col-sm-8 col-md-8 col-lg-9">
                       <h3>'.$static_product->title.'</h3>
								<p>'.$static_product->description.'</p>
                                <h3 class="h-color text-bold"><s>'.$static_product->strike_price.'</s> - '.$static_product->price.'</h3>
                       </div>
                      </div>
                     </div>';
				}
			}
	}
	if($type == 'grid')
		$return .= '</div>';
	echo $return;
}

function getValueOfArray($tbl_field, $obj)
{
	return isset($obj->{$tbl_field}) ? $obj->{$tbl_field} : '';
}

function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<div class="pageContent">';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body_desc), $numwords)) . '</p>';
	$string .= '<p style="float:right">' . anchor($url, 'Read more ›', array('class' => 'read_more_link btn btn-success', 'title' => e($article->title))) . '</p>';
$string .= '<br>';

	$string .= '</div>';

			
			
	return $string;
}
function get_news($article, $numwords = 50){
	$string = '';
	$url = news_link($article);
	$string .= '<div class="pageContent">';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body_desc), $numwords)) . '</p>';
	$string .= '<p style="float:right">' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
$string .= '<br>';

	$string .= '</div>';

			
			
	return $string;
}

function get_testimonials($article){
	$string = '';
	$url = article_link($article);
	$string .= '<div class="pageContent">';
	$string .= '<p>' . e(strip_tags($article->body_desc)) . '</p>';
	$string .= '</div>';

			
			
	return $string;
}



function get_news_home($article, $numwords = 50){
	/*alt="" width="440px" height="330px"*/
	$string = '';
	$url = news_link($article);
	$string .= '<li><div class="postThumb">';
	$string .= ' <a href="news"><img src="uploads/thumb_'.$article->upload_images.'" class="cen"  /></a>';
	$string .= '</div>';
	$string .= '<div class="postDetails">';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	    $string .= '<a class="button-small-theme rounded3" href="news/'.$article->slug.'">MORE INFO</a>';
	$string .= '</div></li>';	
	return $string;
}

function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string){
	return htmlentities($string);
}
function article_link($article){
	return 'blog/'.e($article->slug);
}
function news_link($article){
	return 'news/'.e($article->slug);
}
function article_links($articles){
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}

function get_menu ($array, $child = FALSE)
{
	$CI =& get_instance();
	$str = '';
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
		
		foreach ($array as $item) {
			
			$active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
			if (isset($item['children']) && count($item['children'])) {
				$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
				$str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
				$str .= '<b class="caret"></b></a>' . PHP_EOL;
				$str .= get_menu($item['children'], TRUE);
			}
			else {
				$str .= $active ? '<li class="active">' : '<li>';
				$str .= '<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
			}
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ul>' . PHP_EOL;
	}
	
	return $str;
}

function source_site($userId=NULL)
{
   $CI =& get_instance();
   $mod = $CI->load->model('categorisation_m');
   $conditions = array('id'=>$userId);
   $result = $CI->categorisation_m->get_by($conditions, TRUE);
   echo $res='<a href="'.site_url('cobra/uni/leads/'.$userId).'">'.$result->brand_name.'</a>';
   /*if($result->num_rows()>0) {
        $data = $result->row();
        $res = $data->$field;
   } else {
        $res = '';
   }*/
//return $res;
}

function display_enquiry() {
	$CI =& get_instance();   
   $result = $CI->db->get('enquiry')->result_array();
  // echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul style='list-style:none'>";
    foreach ($result as $row) {      
            echo '<li>';
			echo '<a href="javascript:void(0);"  class="prolistedit" id="'.$row['id'].'" style="color:#039;font-weight:bold;">'.$row['name'].'</a> <a href="javascript:void(0)" onclick="deleteDomain('.$row['id'].')"  title="Delete" style="float:right; margin-right:5%; font-weight:normal; color:#F00; font-size:14px;" ><i class="icon-delete"></i>X</a>';		
			echo "</li>";   
    }
    echo "</ul>";
}
// Menu Child
function display_children($id, $level) {
	$CI =& get_instance();
	$CI->db->where('parent_id ='.$id);
	$CI->db->order_by('order_by');
	$result = $CI->db->get('menu')->result_array();
   	
    echo "<ul style='margin:0; padding:0'>";
    foreach ($result as $row) {      
            echo '<li style="list-style:none">';
			if($row['parent_id']=='0'){
				echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['id'].'" style="color:#039;font-weight:bold;">';
				echo '<span class="fa fa-heart"></span>'.$row['title'];
				
				echo '<span class="badge badge-warning" onclick="deleteDomain('.$row['id'].')">X</span>';
				echo '</a>';
			}else{
				echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['id'].'" style="color:#039;font-weight:bold;">';
				echo '<span class="fa fa-heart"></span>'.$row['title'];				
				'<span class="badge badge-warning" onclick="deleteDomain('.$row['id'].')">X</span>';
				echo '</a>';
				echo '<a href="javascript:void(0);"  class="prolistedit" id="'.$row['id'].'" style="color:#039;">'.$row['title'].'</a> <a href="javascript:void(0)" onclick="deleteDomain('.$row['id'].')"  title="Delete" style="float:right; margin-right:5%; font-weight:normal; color:#F00; font-size:14px;" ><i class="icon-delete"></i>X</a>';
				}
			display_child($row['id'], $level + 1);
			echo "</li>";   
    }
    echo "</ul>";
}
function display_children_order($id, $level) {
	$CI =& get_instance();
	//$CI->db->select('*,count(id) as cnt');
    $CI->db->where('parent_id ='.$id);
   $result = $CI->db->get('menu')->result_array();
  // echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul style='margin:0; padding:0' id='sortable-row'>";
    foreach ($result as $row) {      
            echo '<li style="list-style:none" class="list-group-item" id="'.$row['id'].'">'.$row['title'];
			display_child($row['id'], $level + 1);
			echo "</li>";   
    }
    echo "</ul>";
}
// Menu Child
function display_child($id, $level) {
	$CI =& get_instance();
	//$CI->db->select('*,count(id) as cnt');
    $CI->db->where('parent_id ='.$id);
   $result = $CI->db->get('menu')->result_array();
  // echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul style='padding-left:5px;padding-right:5px;'>";
    foreach ($result as $row) {      
            echo '<li style="list-style:none">';if($row['parent_id']=='0'){echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['id'].'" style="color:#039;font-weight:normal; padding:5px 15px;"><span class="fa fa-star"></span>'.$row['title'].'<span class="badge badge-warning" onclick="deleteDomain('.$row['id'].')">X</span></a>';
			}else{
				echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['id'].'" style="color:#039;font-weight:normal;padding:5px 15px;"><span class="fa fa-star"></span>'.$row['title'].'<span class="badge badge-warning" onclick="deleteDomain('.$row['id'].')">X</span></a>';
				/*echo '<a href="javascript:void(0);"  class="prolistedit" id="'.$row['id'].'" style="color:#039;">'.$row['title'].'</a> <a href="javascript:void(0)" onclick="deleteDomain('.$row['id'].')"  title="Delete" style="float:right; margin-right:5%; font-weight:normal; color:#F00; font-size:14px;" ><i class="icon-delete"></i>X</a>';*/
				}
			display_child($row['id'], $level + 1);
			echo "</li>";   
    }
    echo "</ul>";
}
// Product Categories
function display_product_category($id, $level) {
	$CI =& get_instance();
    $CI->db->where('parent_id ='.$id);
   $result = $CI->db->get('product_category')->result_array();
  // echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul style='margin:0; padding:0'>";
    foreach ($result as $row) {      
            echo '<li style="list-style:none">';if($row['parent_id']=='0'){echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['cat_id'].'" style="color:#039;font-weight:bold;"><span class="fa fa-heart"></span>'.$row['cat_name'].'<span class="badge badge-warning" onclick="deleteDomain('.$row['cat_id'].')">X</span></a>';
			}else{
				echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['cat_id'].'" style="color:#039;font-weight:bold;"><span class="fa fa-heart"></span>'.$row['cat_name'].'<span class="badge badge-warning" onclick="deleteDomain('.$row['cat_id'].')">X</span></a>';				
				}
			display_product_category_child($row['cat_id'], $level + 1);
			echo "</li>";   
    }
    echo "</ul>";
}

function get_product_category_front($id) {
	$CI =& get_instance();
	$CI->db->where(array('parent_id' => $id, 'status' => 'Enabled'));
	return $CI->db->get('product_category')->result_array();
}
function get_product_category_front_from_data($id, $category_data) {
	$return = array();
	foreach($category_data as $category) {
		if($category->parent_id == $id)
			$return[] = $category;
	}
	return $return;
}

// Product Categories Child
function display_product_category_child($id, $level) {
	$CI =& get_instance();
    $CI->db->where('parent_id ='.$id);
   $result = $CI->db->get('product_category')->result_array();
  // echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul style='padding-left:5px;padding-right:5px;'>";
    foreach ($result as $row) {      
            echo '<li style="list-style:none">';if($row['parent_id']=='0'){echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['cat_id'].'" style="color:#039;font-weight:normal; padding:5px 15px;"><span class="fa fa-star"></span>'.$row['cat_name'].'<span class="badge badge-warning" onclick="deleteDomain('.$row['cat_id'].')">X</span></a>';
			}else{
				echo '<a href="javascript:void(0);"  class="prolistedit list-group-item" id="'.$row['cat_id'].'" style="color:#039;font-weight:normal;padding:5px 15px;"><span class="fa fa-star"></span>'.$row['cat_name'].'<span class="badge badge-warning" onclick="deleteDomain('.$row['cat_id'].')">X</span></a>';				
				}
			display_child($row['cat_id'], $level + 1);
			echo "</li>";   
    }
    echo "</ul>";
}


function display_children_menu($id, $level) {
	$CI =& get_instance();
	//$CI->db->cache_on();
	$CI->db->order_by('m.id','asc');
	$CI->db->group_by('m.title');
	$CI->db->select('*,m.id as mid,m.title as tit');
	$CI->db->where('m.m_t_id =','2');
    $CI->db->where('m.parent_id ='.$id);	
    $CI->db->from('pages as p' );
    $CI->db->join('menu as m', 'm.id = p.menu', 'right'); 
   // $query = $this->db->get();
	
   $result = $CI->db->get('menu')->result_array();
  //echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul class='nav navbar-nav navbar-right'><li><a href='".site_url()."'>Home</a></li>";
    foreach ($result as $row) {  
	
            echo '<li class="dropdown">';if($row['menu']==''){echo'<a href="'.site_url().$row['slug'].'">'.$row['tit'].'</a>';}else{echo'<a href="'.site_url().$row['slug'].'">'.$row['tit'].'</a>';}
			 display_menu_child($row['mid'], $level + 1);						
			
			echo "</li>";   
    }
    echo "</ul>";
}
function display_menu_child($id, $level) {
	$CI =& get_instance();
	$CI->db->order_by('m.id','asc');
	$CI->db->group_by('m.title');
	$CI->db->select('*,m.id as mid,m.title as tit');
	$CI->db->where('m.m_t_id =','2');
    $CI->db->where('m.parent_id ='.$id);	
    $CI->db->from('pages as p' );
    $CI->db->join('menu as m', 'm.id = p.menu', 'right'); 
	
   $result = $CI->db->get('menu')->result_array();
$cnt=count($result);
if($cnt > 0){			
    echo "<ul  class='submenu'>";
    foreach ($result as $row) {  	
            echo '<li>';if($row['slug']==''){echo'<a href="'.site_url().'">'.$row['tit'].'</a>';}else{echo'<a href="'.site_url().$row['slug'].'">'.$row['tit'].'</a>';echo "</li>";  
			}
							
			
			 
    }
    echo "</ul>";
		}
}

function display_children_left_menu($id, $level) {
	$CI =& get_instance();
	$CI->db->order_by('m.id','asc');
	$CI->db->group_by('m.title');
	$CI->db->select('*,m.id as mid,m.title as tit');
	$where = "FIND_IN_SET('29', m.m_t_id)";  

$CI->db->where($where);
	//$CI->db->where('m.m_t_id =','29');
    $CI->db->where('m.parent_id ='.$id);	
    $CI->db->from('pages as p' );
    $CI->db->join('menu as m', 'm.id = p.menu', 'right'); 
   // $query = $this->db->get();
	
   $result = $CI->db->get('menu')->result_array();
  //echo '<pre>'.$CI->db->last_query().'</pre>'; 
   	
    echo "<ul>";
    foreach ($result as $row) {  
	
            echo '<li id="menu-item-1598" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1041 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-1598">';if($row['slug']==''){echo'<a href="'.site_url().'">'.$row['tit'].'</a>';}else{echo'<a href="'.site_url().'pages/'.$row['slug'].'">'.$row['tit'].'</a>';}
			 echo '<ul class="sub-menu">'.display_children_menu($row['mid'], $level + 1).'</ul>';						
			
			echo "</li>";   
    }
    echo "</ul>";
}
function get_sub($id)
{
   $CI =& get_instance();
    $CI->db->where('parent_id ='.$id);
   $result = $CI->db->get('menu')->result_array();
   foreach ($result as $res) {
	   echo $re='<li><a href="javascript:void(0);"  class="prolistedit" id="'.$res['id'].'" style="color:#039">'.$res['title'].'</a> <a href="javascript:void(0)" onclick="deleteDomain('.$res['id'].')"  title="Delete" style="float:right; margin-right:5%; font-weight:normal; color:#F00; font-size:14px;" ><i class="icon-delete"></i>X</a></li>';
	   }

  
}

function get_sub_option($id, $size_inc = ' --')
{
	
	$CI =& get_instance();
	$CI->db->order_by('id','ASC');
    $CI->db->where('parent_id ='.$id);
	$result = $CI->db->get('menu')->result_array();
	
	if($result) {
	   $size_inc = $size_inc . '----';
	   foreach ($result as $res) {
		  // if($res['id']==$menu){$val="selected";}else{$val=NULL;}
		   echo $re='<option value="'.$res['id'].'">'.($size_inc).$res['title'].'</option>';
		   
		   get_sub_option($res['id'], $size_inc);
		}
	}  
}

function get_product_category($id, $selected_category = '')
{
	
   $CI =& get_instance();
   $CI->db->order_by('cat_id','ASC');
    $CI->db->where(array('parent_id' => $id, 'status' => 'Enabled'));
   $result = $CI->db->get('product_category')->result_array();
   foreach ($result as $res) {
	   if($res['cat_id']==$selected_category){$val=" selected";}else{$val='';}
	   echo $re='<option'.$val.' value="'.$res['cat_id'].'">'.$res['cat_name'].'</option>';
	}

  
}

						
						


function sub_cat($id)
{
	$CI =& get_instance();   
   $CI->db->where('c_id ='.$id);	
   $pages = $CI->db->get('subcategories')->result_array();
   foreach ($pages as $result) {	echo $str ='<option value="'.$result['subcategory_title'].'" >'.$result['subcategory_title'].'</option>';}
  

}



function categories($id)
{
	$CI =& get_instance();   
   $CI->db->where('s_id ='.$id);	
   $pages = $CI->db->get('subscriptions')->result_array();
   $i=1;
   foreach ($pages as $result) {	
   $res='<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td style="width:20px">'.$i.'.</td>
    <td>'.$result['scategory'].'</td>
  </tr>
</table>';
  
   echo $res;
   $i++;}
  

}

function sub_cat_edit($id,$cat)
{
	$CI =& get_instance();   
   $CI->db->where('c_id ='.$id);	
   $pages = $CI->db->get('subcategories')->result_array();
   foreach ($pages as $result) {	
  // $sel='if($cat==$result[subcategory_title]){ selected="selected";}';
   
    $str ='<option value="'.$result['subcategory_title'].'" >'.$result['subcategory_title'].'</option>';}
  

}



function brand_lead($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
  $CI->db->where('source_site =',$id);	 
   $result = $CI->univercity_m->get('', TRUE);
   echo $result->sid;


}

function brand_verify($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
  $CI->db->where('source_site =',$id);	 
  $CI->db->where('status =','Verified');
   $result = $CI->univercity_m->get('', TRUE);
   echo $result->sid;

}
function brand_fresh($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
  $CI->db->where('source_site =',$id);	 
  $CI->db->where('status =','Fresh');
   $result = $CI->univercity_m->get('', TRUE);
   echo $result->sid;

}

function recall($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(lead_call_details.id) as sid');
  $CI->db->where('source_site =',$id);	 
  $CI->db->where('status =','Fresh');
  $CI->db->order_by("leads.created", "DESC");
  $CI->db->group_by('leads.source_site'); 
  $CI->db->join('lead_call_details', 'lead_call_details.l_id = leads.id','LEFT');
   $result = $CI->univercity_m->get('', TRUE);
  // echo '<pre>'.$CI->db->last_query().'</pre>'; 
   echo $result->sid;

}

/*function brand_hits($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, sum(hits) as sid');
  $CI->db->where('source_site =',$id);  
   $result = $CI->univercity_m->get('', TRUE);
   echo $result->sid;

}*/
function brand_hits($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('visitas_m');  
   $CI->db->select('*, sum(cant_visit) as sid');
  $CI->db->where('brand =',$id);  
   $result = $CI->visitas_m->get('', TRUE);
   echo $result->sid;

}

function cat_lead($id)
{
	
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
  $CI->db->where('main_category =',$id);	 
   $result = $CI->univercity_m->get('', TRUE);
   return $result->sid;


}

function cat_verify($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
  $CI->db->where('main_category =',$id);	 
  $CI->db->where('status =','Verified');
   $result = $CI->univercity_m->get('', TRUE);
   return $result->sid;

}
/*function cat_hits($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, sum(hits) as sid');
  $CI->db->where('main_category =',$id);  
   $result = $CI->univercity_m->get('', TRUE);
   return $result->sid;

}*/
function cat_hits($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('visitas_m');  
   $CI->db->select('*, sum(cant_visit) as sid');
  $CI->db->where('maincategory =',$id);  
   $result = $CI->visitas_m->get('', TRUE);  
   return $result->sid;

}



function subcat_lead($id)
{
		
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
  $CI->db->where('category =',$id);	 
   $result = $CI->univercity_m->get('', TRUE);   
   return $result->sid;


}

function subcat_verify($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, count(id) as sid');
   $CI->db->where('category =',$id);	  
   $CI->db->where('status =','Verified');
   $result = $CI->univercity_m->get('', TRUE);
   return $result->sid;

}
/*function subcat_hits($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('univercity_m');  
   $CI->db->select('*, sum(hits) as sid');
   $CI->db->where('category =',$id);	 
   $result = $CI->univercity_m->get('', TRUE);       
   return $result->sid;

}*/

function subcat_hits($id)
{
   $CI =& get_instance();
   $mod = $CI->load->model('visitas_m');  
   $CI->db->select('*, sum(cant_visit) as sid');
  $CI->db->where('category =',$id);  
   $result = $CI->visitas_m->get('', TRUE);  
   return $result->sid;

}


function get_cat($id)
{
	
	$CI =& get_instance();   
	echo $str='<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Created Date</th>                
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>';
   $CI->db->where('brands = '.$id);	
   $pages = $CI->db->get('categories')->result_array();  
   foreach ($pages as $result) {  
 
		echo $str='<tr>
			<td><a href="'.site_url('cobra/categorisation/c-edit/'.$result['id']).'">'.$result['category_title'].'</a></td>
			<td>'.$result['created'].'</td>             
			<td><a href="'.site_url('cobra/categorisation/c-edit/'.$result['id']).'"><i class="icon-edit"></i></a></td>
			<td><a href="'.site_url('cobra/categorisation/c-delete/'.$result['id']).'"><i class="icon-remove"></i></a></td>
		</tr>'; 
	
	}
	echo $str='</table>';
  

}


function get_categ($id)
{
	
	$CI =& get_instance();  	
   $CI->db->where('brands = '.$id);	
   $pages = $CI->db->get('categories')->result_array();  
   foreach ($pages as $result) {  
   echo '<h6 style=" margin:0; color:#e85c0b">'.$result['category_title'].'</h6>';
get_subcat($result['id']);		
	
	}
 

}

function get_day($id)
{
	
	$CI =& get_instance();  	
   $CI->db->where('menu_title = "'.$id.'"');	
   $pages = $CI->db->get('travel_packages',3)->result_array();  
   foreach ($pages as $result) {  
   $txt=$result['body']; 
  // trim_text(result['body'], 20)
  //substr($result['body'], 0, 280)
echo '<section class="p_cont">
             <article class="t_p_c_left">
                     <div class="t_p_img"><img src="'.site_url('').'uploads/small/'.$result['upload_images_1'].'" alt=""/></div>
                     <div class="t_p_days">
                     <p>Day</p>
                     <h4>'.$result['day'].'</h4>                     
                     </div>
					 <div class="clr"></div>
             </article>
             <article class="t_p_c_right">
             <h3>'.$result['title'].' <span>'.$result['kilometer'].'</span></h3>
'.trim_text($txt, 30).'
<div class="clr"></div>
             </article>
			 <div class="clr"></div>
 </section>	 <div class="clr"></div>';
	}
 

}

function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}
 
function trim_text($text, $count){ 
$text = str_replace("  ", " ", $text); 
$string = explode(" ", $text); 
for ($wordCounter=0;$wordCounter<=$count;$wordCounter++ ){ 
$trimed .= $string[$wordCounter]; 
if ( $wordCounter < $count ){ $trimed .= " "; } 
else { $trimed .= "..."; 
} 
} 
$trimed = trim($trimed); 
return $trimed; 
} 


function get_days($id)
{
	
	$CI =& get_instance();  	
   $CI->db->where('menu_title = "'.$id.'"');	
   $pages = $CI->db->get('travel_packages')->result_array();  
   $i=1;
   foreach ($pages as $result) {    
   
   
	   
	   
   echo '<div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">
         
         <div class="panel-title-l">
                  <div class="dy">
                  <p>Day</p>
                  <p><span>'.$result['day'].'</span></p>
                  </div>
          </div>
          <div class="panel-title-m"><h2>'.$result['title'].'<span>&nbsp;&nbsp;'.$result['kilometer'].'</span></h2></div>
          <div class="panel-title-r"> <span class="glyphicon glyphicon-plus"></span></div>
        </a>
      </div>
    </div>
    <div id="collapse'.$i.'" class="panel-collapse collapse">
      <div class="panel-body">
       <div class="panel-body-l gallery clearfix"> 
	   
	   
	    <a href="'.site_url('').'uploads/original/'. $result['upload_images_1'].'" rel="prettyPhoto[gallery'.$i.']" title="">
		<img src="'.site_url('').'uploads/small/'.$result['upload_images_1'].'" alt=""/>
		</a>
		'.get_d2($result['upload_images_2'],$i).''.get_d3($result['upload_images_3'],$i).''.get_d4($result['upload_images_4'],$i).''.get_d5($result['upload_images_5'],$i).''.get_d6($result['upload_images_6'],$i).''.get_d7($result['upload_images_7'],$i).''.get_d8($result['upload_images_8'],$i).''.get_d9($result['upload_images_9'],$i).''.get_d10($result['upload_images_10'],$i).'
	     </div>
       <div class="panel-body-r">
       '.$result['body'].'
       
       </div>
          </div>
    </div>
  </div>';   
$i++;
	}
 
  
}


	 function get_d2($img,$i){
	 if($img!='0' && $img!=''){
		      $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   
	   }	   return $im;
	 }
	 function get_d3($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   return $im;
	   }	   
	 }
	 function get_d4($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   return $im;
	  }	   
	 }
	 function get_d5($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	    return $im;
	   }	   
	 }
	 function get_d6($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	    return $im;
	   }	   
	 }
	 function get_d7($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   return $im;
	   }	   
	 }
	 function get_d8($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   return $im;
	   }	   
	 }
	 function get_d9($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   return $im;
	   }	   
	 }
	 function get_d10($img,$i){
	 if($img!='0' && $img!=''){
		     $im='<a href="'.site_url('').'uploads/original/'. $img.'" rel="prettyPhoto[gallery'.$i.']" title=""></a>';
	   return $im;
	   }	   
	 }
 
function get_subcat($id)
{
	
	$CI =& get_instance();   
	echo $str='<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Created Date</th>               
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>';
   $CI->db->where('c_id	= '.$id);	
   $pages = $CI->db->get('subcategories')->result_array();  
   foreach ($pages as $result) {  
 
		echo $str='<tr>
			<td><a href="'.site_url('admin/categorisation/sc-edit/'.$result['id']).'">'.$result['subcategory_title'].'</a></td>
			<td>'.$result['created'].'</td>            
			<td><a href="'.site_url('admin/categorisation/sc-edit/'.$result['id']).'"><i class="icon-edit"></i></a></td>
			<td><a href="'.site_url('admin/categorisation/sc-delete/'.$result['id']).'"><i class="icon-remove"></i></a></td>
		</tr>'; 
	
	}
	echo $str='</table>';
  

}

function get_sub_lead($id=NULL)
{
   $CI =& get_instance(); 
    $CI->db->where('sub_id	= '.$id);	  
    $pages = $CI->db->get('lead_assgin_subscription')->result_array();  
	echo count($pages);  

}

function get_sub_lead_rate($id=NULL)
{
    $CI =& get_instance(); 
    $CI->db->select('*, COUNT(lead_assgin_subscription.lead_id) as cnt, subscriptions.price as pr,subscriptions.id as sid');	
		$CI->db->join('lead_assgin_subscription', 'lead_assgin_subscription.sub_id = subscriptions.id','LEFT');
		$CI->db->where('subscriptions.s_id ='.$id );
		$CI->db->where('subscriptions.status !="Stop"');	
		$CI->db->order_by('subscriptions.id', 'desc');	
		$CI->db->group_by('subscriptions.id');    
    $pages = $CI->db->get('subscriptions')->result_array();  
	//echo '<pre>'.$CI->db->last_query().'</pre>';	
foreach ($pages as $result) {
	$res .=$result['cnt']*$result['pr'];
}
if($res > 0)
{
return $res;
}
	/*
	$this->db->select('*, COUNT(lead_assgin_subscription.lead_id) as cnt,subscriptions.id as sid');	
		$this->db->join('lead_assgin_subscription', 'lead_assgin_subscription.sub_id = subscriptions.id','LEFT');
		$this->db->where('subscriptions.s_id ='.$id );
		$this->db->where('subscriptions.status !="Stop"');	
		$this->db->order_by('subscriptions.id', 'desc');	
		$this->db->group_by('subscriptions.id');   
		$this->data['sub'] = $this->subscriptions_m->get();*/	
		

}

function send_client($lid)
{
	
	
	
	$CI =& get_instance(); 		
	$CI->db->order_by('id', 'desc');  	
   $pag = $CI->db->get('suppliers_details')->result_array();
   
   foreach ($pag as $result) {	
   $sid=$result['id'];
                $CI->db->select('COUNT(*) as a');
				$CI->db->where('lead_id =', $lid);
				$CI->db->where('sub_id =', $sid);
				 $res = $CI->db->get('lead_assgin_subscription')->result_array();
				// echo '<pre>'.$CI->db->last_query().'</pre>';
				  foreach ($res as $res) {	
				if($res['a']!='0'){
				 echo '<p>'.$result['supplier_name'].'</p>';
				}
				  }
				//echo '<pre>'.$CI->db->last_query().'</pre>';
				/*if($res>0){}else{					
    echo $str ='<option value="'.$result['id'].'" >'.$result['supplier_name'].'</option>';
				}*/
   }
  //return $str;

}



function get_client($lid)
{
	
	
	
	$CI =& get_instance(); 	
	
	
	$CI->db->order_by('id', 'desc');  	
   $pag = $CI->db->get('suppliers_details')->result_array();
   
   foreach ($pag as $result) {	
   $sid=$result['id'];
                $CI->db->select('COUNT(*) as a');
				$CI->db->where('lead_id =', $lid);
				$CI->db->where('sub_id =', $sid);
				 $res = $CI->db->get('lead_assgin_subscription')->result_array();
				// echo '<pre>'.$CI->db->last_query().'</pre>';
				  foreach ($res as $res) {	
				if($res['a']=='0'){
				 echo $str ='<option value="'.$result['id'].'" >'.$result['supplier_name'].'</option>';
				}
				  }
				//echo '<pre>'.$CI->db->last_query().'</pre>';
				/*if($res>0){}else{					
    echo $str ='<option value="'.$result['id'].'" >'.$result['supplier_name'].'</option>';
				}*/
   }
  //return $str;

}
function brand($id)
{
	$CI =& get_instance();   
   $CI->db->where('brands ='.$id);	
   $pages = $CI->db->get('categories')->result_array();
   foreach ($pages as $result) {	
   echo $str ='<optgroup label="'.$result['category_title'].'">'.cat_list($result['id']).'</optgroup>';
  }
  

}
function cat_list($id)
{
	$CI =& get_instance();   
   $CI->db->where('c_id ='.$id);	
   $pages = $CI->db->get('subcategories')->result_array();
   foreach ($pages as $result) {	
   echo $str ='<option value="'.$result['subcategory_title'].'">'.$result['subcategory_title'].'</option>';
  }
  

}

function getdays($t_no_days,$tit,$day){ 


$CI =& get_instance();
   //$mod = $CI->load->model('travel_packages_m');
      echo '<select name="day"><option>Choose</option>';
   if($day!=''){	  
	 for($i=1;$i<=$t_no_days;$i++){
		$ch="selected";
   echo '<option value="'.$i.'"';if($day==$i){echo $ch;};echo '>'.$i.'</option>';					
	 		}
	   
	   }else{
 
	 for($i=1;$i<=$t_no_days;$i++){
   $conditions = array('menu_title'=>$tit,'day'=>$i);
   $result = $CI->travel_packages_m->get_by($conditions, TRUE);

  if($result->day !=$i){
   echo '<option value="'.$i.'">'.$i.'</option>';
   						}
						else{
							echo '<optgroup  label="'.$i.'"></optgroup>';
							}
	 		}
   }
	 echo '</select>';
	 }

/*$vehicle_type,$c_type,$f_name,$phone_no,$status,$pick_up_date,$pick_up_time,$return_date,$return_time,$age,$need_a_driver,$pickup_type,$l_name,$email*/
function get_car_van_bus_booking_viewss($id,$vehicle_type,$c_type,$f_name,$phone_no,$status,$pick_up_date,$pick_up_time,$return_date,$return_time,$age,$need_a_driver,$pickup_type,$l_name,$email)
{
	$CI= & get_instance();
	$html='<span class="actions">';
	$html .='<a href="#" data-toggle="modal" data-target="#'.$id.'">View</a>';  
	$html .='<div id="'.$id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog"  >
    <div class="modal-content" style="padding:3%">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
        <h4 class="modal-title" id="myModalLabel">View car van bus hire booking</h4>
      </div>
      <div class="modal-body"> 
<style>.modal-body ul{margin:0 auto; padding:0; width:80%;}.modal-body ul li{float:left;list-style:none; padding-left:5%; padding-right:5%; padding-top:3%; padding-bottom:3%;width:40%;text-align:left;}</style>
<ul><li>Vehicle type</li><li>'.$vehicle_type.'</li>
</ul>
<ul>
<li>Vehicle name</li><li>'.$c_type.'</li>
</ul>

<ul>
<li>Pick up date</li><li>'.$pick_up_date.'</li>
</ul>
<ul>
<li>Pick up time</li><li>'.$pick_up_time.'</li>
</ul>

<ul>
<li>Return date	</li><li>'.$return_date.'</li>
</ul>
<ul>
<li>Return time</li><li>'.$return_time.'</li>
</ul>
<ul>
<li>Driver aged between</li><li>'.$age.'</li>
</ul>
<ul>
<li>Do you need a driver</li><li>'.$need_a_driver.'</li>
</ul>
<ul>
<li>One way (or) Return</li><li>'.$pickup_type.'</li>
</ul>
<ul>
<li>First name</li><li>'.$f_name.'</li>
</ul>
<ul>
<li>Last name</li><li>'.$l_name.'</li>
</ul>
<ul>
<li>Email</li><li>'.$email.'</li>
</ul>
<ul>
<li>Phone number</li><li>'.$phone_no.'</li>
</ul>
<div style="clear:both; margin-top:3%;"><a href="'.  site_url().'admin/car-van-bus-booking/status/'.$id.'" class="btn">Update status</a></div>
      </div>  
    </div>
  </div>
</div>';
	
	$html.='</span>';
	
    return $html;
}


function get_vg_booking_view($id,$b_title,$booked_title,$booked_price,$full_name,$email,$phone_no,$postcode,$pick_up_date,$pick_up_time)
{
	$CI= & get_instance();
	$html='<span class="actions">';
	$html .='<a href="#" data-toggle="modal" data-target="#'.$id.'">View</a>';  
	$html .='<div id="'.$id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog"  >
    <div class="modal-content" style="padding:3%">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
        <h4 class="modal-title" id="myModalLabel">View vehicle guide booking</h4>
      </div>
      <div class="modal-body"> 
<style>.modal-body ul{margin:0 auto; padding:0; width:80%;}.modal-body ul li{float:left;list-style:none; padding-left:5%; padding-right:5%; padding-top:3%; padding-bottom:3%;width:40%;text-align:left;}</style>
<ul><li>Booked Vehicle Name</li><li>'.$b_title.'</li>
</ul>
<ul>
<li>Booked Title</li><li>'.$booked_title.'</li>
</ul>

<ul>
<li>Booked Price</li><li>'.$booked_price.'</li>
</ul>
<ul>
<li>Full Name</li><li>'.$full_name.'</li>
</ul>

<ul>
<li>Pickup date	</li><li>'.$pick_up_date.'</li>
</ul>
<ul>
<li>Pickup time</li><li>'.$pick_up_time.'</li>
</ul>
<ul>
<li>Email</li><li>'.$email.'</li>
</ul>
<ul>
<li>Phone Number</li><li>'.$phone_no.'</li>
</ul>
<ul>
<li>Postcode</li><li>'.$postcode.'</li>
</ul>
</ul>

<div style="clear:both; margin-top:3%;"><a href="'.  site_url().'admin/vehicle-booking/status/'.$id.'" class="btn">Update status</a></div>
      </div>  
    </div>
  </div>
</div>';
	
	$html.='</span>';
	
    return $html;
}

if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function new_visit($ip,$bra,$mcat,$cat)
 {
	 $CI =& get_instance();  
  $new_ip = $ip;

  $CI->db->from('visitas');
  $CI->db->where('ip_addr', $new_ip);
   $CI->db->where('brand', $bra);
    $CI->db->where('maincategory', $mcat);
  $CI->db->where('category', $cat);  
  $query = $CI->db->get();
  //echo '<pre>'.$CI->db->last_query().'</pre>';
  
  $count = $query->num_rows();

  if ($count > 0) {
   $currentv = new DateTime('NOW');
   $currentv = $currentv->format('Y-m-d H:i:s'); // had to format this

   $q = $CI->db->query("SELECT TIMESTAMPDIFF(HOUR, '$currentv', last_visit) as timediff FROM visitas WHERE ip_addr = '$new_ip' AND brand='$bra' AND maincategory='$mcat' AND category='$cat'");

   $time_diff = $q->row()->timediff;  
   // return $time_diff; <-- just for testing

   if ($time_diff > 10) { 
    $CI->db->set('cant_visit', 'cant_visit+1', FALSE);
    $CI->db->set('last_visit', 'NOW()', FALSE);
    $CI->db->update('visitas');
   }

  } else {
   $data = array(
    'ip_addr'=>$new_ip
   );
   $CI->db->set('cant_visit', 'cant_visit+1', FALSE);
   $CI->db->set('first_visit', 'NOW()', FALSE);
   $CI->db->set('brand',$bra, FALSE);
   $CI->db->set('maincategory','"'.$mcat.'"', FALSE);
     $CI->db->set('category','"'.$cat.'"', FALSE);
   $CI->db->insert('visitas', $data);
  }
 }
 
if ( ! function_exists('word_limiter'))
{
     function word_limiter($str, $limit = 100, $end_char = '&#8230;')
     {
        if (trim($str) == '')
        {
           return $str;
       }

        preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
 
         if (strlen($str) == strlen($matches[0]))
       {
            $end_char = '';
         }
        return rtrim($matches[0]).$end_char;
     }
 }
 
function html_excerpt( $str, $count=500, $end_char = '&#8230;' ) {
	$full_str = $str = strip_all_tags( $str, true );
	$str = mb_substr( $str, 0, $count );
	// remove part of an entity at the end
	$str = preg_replace( '/&[^;\s]{0,6}$/', '', $str );
	
	$str = wordwrap($str, 30, "\n", TRUE);
	
	if(strlen($full_str) <= $count)
	{		
		return $str;
	}
	else
	{
		return trim($str).$end_char;
	}
}
function strip_all_tags($string, $remove_breaks = false) {
	$string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
	$string = strip_tags($string);
	if ( $remove_breaks ) {
		$string = preg_replace('/[\r\n\t ]+/', ' ', $string);
	}
	return trim( $string );
}
 
function get_tooltip($tooltip_config, $type = 'info')
{
	$tooltip = config_item($tooltip_config);
	
	if(empty($tooltip))
		return '';
	
	$tip_html = '';
	
	if($type == 'info') {
		$tip_html = '<span data-toggle="tooltip" data-placement="right" title="'.$tooltip.'">'.
					'<i class="fa fa-info-circle fa-lg" aria-hidden="true"></i></span>';
	}
	
	return $tip_html;
	
}

function get_product_image($product_id)
{
	$product_item_folder = config_item('product_item_folder');
	$customer_product_item_folder = config_item('customer_source_url') . '/' . $product_item_folder . '/';
	$product_item_thumbs = config_item('product_item_thumbs');
	$small_folder = $customer_product_item_folder . $product_item_thumbs['small']['folder'] . '/';
	$medium_folder = $customer_product_item_folder . $product_item_thumbs['medium']['folder'] . '/';
	$large_folder = $customer_product_item_folder . $product_item_thumbs['large']['folder'] . '/';
	
	$CI =& get_instance();  

	$CI->db->from('products_banner');
	$CI->db->where('product_id', $product_id);
	$images = $CI->db->get()->result_array();
	
	foreach ($images as $result) {	
		echo $str ='<img class="img-responsive" src="'.site_url().$medium_folder.$result['banner_image'].'" alt="product1">';
		break;
	}
}

function moneyFormat($number = 0, $decimals = 2, $sanitize = FALSE)
{
	if ($sanitize)
	{
		// Remove any non numeric or decimal point characters.
		$number = trim(preg_replace('/([^0-9\.])/i','',$number));
	}
	$value = round($number, $decimals);
	
	return	number_format($value, $decimals, '.', ',');
}

function replaceValueInLayout($product_src_url, $single_product_layout, $row, $add_to_cart_text = '')
{
	$item_id 				= $row->item_id;	
	$item_price 			= $row->item_price;	
	$item_price_formated 	= $row->item_price_formated;
	$banner_image 			= site_url() . $product_src_url . 'medium/' . $row->banner_image;
	$banner_image_ajax 		= $row->banner_image_ajax;
	$item_name 				= $row->item_name;
	$slug 					= $row->sl;
	$item_weight 			= $row->item_weight;
	$item_desc 				= isset($row->short_product_desc) ? character_limiter($row->short_product_desc, 70, '...') : '';
	$offer_price = '';
	$strike = '';
	if($row->item_offer_price_formated) {
		$offer_price = '<h2 class="offer_price">' . $row->item_offer_price_formated . '</h2>';
		$strike = 'strike_price';
	}
	
	$result = $single_product_layout;
	$result = str_replace('ADD_TO_CART', $add_to_cart_text, $result);
	$result = str_replace('IMAGE_URL', $banner_image, $result);
	$result = str_replace('ITEM_OFFER_PRICE', $offer_price, $result);
	$result = str_replace('STRIKE', $strike, $result);
	$result = str_replace('ITEM_DISPLAY_PRICE', $item_price_formated, $result);
	$result = str_replace('ITEM_NAME', $item_name, $result);
	$result = str_replace('ITEM_ID', $item_id, $result);
	$result = str_replace('ITEM_IMAGE', $banner_image_ajax, $result);
	$result = str_replace('ITEM_PRICE', $item_price, $result);
	$result = str_replace('ITEM_SLUG', $slug, $result);
	$result = str_replace('ITEM_WEIGHT', $item_weight, $result);
	$result = str_replace('ITEM_DESC', $item_desc, $result);
	
	/*if($add_to_cart_text) {		
		$result = replaceValueInLayout($product_src_url, $result, $row, '');
	}*/
	
	return $result;
}

function is_logged_in()
{
	$CI =& get_instance();
	$user_data = $CI->session->userdata('data');
	
	//if(isset($user_data->id))
	if($CI->auth->logged_in())
		return true;
	
	return false;
}

if ( ! function_exists('current_url'))
{
	/**
	 * Current URL
	 *
	 * Returns the full URL (including segments) of the page where this
	 * function is placed
	 *
	 * @return	string
	 */
	function current_url()
	{
		$CI =& get_instance();
		$url = $CI->config->site_url($CI->uri->uri_string());
				
		return $url;
	}
}

function tree_menu($menu, $customer_url_base, $template = 'ecommerce')
{
	if($template == 'ecommerce')
		ecommerce_menu($menu, $customer_url_base);
	else if($template == 'green')
		green_menu($menu, $customer_url_base);
}

function ecommerce_menu($menu, $customer_url_base)
{
	$dropdown_caret = '';
	$dropdown_class = '';
	
	$sub_menu = $menu->sub_menu;
	
	if($sub_menu) {
		$dropdown_class = '';//' class="dropdown-toggle" data-toggle="dropdown"';
		$dropdown_caret = '<b class="caret"></b>';
	}
	?>
	<a<?php echo $dropdown_class;?> href="<?php echo site_url().$customer_url_base;?><?php echo $menu->slug;?>"><?php echo $menu->title;?><?php echo $dropdown_caret;?></a>
	<?php if($sub_menu):?>
	<ul class="dropdown-menu">
		<?php 
		foreach($sub_menu as $list_sub_menu):
			$class = '';
			if($list_sub_menu->sub_menu) {
				$class = ' class="dropdown"';
			}
		?>
		<li<?php echo $class;?>>
			<?php ecommerce_menu($list_sub_menu, $customer_url_base);?>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;
}

function get_testimonial_lists($limit = 0)
{
	$CI =& get_instance();  

	$CI->db->from('testimonials');
	$CI->db->limit($limit);
	$testimonials = $CI->db->get()->result();
	
	return $testimonials;
}

function get_gellery_lists($limit = 0)
{
	$CI =& get_instance();  

	$CI->db->from('gallery_images');
	$CI->db->limit($limit);
	$gallery_images = $CI->db->get()->result();
	
	return $gallery_images;
}


?>