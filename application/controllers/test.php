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
    	$param['mid'] = '99';
    	$param['product_name'] = 'micky mouse';
    	$param['price'] = 23.99;
    	$param['brand'] = 'afrofunk';
    	
    	$sku = $this->ProductModel->addProductMy($param);
    	var_dump($sku);
    	*/
    }
}