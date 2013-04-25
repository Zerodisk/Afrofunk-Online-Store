<?php
class Home extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('GlobalvalueModel');
        $this->load->model('BrandModel');
        $this->load->model('ProductModel');
    }	
    
    public function index(){
		$data['head']   = $this->load->view('admin/head',   '', TRUE);
    	$data['header'] = $this->load->view('admin/header', '', TRUE);
    	$data['footer'] = $this->load->view('admin/footer', '', TRUE);
    	
    	//value of global_value.key = 'date_last_push'
    	$data['date_last_push'] 	= $this->GlobalvalueModel->getGlobalValue('date_last_push')->value;
    	
    	//list of brand those got new item - table brand_update
    	$data['brand_update_list']  = $this->BrandModel->getNewBrandList();
    	
    	//get number of online items and brands
    	$num_items    				= $this->ProductModel->getNumberOfItem();
    	$num_items_online    		= $this->ProductModel->getNumberOfOnlineItem();
    	$num_items_offline    		= $num_items - $num_items_online;
    	$data['num_items'] 			= $num_items;
    	$data['num_items_online'] 	= $num_items_online;
    	$data['num_items_offline'] 	= $num_items_offline;
    	
    	$num_item_last_update		= $this->BrandModel->getNumItemLastUpdate();
    	$num_brand				    = count($this->BrandModel->getBrandList(TRUE));
    	$num_brand_online			= count($this->BrandModel->getBrandList(FALSE));
    	$num_brand_offline			= $num_brand - $num_brand_online;
    	
    	$data['num_brand'] 			= $num_brand;
    	$data['num_brand_online'] 	= $num_brand_online;
    	$data['num_brand_offline'] 	= $num_brand_offline;
    	$data['num_item_last_update'] = $num_item_last_update;
    	    	 
    	$this->load->view('admin/dashboard', $data);
    	
    }


}