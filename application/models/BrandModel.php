<?php
class BrandModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function getBrandList(){
    	$sql = 'select distinct brand from product_raw order by brand';
    	
    	$query = $this->db->query($sql);
    	$data = $query->result_array();
    	$query->free_result();
    	
    	for ($i = 0; $i <= count($data) - 1; $i++){
    		$data[$i]['brand_url'] = url_title($data[$i]['brand']);
    	}
    	
    	
    	return $data;
    }
    
}