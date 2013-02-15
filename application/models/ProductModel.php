<?php
class ProductModel extends CI_Model{
	
	var $baseProductSql = 'select p.sku, p.product_name, p.description, p.price_init, 
							p.date_first_online, p.is_online,
							r.product_name as product_name_raw, r.description as description_raw, 
							r.url, r.original_url, p.image_url, p.price_init, r.price as price_now, IF( p.price_init > r.price, p.price_init - r.price, 0 ) as price_saving, 
							r.delivery_cost, r.currency_code, r.brand, r.colour, r.gender, r.size, 
							r.date_created, r.date_modified, c.cat_id, c.category_name, c.parent_id
							from product p inner join product_raw r on p.sku = r.sku
							left join category c on p.cat_id = c.cat_id 
							where 0 = 0 ';
	var $default_page_size = 150;
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        
        $this->load->model('CategoryModel');
        date_default_timezone_set('Australia/NSW');
    }
    
    public function getDefaultPageSize(){
    	return $this->default_page_size;
    }

	/*
	 * return product_raw (object) matched with input $sku
	 */
	public function getProductRaw($sku){
    	$result = NULL;

    	$query = $this->db->get_where('product_raw', array('sku' => $sku));
    	if ($query->num_rows() > 0){
           $row = $query->row(); 
           $result = $row;
        }
        
        $query->free_result(); 
        return $result;
	}
	
	/*
	 * return list of product_raw for a given original_url
	 */
	public function getProductRawListByOriginalURL($original_url){
    	$query = $this->db->get_where('product_raw', array('original_url' => $original_url));
		$data = $query->result_array();
		$query->free_result();
		return $data;
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
		$product['image_url']   	= $param['image_url'];		//move image_url to product table 3-jan-2013
		$product['is_online']	 	= 0;
		$product['date_modified']   = date('Y-m-d H:i:s');
		$this->db->insert('product', $product);

    	return $this->db->insert_id();
	}
	
	/*
	 * update existing product_raw
	 */
	public function updateProductRaw($sku, $param){
		$param['date_modified'] = date('Y-m-d H:i:s');
		$this->db->where('sku', $sku);
		$this->db->update('product_raw', $param);
	}
	
	/*
	 * update existing product
	 */
	public function updateProduct($sku, $param = array()){
		$param['date_modified'] = date('Y-m-d H:i:s');
		$this->db->where('sku', $sku);
		$this->db->update('product', $param);
	}
	
	/* 
	 * return product (object) matched with input $sku
	 */
	public function getProduct($sku){
		$result = NULL;	
		$sql = $this->baseProductSql.' and p.sku = ? ';
	
		$query = $this->db->query($sql, array($sku));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$result = $row;
		}
	
		$query->free_result();
		return $result;
	}
	
	/*
	 * return list of product, filter available are
	 * 1. brands    		(array of brand)
	 * 2. is_online 		(1 = online only, 0 = offline, negative = all = this value NotSet)
	 * 3. cat_id    		(category id, Not Set = no category fillter)
	 * 4. is_fullprice 		(TRUE = item with full price, FALSE = item with discount, NotSet = no filter by price at all) 
	 * 
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
				$sql = $sql.' and p.is_online = '.$filter['is_online'];
			}
		}
		//filter#3 cat_id
		if (isset($filter['cat_id'])){
			switch ($filter['cat_id']){
				case 1:
					$sql = $sql.' and c.cat_id in ('.$this->CategoryModel->getClothingCatIdList().')';
					break;
				case 2:
					$sql = $sql.' and c.cat_id in ('.$this->CategoryModel->getAccessoriesCatIdList().')';
					break;
				default:
					$sql = $sql.' and c.cat_id = '.$filter['cat_id'];
					break;
			}
		}
		//filter#4 is_fullprice
		if (isset($filter['is_fullprice'])){
			if ($filter['is_fullprice']){
				$sql = $sql.' and p.price_init = r.price';
			}
			else{
				$sql = $sql.' and p.price_init > r.price';
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

		//execute query
		$query = $this->db->query($sql);
		$data = $query->result_array();
		$query->free_result();
		return $data;
	}
	
	/*
	 * just return number of item from product table
	*/
	public function getNumberOfItem(){
		$sql = 'select count(*) as num_items from product';
	
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			$result = $row;
		}
	
		$query->free_result();
		return $result->num_items;
	}
	
	/*
	 * just return number of item that are online
	 */
	public function getNumberOfOnlineItem(){
		$sql = 'select count(*) as num_items from product where is_online = 1';
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$row = $query->row();
			$result = $row;
		}
	
		$query->free_result();
		return $result->num_items;
	}
	
	/*
	 * delete x number of given $num_product offline product
	 */
	public function deleteProducts($num_product = 100){
		$data = $this::getOfflineProductForDeletion($num_product);
		foreach($data as $product){
			$this::deleteProduct($product['sku']);			
		}
	}
	
	/*
	 * delete a give sku from 3 tabled - product, product_raw, photo
	 */
	public function deleteProduct($sku){
		$this->db->delete('product_raw', array('sku' => $sku));
		$this->db->delete('product',     array('sku' => $sku));
		$this->db->delete('photo',       array('sku' => $sku));
	}
	
	/*
	 * get list of offline product order by date_created asc
	 */
	public function getOfflineProductForDeletion($num_product){
		$sql = 'select p.sku, r.date_created from product p inner join product_raw r on p.sku = r.sku
					where p.is_online = 0 order by r.date_created asc limit '.$num_product;
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
		if (is_array($arrayList)){
			return "'".implode("','",$arrayList)."'";	
		}	
		else{
			return "'".$arrayList."'";
		}
	}
	
}