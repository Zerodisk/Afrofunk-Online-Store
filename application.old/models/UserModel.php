<?php
class UserModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function doAuthentication($username){
    	$result = NULL;
    	$query = $this->db->get_where('user', array('username' => $username));
    	if ($query->num_rows() > 0){
           $row = $query->row(); 
           $result = $row;
        }
        
        $query->free_result(); 
        return $result;
    }
}