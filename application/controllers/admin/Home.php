<?php
class Home extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('GlobalvalueModel');
        $this->load->model('BrandModel');
    }	
    
    public function index(){
		$data['head']   = $this->load->view('admin/head',   '', TRUE);
    	$data['header'] = $this->load->view('admin/header', '', TRUE);
    	$data['footer'] = $this->load->view('admin/footer', '', TRUE);
    	
    	//value of global_value.key = 'date_last_push'
    	$data['date_last_push'] 	= $this->GlobalvalueModel->getGlobalValue('date_last_push')->value;
    	//list of brand those got new item - table brand_update
    	$data['brand_update_list']  = $this->BrandModel->getNewBrandList();
    	    	 
    	$this->load->view('admin/dashboard', $data);
    	
    }


}