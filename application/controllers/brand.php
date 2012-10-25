<?php 

class Brand extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
    }	
	
	public function index()
	{
		echo('hitting the index function - will show brand page');
	}
	

	/*
	 *	view list of online products page by brandName
	 *	  3 query strings (optional)
	 *	  - page_size
	 *    - page_index
	 *    - is_online (0 or 1 or negative value)
	 */
	public function view($brandName = ''){
		$filter = array();
		$filter['brand'] = $brandName;
		$input = $this->input->get();
		
		if (isset($input['page_size'])){
			$filter['page_size'] = $input['page_size'];	
		}
		
		if (isset($input['page_index'])){
			$filter['page_index'] = $input['page_index'];
		}
		
		if (isset($input['is_online'])){
			$filter['is_online'] = $input['is_online'];
		}
		else{
			$filter['is_online'] = 1;
		}
		
		$products = $this->ProductModel->getProductList($filter);
		var_dump($products);
	}

	/*
	 *	for finding brand page by brand keyword 
	 *	- this happen in case of we can't update the routing table (routes.php)
	 */
	/*
	public function findByKeyword($brandKeyword = ''){
		echo('find brand by keyword of: '.$brandKeyword);

		$this::writeSegment();
	}
	*/





}

