<?php 

class Product extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
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
	public function view($productSku){
		echo('you are on product page<br>Sku is: '.$productSku.'<br><br>');	
		
		$product = $this->ProductModel->getProduct($productSku, 1);
		//var_dump($product);
		
		$data = array();
		$data['product'] = $product;
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
		$data['header'] = $this->load->view('header', '', TRUE);
		$data['ads'] 	= $this->load->view('ads', 	  '', TRUE);
		$data['footer'] = $this->load->view('footer', '', TRUE);
		 
		$this->load->view('product_browsing', $data);
	}
	
}

