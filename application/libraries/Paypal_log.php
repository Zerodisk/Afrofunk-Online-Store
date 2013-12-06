<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Paypal log library
 * 
 *   log what return from paypal to log for future investigation
 *    
 */
// ------------------------------------------------------------------------

class Paypal_log {
	
	var $ci;	//codeigniter reference object
	
	/*
	 * constructure
	 */
	public function __construct(){
		$this->ci =& get_instance();
	}
	
	public function log($param){
		$param['date_created']  = date('Y-m-d H:i:s');
		
		$this->ci->db->insert('paypal_log', $param);
		 
		return $this->ci->db->insert_id();
	}
	
	public function get_LogOrder($token){
		$result = NULL;
		
		$query = $this->ci->db->get_where('paypal_order', array('token' => $token));
		if ($query->num_rows() > 0){
			$row = $query->row();
			$result = $row;
		}
		
		$query->free_result();
		return $result;
	}
	
	/*
	 * create new paypal order
	 *  require value
	 *  - token
	 *  - sku
	 */
	public function log_orderNew($token, $sku){
		$this->ci->load->model('ProductModel');
		$product = $this->ci->ProductModel->getProduct($sku);
		
		$param = array(
				    'token' 	   => $token,
				    'sku'   	   => $sku,
				    'product_name' => $product->product_name,
				    'price'		   => $product->price_now,
				    'date_created' => date('Y-m-d H:i:s'),	 
				 );
		
		$this->ci->db->insert('paypal_order', $param);
	}
	
	/*
	 * update existing paypal order
	 */
	public function log_orderUpdate($token, $param){
		$this->ci->db->where('token', $token);
		$this->ci->db->update('paypal_order', $param);
	}
	
}