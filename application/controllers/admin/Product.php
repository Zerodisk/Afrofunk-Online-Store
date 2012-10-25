<?php
class Product extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('ProductModel');
        $this->load->model('BrandModel');
    }	
    
    //main product browsing controller
    public function index(){

    	$data = array();
    	
    	//brand
    	$data['brands'] 			= $this->BrandModel->getBrandList();
    	$data['brands_selected']	= ($this->input->get('brand')==FALSE)?array():$this->input->get('brand');    		    	  
    	$data['brands_selectbox']   = $this::generateBrandSelection($data['brands'], $data['brands_selected']);
    	
    	//status
    	$data['status_selected']	= ($this->input->get('status')==FALSE)?'all':$this->input->get('status');
    	$data['status_selectbox']   = $this::generateStatusSelection($data['status_selected']);
   	
    	//page, sort, sort_dir
    	$data['page']				= ($this->input->get('page')==FALSE)?'0':$this->input->get('page');
    	$data['sort']				= ($this->input->get('sort')==FALSE)?'date_modified':$this->input->get('sort');
    	$data['sort_dir']			= ($this->input->get('sort_dir')==FALSE)?'desc':$this->input->get('sort_dir');
    	
    	//load product data
    	$filter = array();
    	$filter['brands'] 			= $data['brands_selected'];
    	$filter['is_online'] 		= $this::manipulateStatus($data['status_selected']);
    	$filter['sort'] 			= $data['sort'];
    	$filter['sort_dir'] 		= $data['sort_dir'];   
    	$filter['page_index']		= $data['page']; 	
    	$data['products']			= $this->ProductModel->getProductList($filter);
//var_dump($data['products']);	
    	$this::loadViewProductBrowsing($data);
    }
    
    //view product controller
    public function view($sku){
    	
    }
    
    
    
    
    
    
    
    
    
    
    
    /*
     * $data can have 
     *   - brands 		    = list of brand
     *   - brands_selected  = the list of selected brand
     *   - brands_selectbox = the final html checkbox brand list
     *   
     *   - status_selected	= list of selected status
     *   - status_selectbox	= the final html for checkbox status list
     *   
     *   - page			= page_index, start from 0
     *   - sort   		= sort by
     *   - sort_dir 	= sort direction (asc or desc)
     *   - products		= list of product 
     */
    private function loadViewProductBrowsing($data){
    	$data['head']   = $this->load->view('admin/head',   '', TRUE);
    	$data['header'] = $this->load->view('admin/header', '', TRUE);
    	$data['footer'] = $this->load->view('admin/footer', '', TRUE);
    	    	 
    	$this->load->view('admin/product_browsing', $data);
    }
    
    /*
     *  generate html for brand checkbox (take cared of selected brand)
     *  - $brands = list of brand (array of array of brand)
     *  - $brands_selected = array list of selected brand
     */
    private function generateBrandSelection($brands, $brands_selected){
    	$result = "\n";
    	if (!is_array($brands_selected)){$brands_selected = array();}
    	foreach($brands as $brand){
    		$result = $result.'<input type="checkbox" name="brand[]" value="'.$brand['brand'].'"'.((in_array($brand['brand'], $brands_selected))?(' checked="true"'):('')).'> '.$brand['brand'].'<br>'."\n";
    	}
    	return $result;
    }
    
    /*
     * generate the html for status radio box (online, offline, all)
     *    $status_selected, 1 = online, 0 = offline, -1 = all status
     *    default $status_selected if not given is "all status"
     */
    private function generateStatusSelection($status_selected){
    	if ($status_selected == ''){$status_selected = '-1';}
    	$result = '<input type="radio" name="status"  value="on"'.('on'  ==$status_selected ? ' checked="checked"' : '').'> online<br>
    			   <input type="radio" name="status" value="off"'.('off' ==$status_selected ? ' checked="checked"' : '').'> offline<br>
    			   <input type="radio" name="status" value="all"'.('all' ==$status_selected ? ' checked="checked"' : '').'> all<br>';
    	
    	return $result;
    }
    
    /*
     * convert status
     *   from on  to 1
     *   from off to 0
     *   from all to -1
     */
    private function manipulateStatus($status){
    	switch($status){
    		case "on":
    			return 1;
    			break;
    		case "off":
    			return 0;
    			break;
    		case "all":
    			return -1;
    			break;
    	}
    }
   


}