<?php
class PhotoModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * return list of all photo for a given sku (return in array)
     */
    public function getPhotoList($sku, $is_active = 1){
    	$param = array();
    	$param['sku'] = $sku;
    	if ($is_active >= 0){
    		$param['is_active'] = $is_active;
    	}
    	$query = $this->db->get_where('photo', $param);
    	$data = $query->result_array();
    	$query->free_result();
    	return $data;
    }
    
    /*
     * return a product for a given sku (return in object)
     */
    public function getPhoto($id){
    	$result = NULL;
    	
    	$query = $this->db->get_where('photo', array('id' => $id));
    	if ($query->num_rows() > 0){
    		$row = $query->row();
    		$result = $row;
    	}
    	
    	$query->free_result();
    	return $result;
    }
    
    /*
     * add new photo (default, set to active photo immidiate when add)
     */
    public function addPhoto($sku, $url, $is_active = 1){
    	$param = array();
    	$param['sku'] = $sku;
    	$param['url'] = $url;
    	$param['is_active'] = $is_active;
    	$this->db->insert('photo', $param);
    	
    	return $this->db->insert_id();
    }
    
    /*
     * update photo by a given id
     */
    public function updatePhoto($id, $param){
    	$this->db->where('id', $id);
    	$this->db->update('photo', $param);
    }
    
    /*
     * delete photo by a given id
     */
    public function deletePhoto($id){
    	$this->db->where('id', $id);
    	$this->db->delete('photo', $param);
    }
    
}