<?php 

class Product extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
        $this->load->model('CategoryModel');
    }	

	public function index()
	{
		echo('hitting the index function - will show all product');
	}
	

	/*
	 *	view product page by productId
	 *	- should check if productId is empty, then redirect to something??
	 */
	public function view($sku){
		echo('you are on product page<br>Sku is: '.$sku.'<br><br>');	
		
		$product = $this->ProductModel->getProduct($sku, 1);
		$photos  = $this->PhotoModel->getPhotoList($sku);
		
		$data = array();
		$data['product'] = $product;
		$data['photos']  = $photos; 
		$this->load->view('product', $data);
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
			$filter['brands'] = array($brand);
		}
		$products = $this->ProductModel->getProductList($filter);
		//var_dump($products);
		$data = array();
		$data['products'] = $products;
		$this::loadViewProductBrowsing($data);
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
		$data['head']   = $this->load->view('head',   '', TRUE);
		
		$header = array();
		$header['cat_clothing']    = $this->CategoryModel->getCategoryList(1);
		$header['cat_accessories'] = $this->CategoryModel->getCategoryList(2);
		$data['header'] = $this->load->view('header', $header, TRUE);
		
		$data['ads'] 	= $this->load->view('ads', 	  '', TRUE);
		$data['footer'] = $this->load->view('footer', '', TRUE);
		
		$data['nav_html'] = $this::getNavigatorHtml();
		 
		$this->load->view('product_browsing', $data);
	}
	
	private function getNavigatorHtml(){
		$result = '<a href="'.base_url().'" class="navigatefont1">home</a>';
	
		for ($i = 1; $i <= $this->uri->total_segments(); $i++){
			$result = $result.' >> <a href="'.base_url();
			for ($j = 1;$j <= $i; $j++){
				$result = $result.$this->uri->segment($j).'/';
			}
			$result = $result.'" class="navigatefont2">'.$this->uri->segment($i).'</a>';
		}
	
		return $result;
	}
	
}

