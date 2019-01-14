<?php

class Article_category_model extends MY_Model

{	

	protected $_table_name = 'article_category';

	public $rules = array(

		'name' => array(

			'field' => 'name', 

			'label' => 'Name', 

			'rules' => 'trim|required|max_length[150]|xss_clean'

		), 

	);

	function __construct ()
	{
		parent::__construct();
	}
	
	
	
	function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL)
	{
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;
	 
		if($key)$params["$key !="] = $value;
	 
		while ($t->db->where($params)->get($table)->num_rows())
		{  
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			 
			$params [$field] = $slug;
		}  
		return $slug;  
	}

	public function getWithAssociate()
	{
		$this->db->select('article_category.*');
		$this->db->from('article_category');
		$this->db->join('articles', 'articles.article_category_id = article_category.id');
		$this->db->group_by('article_category.id');
		//$this->db->order_by('gallery.title', 'desc');
				
		$query = $this->db->get();
		return $query->result();
	}

}