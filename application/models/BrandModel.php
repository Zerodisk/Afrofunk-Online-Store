<?php
class BrandModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
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
     * return list of brand that need to be rename when push from remote
     *   format of array is "change from" => "change to"
     */
    public function getRenameBrandList(){
    	$brands = array(
    			'1&20; Blackbirds' 		=> '1&20 Blackbirds',
    			'80 ' 					=> '80%20',
    			'House Of Harlow 1960' 	=> 'House Of Harlow',
    			'Atmos&Here;' 			=> 'Atmos&Here'
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
    					'120-Blackbirds' => '1&20 Blackbirds',
    					'8020' 			 => '80%20',
    					'AtmosHere' 	 => 'Atmos&Here'
    				 );
   
    	return $brands;
    }
    
}