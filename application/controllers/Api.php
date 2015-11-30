<?php 

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('BrandModel');
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
    }	
	
	//for testing
	public function index_get(){
		//$result = new stdClass();
		//$result->word = 'hello';

		$result = (object) ['word' => 'hello'];

		$this->response($result, 200);
	}

	//get all brand list
	public function brands_get(){
		$this->response($this->BrandModel->getBrandList(), 200);
	}

	//get all online product list
	public function products_get(){
		$filter = array();
		$filter['is_online'] = 1;
		$result = $this->ProductModel->getProductList($filter);

		for ($index = 0; $index <= sizeof($result); $index++){
			//remove un-used elements
			unset($result[$index]['date_first_online']);
			unset($result[$index]['product_name_raw']);
			unset($result[$index]['description_raw']);
			unset($result[$index]['delivery_cost']);
			unset($result[$index]['mid']);
			unset($result[$index]['is_online']);
			unset($result[$index]['parent_id']);
			unset($result[$index]['original_url']);
			unset($result[$index]['date_created']);
		}

		$this->response($result, 200);
	}

	//get a selected sku product
	public function product_get($sku){
		$product = $this->ProductModel->getProduct($sku);

		if ($product == NULL){
			$product = new stdClass();
		}
		else{
			//add all product images
			$product->images = $this->PhotoModel->getPhotoList($sku);

			//remove non-used element
			unset($product->description_raw);
			unset($product->product_name_raw);
			unset($product->original_url);
			unset($product->parent_id);
		}

		$this->response($product, 200);
	}

}


