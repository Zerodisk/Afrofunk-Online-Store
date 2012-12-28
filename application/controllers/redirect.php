<?php 

class Redirect extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
    }	
    
    public function index(){
    	echo('hitting the index function - think about redirecting somewhere else');
    }
    
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
    
}