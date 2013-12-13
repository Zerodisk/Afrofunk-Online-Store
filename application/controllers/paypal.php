<?php 

class Paypal extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
		$this->load->library('paypal_connect');
		$this->load->library('paypal_log');
    }	
    
    /*
     * redirec to paypal website to make payment
     */
    public function redirect($sku){
    	$product = $this->ProductModel->getProduct($sku);
    	$param = array(
    			    'product_name' => $product->product_name,
    			    'price'        => $product->price_now,
    			 );
    	
    	//send paypal SetExpressCheckout
    	$paypal = $this->paypal_connect->send_SetExpressCheckout($param);
    	
    	//record in db
    	$this->paypal_log->log_orderNew($paypal['TOKEN'], $sku);
    	
    	//get url to paypal then redirect
    	$url = $this->paypal_connect->get_paypalRedirectUrl($paypal['TOKEN']);
    	redirect($url);
    }
    
    /*
     * return url from paypal when payment is success
     */
    public function success(){
    	$token    = $this->input->get('token');
    	$payer_id = $this->input->get('PayerID');
    	
    	//log paypal
    	$this->paypal_log->log(array(
    			'token' 		=> $token,
    			'message' 		=> current_url(),
    			'request_type' => 'ReturnFromPaypal',
    	));
    	
    	//record in db
    	$this->paypal_log->log_orderUpdate($token, array('payer_id' => $payer_id));
    	
    	//do validation
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	
    	//send paypal GetExpressCheckoutDetails
    	$paypal = $this->paypal_connect->send_GetExpressCheckoutDetails($token);
    	
    	//record in db
    	$this->paypal_log->log_orderUpdate($token, array(
    			                                    'email' 			=> $this->remEmpty($paypal, 'EMAIL'),
    												'first_name'		=> $this->remEmpty($paypal, 'FIRSTNAME'),
    											    'last_name' 		=> $this->remEmpty($paypal, 'LASTNAME'),
    												'ship_name' 		=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTONAME'),    			
    												'ship_street' 		=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTOSTREET'),
									    			'ship_city' 		=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTOCITY'),
									    			'ship_state' 		=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTOSTATE'),
									    			'ship_zip' 			=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTOZIP'),
									    			'ship_country_code' => $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE'),
									    			'ship_country_name' => $this->remEmpty($paypal, 'PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME'),
									    			'amt' 				=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_AMT'),
									    			'currency_code' 	=> $this->remEmpty($paypal, 'PAYMENTREQUEST_0_CURRENCYCODE'),
									    			'date_successed' 	=> date('Y-m-d H:i:s'),
    			                                   ));
    	
    	//display page
    	$data = array();
		$data['head']     = $this->load->view('head', '', TRUE);
		$header 		  = $this::getFrontendHeader(1, 2, TRUE);
		$data['header']   = $this->load->view('header', $header, TRUE);
		$data['footer']   = $this->load->view('footer', '', TRUE);
		$data['token']    = $token;
		$data['payer_id'] = $payer_id;
		
		$this->load->view('paypal_success', $data);
    }
    
    /*
     * paypal confirm payment
     */
    public function confirm(){
    	$token    = $this->input->post('token');
    	$payer_id = $this->input->post('payer_id');
    	if (($token == '') || ($payer_id == '')){
    		redirect(base_url());
    	}
    	    	
    	//get order log transaction details
    	$log = $this->paypal_log->get_LogOrder($token);
    	if ($payer_id != $log->payer_id){
    		redirect(base_url());
    	}
    	    	
    	//paypal do confirm transaction
    	$paypal = $this->paypal_connect->send_DoExpressCheckoutPayment($token, array(
		    																     'price'    => $log->price,
		    																     'payer_id' => $log->payer_id,
		    			                                                       ));
		    	
    	//record in db
    	$this->paypal_log->log_orderUpdate($token, array(
    												'transaction_id' 	   => $this->remEmpty($paypal, 'PAYMENTINFO_0_TRANSACTIONID'),
    											    'return_amt' 		   => $this->remEmpty($paypal, 'PAYMENTINFO_0_AMT'),
    												'return_currency_code' => $this->remEmpty($paypal, 'PAYMENTINFO_0_CURRENCYCODE'),
    											   ));
    	
    	//validation
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	//
    	//	
    	//
    	
    	
    	//display page
    	$data = array();
    	$data['head']   = $this->load->view('head', '', TRUE);
    	$header 		= $this::getFrontendHeader(1, 2, TRUE);
    	$data['header'] = $this->load->view('header', $header, TRUE);
    	$data['footer'] = $this->load->view('footer', '', TRUE);
    	
    	$this->load->view('paypal_confirm', $data);
    }
    
    /*
     * return url from paypal when payment is failed or user cancel
     */
    public function cancel(){
    	$token = $this->input->get('token');
    	
    	//log paypal
    	$this->paypal_log->log(array(
    			'token' 		=> $token,
    			'message' 		=> current_url().'?'.http_build_query($this->input->get()),
    			'request_type' => 'ReturnFromPaypal',
    	));
    	
    	//record in db
    	$this->paypal_log->log_orderUpdate($token, array('date_cancelled' 	=> date('Y-m-d H:i:s'),));
    	
    	//get product sku for redirection
    	$paypal = $this->paypal_log->get_LogOrder($token);
    	
    	//redirecting to product page
    	if ($paypal == NULL){
    		// token is not found, redirec to home page
    		redirect(base_url());
    	}
    	else{
    		// found token, redirect to selected product page
    		redirect(base_url().'product/view/'.$paypal->sku);
    	}    	
    }
    
    
    
    
    /*
     * check if array(name) is existed, 
     *   if existed, return actual value
     *   if not, return empty string
     */
    private function remEmpty($array, $name){
    	if (isset($array[$name])){
    		return $array[$name];
    	}
    	else{
    		return '';
    	}
    }
    
}