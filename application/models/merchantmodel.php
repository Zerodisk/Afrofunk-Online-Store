<?php
class MerchantModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function getMerchantList(){
    	$query = $this->db->get('merchant');
    	$data = $query->result_array();
    	$query->free_result();
    	return $data;
    }
}