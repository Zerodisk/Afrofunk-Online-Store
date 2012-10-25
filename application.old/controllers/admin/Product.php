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
    	$data['brands'] 			= $this->BrandModel->getBrandList();
    	$data['brands_selected']	= $this->input->get('brand', array());
    	$data['brands_selectbox']   = $this::generateBrandSelection($data['brands'], $data['brands_selected']);
    	
    	$data['status_selected']    = $this->input->get('status', '');
    	$data['status_selectbox']   = $this::generateStatusSelection($data['status_selected']);
 	
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
    	$result = '<input type="radio" name="status"  value="1"'.('1' ==$status_selected ? ' checked="checked"' : '').'> online<br>
    			   <input type="radio" name="status"  value="0"'.('0' ==$status_selected ? ' checked="checked"' : '').'> offline<br>
    			   <input type="radio" name="status" value="-1"'.('-1'==$status_selected ? ' checked="checked"' : '').'> all<br>';
    	
    	return $result;
    }
   


}