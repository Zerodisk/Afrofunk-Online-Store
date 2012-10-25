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
    	return $data;
    }
    
}