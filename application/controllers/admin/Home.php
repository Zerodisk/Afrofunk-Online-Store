<?php
class Home extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        
    }	
    
    public function index(){
		$data['head']   = $this->load->view('admin/head',   '', TRUE);
    	$data['header'] = $this->load->view('admin/header', '', TRUE);
    	$data['footer'] = $this->load->view('admin/footer', '', TRUE);
    	    	 
    	$this->load->view('admin/dashboard', $data);
    	
    }


}