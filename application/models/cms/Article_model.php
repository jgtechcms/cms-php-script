<?php

class Article_model extends MY_Model

{

	protected $_table_name = 'articles';

	protected $_order_by = 'id desc';

	protected $_timestamps = TRUE;

	public $rules = array(

		'title' => array(

			'field' => 'title', 

			'label' => 'Title', 

			'rules' => 'trim|required|max_length[100]'

		), 

		'article_category_id' => array(

			'field' => 'article_category_id', 

			'label' => 'Category', 

			'rules' => 'trim|required'

		), 

		'body_desc' => array(

			'field' => 'body_desc', 

			'label' => 'Content', 

			'rules' => 'trim|required'

		)

	);



	public function get_new ()

	{

		$article = new stdClass();
		$article->title = '';
		$article->slug = '';
		$article->body = '';
		$article->meta_tag = '';
		$article->meta_description = '';
		$article->upload_images = '';
		$article->pubdate = date('Y-m-d');
		return $article;

	}

	

	public function set_published(){

		$this->db->where('pubdate <=', date('Y-m-d'));

	}

	

	public function get_recent($limit = 3){

		

		// Fetch a limited number of recent articles

		$limit = (int) $limit;

		$this->set_published();

		$this->db->limit($limit);

		return parent::get();

	}
	
	
	public function getWithAssociate($limit = null)
	{
		$this->db->select('articles.*, article_category.name, article_category.slug As cat_slug');
		$this->db->from('articles');
		$this->db->join('article_category', 'article_category.id = articles.article_category_id');
		$this->db->order_by('articles.created', 'desc');
		
		if($limit)
			$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getWithAssociate_new($widget_contents)
	{
		$this->db->select('articles.*, article_category.name, article_category.slug As cat_slug');
		$this->db->from('articles');
		$this->db->join('article_category', 'article_category.id = articles.article_category_id');
		$this->db->order_by('articles.created', 'desc');
		
		foreach($widget_contents as $content) {
			if($content->slug == 'blog' and $content->page_limit) {
				$this->db->limit($content->page_limit);
				break;
			}
		}
		
		$query = $this->db->get();
		return $query->result();
	}



}