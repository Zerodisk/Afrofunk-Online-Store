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
		echo('you are on product page - '.$this->uri->segment(2).'<br>ProductSku is: '.$productSku.'<br><br>');	
		
		$product = $this->ProductModel->getProduct($productSku, 1);
		var_dump($product);
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
		var_dump($products);
	}

	/*
	 * browse for new arrival
	 *   new arrival is always order by date_first_online desc
	 *   so the result will be exactly the same as "browsingByCat" anyway !!
	 */
	public function browsingByNewArrival($cat_id = NULL){
		$filter = array();
		$filter['is_online'] = 1;
		$filter['cat_id'] = $cat_id;
		
		$filter['page_size'] = 20;
		$filter['page_index'] = 0;
		
		$products = $this->ProductModel->getProductList($filter);
		var_dump($products);
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
		var_dump($products);
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
		var_dump($products);
	}
	
	
	
	


}

