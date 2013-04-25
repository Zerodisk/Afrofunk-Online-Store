<?php
class GlobalvalueModel extends CI_Model{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    /*
     * update data value in global_value table
     *   $key is = global_value.key field
     *   $value is = globel_value.value field
     */
    public function updateGlobalValue($key, $value = NULL){
    	$sql = '';
    	
    	switch($key){
    		case 'date_last_push':
    			$sql = "UPDATE global_value SET `value` = CURRENT_TIMESTAMP() WHERE `key` = 'date_last_push';";
    			break;
    		default:
    			$sql = '';
    	}
    	
    	if ($sql != '')
    		$this::updateGlobalValueRaw($sql);
    }
    
    /*
     * functin to return all row in global_value table that match the given $key input
     */
    public function getGlobalValue($key){
    	$result = NULL;
    	
    	$query = $this->db->get_where('global_value', array('key' => $key));
    	if ($query->num_rows() > 0){
    		$row = $query->row();
    		$result = $row;
    	}
    	
    	$query->free_result();
    	return $result;
    }
    
    
    
    
    
    
    private function updateGlobalValueRaw($sql){
    	$this->db->query($sql);
    }
    
}