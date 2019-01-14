<?php
class Page_widgets_model extends MY_Model
{

	protected $_table_name = 'page_widgets';
	protected $_order_by = 'order_by';
	
	public function getRelatedWidgets($id)
	{
		$this->db->select('widgets.*, widget_type_id, widget_types.slug');
		$this->db->from('page_widgets');
		$this->db->where('page_widgets.page_id', $id);
		$this->db->join('widgets', 'page_widgets.widget_id = widgets.id');
		$this->db->join('widget_types', 'widget_types.id = widgets.widget_type_id');//echo $this->db->get_compiled_select();
		$this->db->order_by('page_widgets.order_by');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getRelatedProductsFromAndTo($product_id)
	{
		/*$this->db->select('products.item_id, products.item_name, products.item_price, products.qty, products.status, products.slug as sl,
		(select banner_image from products_banner WHERE products.item_id = products_banner.product_id LIMIT 1) AS banner_image');
		$this->db->from('products_related');
		$this->db->where('products_related.product_id', $product_id);
		$this->db->or_where('products_related.product_related_id', $product_id);
		$this->db->join('products', 'products_related.product_related_id = products.item_id');
		//echo $this->db->get_compiled_select();
		$query = $this->db->get();
		return $query->result();
		*/
		
		// union
		$sql = 'SELECT p1.item_id, p1.item_name, p1.item_price, p1.qty, '.
				'p1.status, p1.slug as sl, p1.item_weight, '.
				'(select banner_image from products_banner WHERE p1.item_id = products_banner.product_id LIMIT 1) AS banner_image '.
				'FROM products_related rel '.
				'JOIN products p1 ON rel.product_related_id = p1.item_id '.
				'WHERE rel.product_id = \''.$product_id.'\' '.
				'UNION '.
				'SELECT p2.item_id, p2.item_name, p2.item_price, p2.qty, '.
				'p2.status, p2.slug as sl, p2.item_weight, '.
				'(select banner_image from products_banner WHERE p2.item_id = products_banner.product_id LIMIT 1) AS banner_image '.
				'FROM products_related rel2 '.
				'JOIN products p2 ON rel2.product_id = p2.item_id '.
				'WHERE rel2.product_related_id = \''.$product_id.'\' ';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function removeProducts($page_id)
	{
		$this->db->cache_delete_all();
		
		$this->db
			->where('page_id', $page_id)
			->delete('page_widgets');
	}
}