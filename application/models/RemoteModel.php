<?php
class RemoteModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('ProductModel');
    }

    /*
     *	- select product with $productSKU
     *	- if not found,
     *		 easy as just add
     *	  else
     *	     check what different, and update
     *	- return true when success
     *	- return false when failed (it should be db error return if there is any
     */
	public function doProductUpdate($param){
		$productSKU = $param['sku'];
		
		try {
			$result = $this->ProductModel->getProductRaw($productSKU);
			if ($result == NULL){
				//new product sku
				$includeParam = array('sku','product_name','description','url','original_url','image_url','price','delivery_cost','currency_code','brand','colour','gender','size');
				$param = $this::filterParam($param, $includeParam);
				$this->ProductModel->addProductRaw($param);
			}
			else{
				//existing product sku, just do a smart update   
				//    remove brand name update 4-jan-2013
				$includeParam = array('product_name','description','url','original_url','image_url','price','delivery_cost','currency_code','colour','gender','size');
				$param = $this::filterParam($param, $includeParam);
				$this->ProductModel->updateProductRaw($productSKU, $param);
			}
			return TRUE;
		} 
		catch (Exception $e) {
			echo('Caught exception: '.$e->getMessage());
			return FALSE;	
		}
	}
	
	/*
	 * return list of sku for online product
	 */
	public function getOnlineProductList(){
		$sql = 'select sku from product where is_online = 1';
		$query = $this->db->query($sql);
		$data = $query->result_array();
		$query->free_result();
		return $data;
	}
	
	/*
	 * this is the final step need to do once after product update sync done
	 *   1. update brand name
	 *   
	 */
	public function doFinaliseUpdate(){
		$sql = "update product_raw set brand = '1&20 Blackbirds' where brand = '1&20; Blackbirds'";
		$this->db->query($sql);
		
		$sql = "update product_raw set brand = '80%20' where brand = '80 '";
		$this->db->query($sql);
		
		$sql = "update product_raw set brand = 'House Of Harlow' where brand = 'House Of Harlow 1960'";
		$this->db->query($sql);
		
		$sql = "update product_raw set brand = 'Atmos&Here' where brand = 'Atmos&Here;'";
		$this->db->query($sql);
	}
	
	
	
	
	
	/*
	 * remove anything in param that is not in includeParam, then return $param
	 */
	private function filterParam($param, $includeParam){
		//get list of key in array
		$array_key = array_keys($param);
		//loop through all key in $param, then remove if not in $includeParam
		foreach ($array_key as $key) {
			if (!in_array($key, $includeParam)) {
				unset($param[$key]);
			}
		}
		return $param;
	}
	
	
	
	
}