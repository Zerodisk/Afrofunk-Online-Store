<?php 

class Product extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
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
	
	public function all(){
		
	}

	/*
	 *	for finding brand page by brand keyword 
	 *	- this happen in case of we can't update the routing table (routes.php)
	 */
	/*
	public function brandFindByKeyword($brandKeyword = ''){
		echo('find brand by keyword of: '.$brandKeyword);

		$this::writeSegment();
	}
	*/

}

