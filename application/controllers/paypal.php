<?php 

class Paypal extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
		$this->load->library('paypal_connect');
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
    	//
    	//
    	//
    	//
    	//
    	//
    	
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
    	
    	//record in db
    	//
    	//
    	//
    	//
    	//
    	//
    	
    	echo('success page');
    }
    
    /*
     * paypal confirm payment
     */
    public function confirm(){
    	
    }
    
    /*
     * return url from paypal when payment is failed or user cancel
     */
    public function cancel(){
    	$token = $this->input->get('token');
    	
    	//record in db
    	//
    	//
    	//
    	//
    	//
    	//
    	
    	echo('cancel page with token: '.$token);
    }
    
}