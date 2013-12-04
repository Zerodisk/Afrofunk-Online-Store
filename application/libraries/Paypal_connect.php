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
	
	var $ci;				//codeigniter reference object
	var $param   = array();	//all variable to submit to paypal

	// ******************** TEST TEST TEST **********************************************
	var $paypal_url_nvp      = 'https://api-3t.sandbox.paypal.com/nvp';
	var $paypal_url_redirect = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	var $paypal_username  	 = 'apichart.tang-facilitator_api1.gmail.com';
	var $paypal_password  	 = '1386115952';
	var $paypal_signature 	 = 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-A77S5jwNmhl4EZGW6MelTscV6vmw';				
	var $my_url_success   	 = 'http://localhost:88/store/paypal/success';
	var $my_url_cancel    	 = 'http://localhost:88/store/paypal/cancel';
	
	var $paypal_version   	 = '78';
	var $my_currency      	 = 'AUD';
	// ******************** TEST TEST TEST **********************************************
	
	

	public function __construct(){
		$this->ci =& get_instance();
			
		$this->param['USER'] 		= $this->paypal_username;
		$this->param['PWD'] 		= $this->paypal_password;
		$this->param['SIGNATURE']   = $this->paypal_signature;
		$this->param['VERSION']		= $this->paypal_version;
	}
	
	/*
	 * this is to send SetExpressCheckout
	 *  $param value need are
	 *   - product_name is the name of product/item
	 *   - price        is the total price charged
	 */
	public function send_SetExpressCheckout($param = array()){
		$this->param['METHOD'] = 'SetExpressCheckout';
		
		$this->param['returnUrl'] = $this->my_url_success;
		$this->param['cancelUrl'] = $this->my_url_cancel;
		
		$this->param['PAYMENTREQUEST_0_PAYMENTACTION'] 	= 'SALE';
		$this->param['PAYMENTREQUEST_0_CURRENCYCODE'] 	= $this->my_currency;
		$this->param['PAYMENTREQUEST_0_AMT'] 			= $param['price'];		
		$this->param['L_PAYMENTREQUEST_0_NAME0'] 		= $param['product_name'];
		$this->param['L_PAYMENTREQUEST_0_AMT0'] 		= $param['price'];
				
		$result = $this->send_paypal($this->param);		
		return $this->parse($result);
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
		$url = $this->paypal_url_redirect.'?'.http_build_query($param);
		
		return $url;
	}
	
	/*
	 * this is to send GetExpressCheckoutDetails
	 *  the $param is not in used at the moment
	 */
	public function send_GetExpressCheckoutDetails($token, $param = array()){
		$this->param['METHOD'] = 'GetExpressCheckoutDetails';
		
		$this->param['TOKEN']  = $token;
		
		$result = $this->send_paypal($this->param);		
		return $this->parse($result);
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
		$this->param['PAYMENTREQUEST_0_CURRENCYCODE'] = $this->my_currency;
		
		$result = $this->send_paypal($this->param);
		return $this->parse($result);
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
		$url = $this->paypal_url_nvp.'?'.http_build_query($this->param);
	
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