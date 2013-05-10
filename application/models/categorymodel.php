<?php
class CategoryModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    /*
     * return list of top level category
     */
    public function getCategoryTopLevel(){
    	return $this::getCategoryList();
    }
    
    /* 
     * function return list of all category for a given parent_id
     *   $parent_id = NULL mean return the top level category
     */
    public function getCategoryList($parent_id = NULL){
    	$sql = 'select * from category';
    	if ($parent_id == NULL){
    		$sql = $sql.' where parent_id is NULL';
    	}
    	else{
    		$sql = $sql.' where parent_id ='.$parent_id;
    	}
    	$sql = $sql.' order by cat_id';
    	
    	//execute query
    	$query = $this->db->query($sql);
    	$data = $query->result_array();
    	$query->free_result();
    	
    	for ($i = 0; $i <= count($data) - 1; $i++){
    		$data[$i]['category_name_seo'] = url_title($data[$i]['category_name']);
    	}
    	
    	return $data;
    } 
    
    public function getCategory($cat_id){
    	$result = NULL;
    	 
    	$query = $this->db->get_where('category', array('cat_id' => $cat_id));
    	if ($query->num_rows() > 0){
    		$row = $query->row();
    		$result = $row;
    	}
    	 
    	$query->free_result();
    	return $result;
    }
    
    /*
     *  return clothing category list
     */
    public function getClothingList(){
    	return $this::getCategoryList(1);
    }
    
    
    /*
     *  this function return list of cat_id
     *    for clothing (cat_id = 1)
     *    return as string with $separation separation
     *    ex: 23,25,29 
     */    		
    public function getClothingCatIdList($separation = ','){
    	$result = '';
    	
    	$cat_list = $this::getClothingList();
    	foreach($cat_list as $cat){
    		$result = $result.$cat['cat_id'].$separation;
    	}
    	$result = substr($result, 0, strlen($result) - strlen($separation));
    	
    	return $result;
    }
    
    /*
     *   retuen accessories list
     */
    public function getAccessoriesList(){
    	return $this::getCategoryList(2);
    }
    
    /*
     *  this function return list of cat_id
    *    for accessories (cat_id = 1)
    *    return as string with $separation separation
    *    ex: 41,43,44
    */
    public function getAccessoriesCatIdList($separation = ','){
    	$result = '';
    	 
    	$cat_list = $this::getAccessoriesList();
    	foreach($cat_list as $cat){
    		$result = $result.$cat['cat_id'].$separation;
    	}
    	$result = substr($result, 0, strlen($result) - strlen($separation));
    	 
    	return $result;
    }
    
    /*
     * return list of cateogry with parent (e.g. Clothing - Top, Clothing - Dress)
     */
    public function getCategoryListWithParent(){
    	$sql = 'select c.cat_id, p.cat_id as parent_id, p.category_name as parent_name, c.category_name, c.description
				from category p right join category c on c.parent_id = p.cat_id
				order by p.cat_id, c.cat_id';
    	
    	//execute query
    	$query = $this->db->query($sql);
    	$data = $query->result_array();
    	$query->free_result();
    	return $data;
    }
    
    
    /*
     * update category by a given cat_id
    */
    public function updateCategory($cat_id, $param){
    	$this->db->where('cat_id', $cat_id);
    	$this->db->update('category', $param);
    }

    

    
}