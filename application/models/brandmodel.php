<?php
class BrandModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('GlobalvalueModel');
    }

    /*
     * return list of brand
     *   isAll = TRUE (default) mean return all brand regardless of availability
     *   isALL = FALSE mean retunr only list of brand that has at least one item available/online
     *   
     * add a new column ('brand_seo') for seo friendly url for brand
     */
    public function getBrandList($isAll = TRUE){
    	if ($isAll){
    		$sql = 'select distinct brand from product_raw order by brand';
    	}
    	else{
	    	$sql = 'select r.brand
	    			from product p inner join product_raw r on p.sku = r.sku
	    			where p.is_online = 1
	    			group by r.brand having count(*) > 0';
    	}
    	
    	$query = $this->db->query($sql);
    	$data = $query->result_array();
    	$query->free_result();
    	
    	for ($i = 0; $i <= count($data) - 1; $i++){
    		$data[$i]['brand_seo'] = url_title($data[$i]['brand']);
    	}
    	
    	
    	return $data;
    }
    
    /*
     * return list of brand that need to be rename when push from remote before store in mysql
     *   format of array is "change from" => "change to"
     *   use in remotemodel=>doFinaliseUpdate to rename brand in mysql
     */
    public function getRenameBrandList(){
    	$brands = array(
    			'1&20; Blackbirds' 		=> '1&20 Blackbirds',
    			'80 ' 					=> '80%20',
    			'House Of Harlow 1960' 	=> 'House Of Harlow',
    			'Atmos&Here;' 			=> 'Atmos&Here',
    			'Keepsake'				=> 'Keepsake the Label',
    			''						=> 'Beginning Boutique'
    	);
    	
    	return $brands;
    }
    
    /*
     * return list of brand name that have problem with seo friendly url
     *   some of brand name has problem so need to check and convert to new name before search in mysql
     *   format of array is "seo friendly url" => "actualy brand in mysql"
     */
    public function getExceptionBrandList(){
    	$brands = array(
    					'120-Blackbirds' 		=> '1&20 Blackbirds',
    					'8020' 			 		=> '80%20',
    					'AtmosHere' 	 		=> 'Atmos&Here',
    					'Akin-by-Ginger-Smart' 	=> 'Akin by Ginger & Smart',
    					'Camilla-Marc'			=> 'Camilla & Marc'
    				 );
   
    	return $brands;
    }
    
    /*
     * this is part of finalise step for data feed pushing
     * it does
     *  1. delete old data from brand_update table
     *  2. get date_last_push from global value
     *  3. find brand and number of new item those have been inserted into product_raw table by looking at date_created
     *     we are compare with date-only of date_last_push (no time)
     */
    public function updateNewBrandItem(){
    	//delete all old table from brand_update table
    	$sql = 'delete from brand_update';
    	$this->db->query($sql);
    	
    	//get last_date_push data
    	$date_last_update = $this->GlobalvalueModel->getGlobalValue('date_last_push');
    	$date_last_update = substr($date_last_update->value, 0, 10).' 00:00:00';
    	
    	//add new one
    	$sql = "insert into brand_update(brand, num_item)
    			select brand, count(*) from product_raw where date_created > '".$date_last_update."'
    			group by brand order by brand";
    	$this->db->query($sql);
    }
    
    /*
     * return list of data in table brand_update
     */
    public function getNewBrandList(){
    	$sql = 'select brand, num_item, date_created from brand_update order by brand';

    	$query = $this->db->query($sql);
    	$data = $query->result_array();
    	$query->free_result();

    	return $data;
    }
    
    /*
     * 
     */
    public function getNumItemLastUpdate(){
    	$result = 0;
    	$sql = 'select sum(num_item) as num_item from brand_update';
    	$query = $this->db->query($sql);
    	if ($query->num_rows() > 0){
    		$row = $query->row();
    		$result = $row->num_item;
    	}
    	
    	$query->free_result();

    	return $result;
    }
}