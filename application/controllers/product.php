<?php 

class Product extends MY_Controller {
	
	var $meta_title = 'Afrofunk Clothing Sydney';
	var $meta_description = 'Australia best online affiliate fashion and footwear store. Products are selected with Funky and Streetware style with the trendiest brands. Buy clothes online, shoes online, and fashion accessories.';
	var $meta_keyword = 'Funky Fashion Accessories, Streetware vision, Designer clothes women, Women designer clothes, Ladies Fashion accessories';

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
        $this->load->model('CategoryModel');
        $this->load->model('BrandModel');
    }	

	public function index()
	{
		echo('hitting the index function - will show all product');
	}
	
	/*
	 *	view product popup by productId
	 *    this will be called from product_browsing only
	*/
	public function view_popup($sku){
		$product = $this->ProductModel->getProduct($sku, 1);
		$photos  = $this->PhotoModel->getPhotoList($sku);
	
		$data = array();
		$data['product'] = $product;
		$data['photos']  = $photos;
	
		$this->load->view('product_popup', $data);
	}
	
	/*
	 *	view product page by productId
	 *	- should check if productId is empty, then redirect to something??
	 */
	public function view($sku){
		//echo('you are on product page<br>Sku is: '.$sku.'<br><br>');	
		
		$product = $this->ProductModel->getProduct($sku, 1);
		$photos  = $this->PhotoModel->getPhotoList($sku);
		
		$data = array();
		$data['head']   = $this->load->view('head',   '', TRUE);
		$header = $this::getFrontendHeader(1, 2, TRUE);
		$data['header'] = $this->load->view('header', $header, TRUE);
		$data['footer'] = $this->load->view('footer', '', TRUE);
		
		$data['product'] = $product;
		$data['photos']  = $photos; 
		
		if ($product == null){
			$this->load->view('notfound', $data);		
		}
		else{
			$this->load->view('product', $data);
		}
	}

	
	/*
	 *  browse for a given category
	 *    NULL mean regardless of category
	 */
	public function browsingByCat($cat_id = NULL){
		$filter = array();
		$filter['is_online'] = 1;
		$filter['cat_id'] = $cat_id;
		
		$products = $this->ProductModel->getProductList($filter);
		//var_dump($products);
		$data = array();
		$data['products'] = $products;
		
		if ($cat_id != null){
			$category = $this->CategoryModel->getCategory($cat_id);
			//add brand name into meta-description and title
			if ($category->description != ''){
				$this->meta_description = $category->description;
			}
			$this->meta_title   	= 'Category: '.$category->category_name.' | '.$this->meta_title;
		}
		
		$this::loadViewProductBrowsing($data);
	}

	
	/*
	 *  browse for the same item (price name is cheaper than price initial
	 *    $filter['is_fullprice'] = FALSE;
	 */
	public function browsingBySale($cat_id = NULL){
		$filter = array();
		$filter['is_online'] = 1;
		$filter['cat_id'] = $cat_id;
		$filter['is_fullprice'] = FALSE;
		
		$products = $this->ProductModel->getProductList($filter);
		//var_dump($products);
		$data = array();
		$data['products'] = $products;
		
		if ($cat_id != null){
			$category = $this->CategoryModel->getCategory($cat_id);
			//add brand name into meta-description and title
			$this->meta_description = $category->category_name.' are on sale online at Afro Funk';
			$this->meta_title   	= $category->category_name.' is on sale now | '.$this->meta_title;
		}
		
		$this::loadViewProductBrowsing($data);
	}
	
	/*
	 *  browse by brand name
	 *    for a given brand
	 *    if no input, then show everything ???
	 */
	public function browsingByBrand($brand = NULL){
		$filter = array();
		$filter['is_online'] = 1;
		if ($brand != NULL){
			//do brand check for exception list, if match then replace with one in exception list
			$exception = $this->BrandModel->getExceptionBrandList();
			if (array_key_exists($brand, $exception)){
				$brand = $exception[$brand];
			}
			
			$brand = str_replace('-', ' ', $brand);		//replace dash (-) with space
			$filter['brands'] = array($brand);
			
			//add brand name into meta-description, meta-keyword and title
			$this->meta_description = 'Shop for '.$brand.' clothing online at Afro Funk';
			$this->meta_keyword 	= $brand.', '.$this->meta_keyword;
			$this->meta_title   	= $brand.' | '.$this->meta_title; 
		}
		$products = $this->ProductModel->getProductList($filter);
		
		$data = array();
		$data['products'] = $products;
		$this::loadViewProductBrowsing($data);
	}
	
	/*
	 *  to feed the RSS
	*/
	public function rss(){
		$filter = array();
		$filter['is_online'] = 1;
		$filter['page_size'] = 50;
	
		$products = $this->ProductModel->getProductList($filter);

		$data = array();
		$data['products'] = $products;
				
		header("Content-Type: application/rss+xml");
		$this->load->view('rss', $data);
	}	
	
	

	/*
	 * this is for view product browsing in the front end page
	 * $data can have
	 *   - products 		    = list of product that will be display
	 *
	 *   - page			= page_index, start from 0
	 *   - sort   		= sort by
	 *   - sort_dir 		= sort direction (asc or desc)
	 *   - products		= list of product
	 */
	private function loadViewProductBrowsing($data){	
		$data['head']   	= $this->load->view('head',   '', TRUE);
		
		$header 			= $this::getFrontendHeader(1, 2, TRUE);
		$data['header'] 	= $this->load->view('header', $header, TRUE);
		
		$data['ads'] 		= $this->load->view('ads', 	  '', TRUE);
		$data['footer'] 	= $this->load->view('footer', '', TRUE);
		
		$data['nav_html'] 	= $this::getNavigatorHtml();
		$data['show_product_as_popup'] = $this::showProductAsPopup();
		
		$data['meta_title']		  = $this->meta_title;
		$data['meta_description'] = $this->meta_description;
		$data['meta_keyword']	  = $this->meta_keyword;
		 
		$this->load->view('product_browsing', $data);
	}
	
	/*
	 * this is for return html of the navigation start from home
	 *    home >> category >> product
	 *    home >> brands >> brand name
	 */
	private function getNavigatorHtml(){
		$result = '<a href="'.base_url().'" class="navigatefont1">home</a>';
	
		for ($i = 1; $i <= $this->uri->total_segments(); $i++){
			$result = $result.' >> <a href="'.base_url();
			for ($j = 1;$j <= $i; $j++){
				$result = $result.$this->uri->segment($j).'/';
			}
			$result = $result.'" class="navigatefont2">'.str_replace('-', ' ', $this->uri->segment($i)).'</a>';
		}
	
		return $result;
	}
	
	/*
	 * fucntion check browser agent and design if it should show product as popup within the same window or not (using ajax)
	 *   return true: for display as ajax popup
	 *   return false: for display in their own page
	 */
	private function showProductAsPopup(){
		//need user agent library to check browser type
		$this->load->library('user_agent');
		
		if (($this->agent->is_browser('Chrome') || $this->agent->is_browser('Firefox') || $this->agent->is_browser('Safari')) && ($this->agent->mobile() == '')){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
}

