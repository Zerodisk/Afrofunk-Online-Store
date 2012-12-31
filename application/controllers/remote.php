<?php 

class Remote extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('RemoteModel');
        $this->load->model('BrandModel');
    }	
    
    /*
     * this is remote pushing for new/modify product
     *	- push by using http post
     */
    public function productUpdate(){
    	$inputValue = $this->input->post();
    	
    	//validate secretCode
    	$secretCode = $inputValue['secret_code'];
    	if ($secretCode == $this->config->item('encryption_key')){

    		if ($this->RemoteModel->doProductUpdate($inputValue)){
    			echo('OK');	
    		}
    		
    	}
    	else{
    		echo('the encryption value not matched, sc = '.$secretCode);
    	}
    }
    
    /*
     *	this is for local app to download all the active SKU list 
     *   - SKU of active product
     *   - SKU list separate by comma 
     */
    public function getOnlineProductList($separation = ','){
    	$separation = urldecode($separation);
    	$result = '';
    	$list = $this->RemoteModel->getOnlineProductList();
 
    	foreach($list as $item){
    		$result = $result.$item['sku'].$separation;
    	}
    	
    	$result = substr($result, 0, strlen($result) - strlen($separation));
    	echo($result);
    }
    
    /*
     * return list of all brand
     */
    public function getBrandList($separation = ','){
    	$separation = urldecode($separation);
    	$result = '';
    	$list = $this->BrandModel->getBrandList();
    	
    	foreach($list as $item){
    		$result = $result.$item['brand'].$separation;
    	}
    	 
    	$result = substr($result, 0, strlen($result) - strlen($separation));
    	echo($result);
    	//var_dump($list);
    }
    
    /*
     *  this is function for retrieved the routing table value
     */
    public function getRoutingTable(){
    
    }
    
    
}