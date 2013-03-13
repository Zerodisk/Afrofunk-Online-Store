<?php 

class Redirect extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
    }	
    
    public function index(){
    	redirect('/', 'location', 301);
    }
    
    /*
     * this is for redirecting to the merchant item page
     */
    public function view($sku){
    	$product = $this->ProductModel->getProduct($sku, 1);
    	
		$data = array();
		$data['head']   = $this->load->view('head',   '', TRUE);
		
		$header = $this::getFrontendHeader();
		$data['header'] = $this->load->view('header', $header, TRUE);
		
		$data['footer'] = $this->load->view('footer', '', TRUE);
		
		$data['product'] = $product;
		
		$this->load->view('redirect', $data);
    }
    
    /*
     * this is for redirecting to merchant page for a given $merchantCode
    */
    public function merchant($merchantCode){
    	$url = '';
    	switch($merchantCode){
    		case 'bb':
    			$url = 'https://track.commissionfactory.com.au/t/6718/7639/';
    			break;
    		case 'gosh':
    			$url = 'https://track.commissionfactory.com.au/t/6718/6997/';
    			break;
    		case 'theiconic':
    			$url = 'https://track.commissionfactory.com.au/t/6718/3097/';
    			break;
    		default:
    			$url = 'https://track.commissionfactory.com.au/t/6718/3097/';		//default is theiconic
    			break;
    	}
    	redirect($url, 'location', 301);
    }    
        
}