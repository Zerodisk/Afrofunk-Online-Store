<?php
class ProductModel extends CI_Model{
	
	//affiliate products (is_my = 0)
	var $baseProductSql = 'select p.sku, r.mid, p.product_name, p.description, p.price_init, 
							p.date_first_online, p.is_online,
							r.product_name as product_name_raw, r.description as description_raw, 
							r.url, r.original_url, p.image_url, r.price as price_now, IF( p.price_init > r.price, p.price_init - r.price, 0 ) as price_saving, 
							r.delivery_cost, r.currency_code, r.brand, r.colour, r.gender, r.size, 
							r.date_created, r.date_modified, c.cat_id, c.category_name, c.parent_id,
			                0 as is_my
							from product p inner join product_raw r on p.sku = r.sku
							left join category c on p.cat_id = c.cat_id 
							where 0 = 0 ';
	
	//my own products (is_my = 1)
	var $myProductSql   = 'select pm.sku, pm.mid, pm.product_name, pm.description, pm.price_init, 
							pm.date_first_online, pm.is_online,
							pm.product_name as product_name_raw, pm.description as description_raw, 
							NULL as url, NULL as original_url, pm.image_url, pm.price as price_now, IF( pm.price_init > pm.price, pm.price_init - pm.price, 0 ) as price_saving, 
							NULL as delivery_cost, NULL as currency_code, pm.brand, NULL as colour, NULL as gender, NULL as size, 
							pm.date_created, pm.date_modified, cm.cat_id, cm.category_name, cm.parent_id,
							1 as is_my
							from product_my pm left join category cm on pm.cat_id = cm.cat_id 
							where 0 = 0 ';
	
	var $default_page_size = 150;
	var $my_mid   = 99;				//this is mid (merchant ID) for Afro Funk my own product.
	var $my_brand = 'Afro Funk';	//this is my own brand (afro funk);
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        
        $this->load->model('CategoryModel');
        date_default_timezone_set('Australia/NSW');
    }
    
    public function getDefaultPageSize(){
    	return $this->default_page_size;
    }
    
    public function getMyBrand(){
    	return $this->my_brand;
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
		$date_now				= date('Y-m-d H:i:s');
		$param['date_created']  = $date_now;
		$param['date_modified'] = $date_now;
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
		$product['date_modified']   = $date_now;
		$this->db->insert('product', $product);

    	return $param['sku'];
	}
	
	/*
	 * add my own product
	 *   mandatory requirement fields
	 *   - product_name
	 *   - price
	 *   
	 *   optional
	 *   - description
	 *   - cat_id
	 *   - image_url
	 */
	public function addProductMy($param){
		//log global value model
		$this->load->model('GlobalvalueModel');
		
		//get the next product id
		$id = $this->GlobalvalueModel->getGlobalValue('product_my_id')->value;	
		
		$param['sku'] 		    = $this->my_mid.'-'.$id;
		$param['mid']			= $this->my_mid;
		$param['brand']			= $this->my_brand;
		$param['price_init']    = $param['price'];		
		$param['date_created']  = date('Y-m-d H:i:s');
		$param['date_modified'] = date('Y-m-d H:i:s');		
		
		$this->db->insert('product_my', $param);
		
		//update new product id + 1 (plus 1)
		$this->GlobalvalueModel->updateGlobalValue('product_my_id', ($id + 1));
		
		return $param['sku']; 
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
		$table_subfix = '';
		
		if ($this::isMyProduct($sku)){
			$table_subfix = '_my';
		}
		
		$this->db->where('sku', $sku);
		$this->db->update('product'.$table_subfix, $param);
	}
	
	/* 
	 * return product (object) matched with input $sku
	 * note: avoid using UNION as per better performance
	 */
	public function getProduct($sku){
		$result = NULL;	
		if ($this->isMyProduct($sku)){
			$sql = $this->myProductSql.' and pm.sku = ?';
		}
		else{
			$sql = $this->baseProductSql.' and p.sku = ?';
		}					
	
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
	 * 5. mids				(array of merchant id)
	 * 
	 * - sort and sort_dir (both need to come together, e.g. sort = product_name, sort_dir = desc)
	 * - page_size 
	 * - page_index (start from 0)
	 */
	public function getProductList($filter = array()){
		$sql = $this::getSqlProductAff($filter).' union '.$this::getSqlProductMy($filter);
		
		//sorting
		if (isset($filter['sort'])){
			$sql = $sql.' order by '.$filter['sort'].' '.$filter['sort_dir'];
		}
		else{
			$sql = $sql.' order by date_first_online desc';
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
	 * just return number of item from product table (exclude my product)
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
	 * just return number of item that are online (exclude my product)
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
	 * my own product (afrofunk merchant), sku start with 99- (e.g. 99-1000, 99-1001)
	*/
	public function isMyProduct($sku){
		if (substr($sku, 0, 3) == $this->my_mid.'-'){
			return TRUE;
		}
		else{
			return FALSE;
		}
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
	
	/*
	 * function return array list to internet list with quote and comma separation
	*/
	private function arrayListToNumberList($arrayList){
		if (is_array($arrayList)){
			if (count($arrayList) > 0)
				return ''.implode(',',$arrayList).'';
			else
				return '-999';		//return a dummy mid
		}
		else{
			return $arrayList;
		}
	}
	
	/*
	 * return the sql for my product, this won't include sorting and limiting
	 */
	private function getSqlProductMy($filter = array()){
		$sql = $this->myProductSql;
		
		//filter#1 brands
		if (isset($filter['brands'])){$sql = $sql." and pm.brand in (".$this::arrayListToStringList($filter['brands']).")";}
		//filter#2 is_online
		if (isset($filter['is_online'])){
			if ($filter['is_online'] >= 0){
				$sql = $sql.' and pm.is_online = '.$filter['is_online'];
			}
		}
		//filter#3 cat_id
		if (isset($filter['cat_id'])){
			switch ($filter['cat_id']){
				case 1:
					$sql = $sql.' and cm.cat_id in ('.$this->CategoryModel->getClothingCatIdList().')';
					break;
				case 2:
					$sql = $sql.' and cm.cat_id in ('.$this->CategoryModel->getAccessoriesCatIdList().')';
					break;
				default:
					$sql = $sql.' and cm.cat_id = '.$filter['cat_id'];
					break;
			}
		}
		//filter#4 is_fullprice
		if (isset($filter['is_fullprice'])){
			if ($filter['is_fullprice']){
				$sql = $sql.' and pm.price_init = pm.price';
			}
			else{
				$sql = $sql.' and pm.price_init > pm.price';
			}
		}
		
		//filter#5 merchant
		if (isset($filter['mids'])){$sql = $sql." and pm.mid in (".$this::arrayListToNumberList($filter['mids']).")";}
		
		return $sql;
	}
	
	/*
	 * return the sql for affiliate product, this won't include sorting and limiting
	 */
	private function getSqlProductAff($filter = array()){
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
		
		//filter#5 merchant
		if (isset($filter['mids'])){$sql = $sql." and r.mid in (".$this::arrayListToNumberList($filter['mids']).")";}
		
		return $sql;
	}
	

	
}