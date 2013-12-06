<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Paypal library
 * 
 * base class to connect to Paypal using RESTfull query string
 *    function return array of data
 *    
 */
// ------------------------------------------------------------------------

class Paypal_connect {
	
	var $ci;					//codeigniter reference object
	var $param = array();		//all variable to submit to paypal
	var $paypal_config;			//config object for paypal
	var $paypal_log;			//log object for paypal
	var $mode = 'TEST';			//mode of config file (TEST or LIVE)
	

	public function __construct(){
		$this->ci =& get_instance();
		
		//initial test and live mode here
		$this->ci->load->library('paypal_config', array('mode' => $this->mode));
		$this->paypal_config = $this->ci->paypal_config;
		
		//initial paypal log object
		$this->ci->load->library('paypal_log');
		$this->paypal_log = $this->ci->paypal_log;
			
		$this->param['USER'] 		= $this->paypal_config->paypal_username;
		$this->param['PWD'] 		= $this->paypal_config->paypal_password;
		$this->param['SIGNATURE']   = $this->paypal_config->paypal_signature;
		$this->param['VERSION']		= $this->paypal_config->paypal_version;
	}
	
	/*
	 * this is to send SetExpressCheckout
	 *  $param value need are
	 *   - product_name is the name of product/item
	 *   - price        is the total price charged
	 */
	public function send_SetExpressCheckout($param = array()){
		$this->param['METHOD'] = 'SetExpressCheckout';
		
		$this->param['returnUrl'] = $this->paypal_config->my_url_success;
		$this->param['cancelUrl'] = $this->paypal_config->my_url_cancel;
		
		$this->param['PAYMENTREQUEST_0_PAYMENTACTION'] 	= 'SALE';
		$this->param['PAYMENTREQUEST_0_CURRENCYCODE'] 	= $this->paypal_config->my_currency;
		$this->param['PAYMENTREQUEST_0_AMT'] 			= $param['price'];		
		$this->param['L_PAYMENTREQUEST_0_NAME0'] 		= $param['product_name'];
		$this->param['L_PAYMENTREQUEST_0_AMT0'] 		= $param['price'];
				
		$message_response = $this->send_paypal($this->param);	
		$result 	      = $this->parse($message_response);	
		
		//log paypal
		$this->paypal_log->log(array(
								 'token' 		=> $result['TOKEN'],
				                 'message' 		=> $message_response,
				                 'request_type' => 'SetExpressCheckout',
				               ));
		
		return $result;
	}
	
	/*
	 * return paypal URL for redirecting customer to make payment
	 *  the $param is not in used at the moment
	 */
	public function get_paypalRedirectUrl($token, $param = array()){
		$param 		    = array();
		$param['cmd']   = '_express-checkout';
		$param['token'] = $token;		
		
		//get full url
		$url = $this->paypal_config->paypal_url_redirect.'?'.http_build_query($param);
		
		//log paypal
		$this->paypal_log->log(array(
				'token' 	   => $token,
				'message' 	   => $url,
				'request_type' => 'RedirectToPayPal',
		));
		
		return $url;
	}
	
	/*
	 * this is to send GetExpressCheckoutDetails
	 *  the $param is not in used at the moment
	 */
	public function send_GetExpressCheckoutDetails($token, $param = array()){
		$this->param['METHOD'] = 'GetExpressCheckoutDetails';
		
		$this->param['TOKEN']  = $token;
		
		$message_response = $this->send_paypal($this->param);	
		$result 	      = $this->parse($message_response);	
		
		//log paypal
		$this->paypal_log->log(array(
								 'token' 		=> $result['TOKEN'],
				                 'message' 		=> $message_response,
				                 'request_type' => 'GetExpressCheckoutDetails',
				               ));
		
		return $result;
	}
	
	/*
	 * this is to send DoExpressCheckoutPayment
	 *  $param value need are
	 *   - payer_id is this is paypal payer ID
	 *   - price    is this is total price charged customer (AUD)
	 */
	public function send_DoExpressCheckoutPayment($token, $param = array()){
		$this->param['METHOD'] = 'DoExpressCheckoutPayment';
		
		$this->param['TOKEN'] 						  = $token;
		$this->param['PAYERID'] 					  = $param['payer_id'];
		$this->param['PAYMENTREQUEST_0_AMT'] 		  = $param['price'];
		$this->param['PAYMENTREQUEST_0_CURRENCYCODE'] = $this->paypal_config->my_currency;
		
		$message_response = $this->send_paypal($this->param);	
		$result 	      = $this->parse($message_response);	
		
		//log paypal
		$this->paypal_log->log(array(
								 'token' 		=> $result['TOKEN'],
				                 'message'		=> $message_response,
				                 'request_type' => 'DoExpressCheckoutPayment',
				               ));
		
		return $result;
	}
	
	
	
	
	/*
	 * do parsing from query string into array
	 *  $str = "first=value&last=baz";
	 *  parse_str($str, $output);
	 *	 echo $output['first'];  // value
	 *	 echo $output['last'];   // baz
     *
	 */
	public function parse($query_string){
		$output = array();
		parse_str($query_string, $output);
		return $output;
	}
	
	/*
	 * this is main class to do
		*  - add a given $param key-value from calling function to an class->param
	*  - get full REST url, generate from $this->param
	*  - send RESTfull and get string back
	*  - return with raw string
	*/
	private function send_paypal($param){
		//adding new param value into class internal param
		$this::add_value_toParam($param);
	
		//get full url
		$url = $this->paypal_config->paypal_url_nvp.'?'.http_build_query($this->param);
	
		//submit REST and get string return
		$result = $this::curl_get_contents($url);
	
		return urldecode($result);
	}	
	
	/*
	 * add all key-value from $new_param to the internal $param
	*    if name is exisint, it will be replaced
	*    no return value
	*/
	private function add_value_toParam($new_param){
		$this->param = array_merge($this->param, $new_param);
	}
	
	/*
	 * send http request and get result back
	*/
	private function curl_get_contents($url) {	
		// Initiate the curl session
		$ch = curl_init();
		// Set the URL
		curl_setopt($ch, CURLOPT_URL, $url);
		// Removes the headers from the output
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		//for site with SSL (otherwise response return as empty string)
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		
		// Return the output instead of displaying it directly
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// Execute the curl session
		$output = curl_exec($ch);
		// Close the curl session
		curl_close($ch);
	
		// Return the output as a variable
		return $output;
	}
	
}