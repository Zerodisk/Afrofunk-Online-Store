<?php 

class Test extends MY_Controller {

	public function __construct(){
        parent::__construct('admin');
        $this->load->model('ProductModel');
    }	
    
    public function view($templateFileName){
    	$this->load->view(str_replace('.php', '', $templateFileName));
    }
    
    public function phpinfo(){
    	echo phpinfo(); 
    }
    
    public function deleteProduct($num_product){
    	$this->ProductModel->deleteProducts($num_product);
    	echo($num_product.' products have been deleted');
    }
    
    public function mybrowser(){    	
    	$this->load->library('user_agent');
    	
    	echo('my browser is: '.$this->agent->browser().'<br>');
    	echo('version is: '.$this->agent->version().'<br>');
    	echo('mobile is: '.$this->agent->mobile().'<br>');
    	echo('platform is: '.$this->agent->platform().'<br>');
    	echo('agent_string is: '.$this->agent->agent_string().'<br>');
    	echo('referrer is: '.$this->agent->referrer().'<br>');
    }
    
    public function getProductDupList(){
    	$original_url = $this->input->get('original_url');
    	
    	$dupList = $this->ProductModel->getProductRawListByOriginalURL($original_url);
    	
    	var_dump($dupList);
    	
    	$sku = $dupList[0]['sku'];
    	
    	var_dump($sku);
    	
    	if (count($dupList) == 0)
    		echo('0');
    	else
    		echo('found and it is > 0');
    }
    
    public function myip(){
    	$this->load->library('session');
    	$session_data = $this->session->all_userdata();
    	
    	$myip = $session_data['ip_address'];
    	
    	echo('my ip address is: '.$myip.' and it convert to long = '.sprintf("%u", ip2long($myip)).'<br>');
    	
    	echo('convert ip adddress of 198.151.53.250 to long = '.sprintf("%u", ip2long('198.151.53.250')));    	    	   
    	
    }
    
    public function tantest(){
    	/*
    	$this->load->model('GlobalvalueModel');
    	
    	$param = array();
    	$param['product_name'] = 'micky mouse 2';
    	$param['price'] = 27.99;
    	
    	$sku = $this->ProductModel->addProductMy($param);
    	var_dump($sku);
    	*/
    }
    
    public function paypal(){
    	var_dump($this->input->get());
    	echo('<br><br><br>');
    	var_dump($this->input->post());
    }
    
    public function decode(){    	
    	$this->load->library('paypal_connect');

    	$str = 'TOKEN=EC%2d83D585825G6178748&CHECKOUTSTATUS=PaymentActionNotInitiated&TIMESTAMP=2013%2d12%2d04T05%3a42%3a50Z&CORRELATIONID=811faac9d8b51&ACK=Success&VERSION=78&BUILD=8620107&CURRENCYCODE=AUD&AMT=19%2e95&ITEMAMT=19%2e95&SHIPPINGAMT=0%2e00&HANDLINGAMT=0%2e00&TAXAMT=0%2e00&INSURANCEAMT=0%2e00&SHIPDISCAMT=0%2e00&L_NAME0=test%20product&L_QTY0=1&L_TAXAMT0=0%2e00&L_AMT0=19%2e95&L_ITEMWEIGHTVALUE0=%20%20%200%2e00000&L_ITEMLENGTHVALUE0=%20%20%200%2e00000&L_ITEMWIDTHVALUE0=%20%20%200%2e00000&L_ITEMHEIGHTVALUE0=%20%20%200%2e00000&PAYMENTREQUEST_0_CURRENCYCODE=AUD&PAYMENTREQUEST_0_AMT=19%2e95&PAYMENTREQUEST_0_ITEMAMT=19%2e95&PAYMENTREQUEST_0_SHIPPINGAMT=0%2e00&PAYMENTREQUEST_0_HANDLINGAMT=0%2e00&PAYMENTREQUEST_0_TAXAMT=0%2e00&PAYMENTREQUEST_0_INSURANCEAMT=0%2e00&PAYMENTREQUEST_0_SHIPDISCAMT=0%2e00&PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED=false&L_PAYMENTREQUEST_0_NAME0=test%20product&L_PAYMENTREQUEST_0_QTY0=1&L_PAYMENTREQUEST_0_TAXAMT0=0%2e00&L_PAYMENTREQUEST_0_AMT0=19%2e95&L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0=%20%20%200%2e00000&L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0=%20%20%200%2e00000&L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0=%20%20%200%2e00000&L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0=%20%20%200%2e00000&PAYMENTREQUESTINFO_0_ERRORCODE=0';
    	echo($str.'<br><br><br>'.urldecode($str).'<br><br><br>');
    	var_dump($this->paypal_connect->parse(urldecode($str)));

    }
    
    
    public function setExpress(){
    	$this->load->library('paypal_connect');
    	
    	$param = array();
    	$param['product_name']	= 'test product';
    	$param['price']			= '19.95';
    	$output = $this->paypal_connect->send_SetExpressCheckout($param);
    	var_dump($output);
    }
    
    public function getPayPalUrl($token){
    	$this->load->library('paypal_connect');
    	$url = $this->paypal_connect->get_paypalRedirectUrl($token);
    	echo($url);
    }
    
    
    
}


