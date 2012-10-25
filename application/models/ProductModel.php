<?php
class ProductModel extends CI_Model{
	
	var $baseProductSql = 'select p.sku, p.product_name, p.description, p.price_init, 
							p.date_first_online, p.is_online,
							r.product_name as product_name_raw, r.description as description_raw, 
							r.url, r.original_url, r.image_url, r.price as price_now, IF( p.price_init > r.price, p.price_init - r.price, 0 ) as price_saving, 
							r.delivery_cost, r.currency_code, r.brand, r.colour, r.gender, r.size, 
							r.date_created, r.date_modified
							from product p inner join product_raw r on p.sku = r.sku where 0 = 0 ';
	var $default_page_size = 50;
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set('Australia/NSW');
    }

	/*
	 * return product_raw (object) matched with input $sku
	 */
	public function getProductRaw($productSKU){
    	$result = NULL;

    	$query = $this->db->get_where('product_raw', array('sku' => $productSKU));
    	if ($query->num_rows() > 0){
           $row = $query->row(); 
           $result = $row;
        }
        
        $query->free_result(); 
        return $result;
	}
	
	/*
	 * add new product into 2 table
	 *  - product_raw
	 *  - product
	 */
	public function addProductRaw($param){
		//add to product_raw table
		$param['date_created']  = date('Y-m-d H:i:s');
		$param['date_modified'] = date('Y-m-d H:i:s');
		$this->db->insert('product_raw', $param);
		
		//add to product table
		$product = array();
		$product['sku'] 		 	= $param['sku'];
		$product['product_name'] 	= $param['product_name'];
		if (isset($param['description'])){
			$product['description'] = $param['description'];
		}
		$product['price_init']   	= $param['price'];
		$product['is_online']	 	= 0;
		$this->db->insert('product', $product);

    	return $this->db->insert_id();
	}
	
	/*
	 * update existing product_raw
	 */
	public function updateProductRaw($productSKU, $param){
		$param['date_modified'] = date('Y-m-d H:i:s');
		$this->db->where('sku', $productSKU);
		$this->db->update('product_raw', $param);
	}
	
	/* 
	 * return product (object) matched with input $sku
	 *   by default, get online product ($is_online = -1 mean any online/offline status)
	 *					1 = online only
	 *					0 = offline only
	 *				   -1 = any status
	 */
	public function getProduct($productSKU, $is_online = 1){
		$result = NULL;
	
		$sql = $this->baseProductSql.' and p.sku = ? ';
		if ($is_online >= 0){
			$sql = $sql.' and p.is_online = '.$is_online;
		}
	
		$query = $this->db->query($sql, array($productSKU));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$result = $row;
		}
	
		$query->free_result();
		return $result;
	}
	
	/*
	 * return list of product, filter available are
	 * - brands    (array of brand)
	 * - is_online (1 = online only, 0 = offline, negative = all)
	 * - sort and sort_dir (both need to come together, e.g. sort = product_name, sort_dir = desc)
	 * - page_size 
	 * - page_index (start from 0)
	 */
	public function getProductList($filter = array()){
		$sql = $this->baseProductSql;
		
		//filter#1 brands
		if (isset($filter['brands'])){$sql = $sql." and r.brand in (".$this::arrayListToStringList($filter['brands']).")";}		
		//filter#2 is_online
		if (isset($filter['is_online'])){
			if ($filter['is_online'] >= 0){			
				$sql = $sql." and p.is_online = ".$filter['is_online'];
			}
		}
		
		//sorting
		if (isset($filter['sort'])){
			$sql = $sql.' order by '.$filter['sort'].' '.$filter['sort_dir'];
		}
		else{
			$sql = $sql.' order by p.date_first_online desc';
		}
		
		//setup page return
		if (!isset($filter['page_index'])){$filter['page_index'] = 0;}
		if (!isset($filter['page_size'])){$filter['page_size'] = $this->default_page_size;}
		$sql = $sql.' limit '.($filter['page_index'] * $filter['page_size']).', '.$filter['page_size'];
echo $sql;
		//execute query
		$query = $this->db->query($sql);
		$data = $query->result_array();
		$query->free_result();
		return $data;
	}
	
	
	/*
	 * function return array list to string list with quote and comma separation
	 */
	private function arrayListToStringList($arrayList){
		$arrayLength = count($arrayList);	
		$result = '';
		for($i = 0; $i<$arrayLength; $i++){
			$result = $result."'".$arrayList[$i]."'";
			if ($i < ($arrayLength-1)){
				$result = $result.',';
			}
		}
		if($result == ''){$result = "''";}
		return $result;
	}
	
}