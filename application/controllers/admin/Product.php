<?php
class Product extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
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
    	$data['page_size']			= $this->ProductModel->getDefaultPageSize();
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

    	$this::loadViewProductBrowsing($data);
    }
    
    //view product controller
    public function view($sku){
    	$data = array();
    	
    	$product = $this->ProductModel->getProduct($sku);
    	$data['product'] = $product;
    	
    	$photos = $this->PhotoModel->getPhotoList($sku, -1);
    	$data['photos']  = $photos;
    	
    	//category
    	$data['cat_main'] 	  	 = $this->CategoryModel->getCategoryTopLevel();
    	$data['cat_clothing'] 	 = $this->CategoryModel->getClothingList();
    	$data['cat_accessories'] = $this->CategoryModel->getAccessoriesList();
    	
    	$this::loadViewProduct($data);
    }
    
    //for update product (name, description, price)
    public function update(){
    	$sku = $this->input->post('sku');
    	
    	//update db
    	$param = array();
    	$param['product_name'] = $this->input->post('product_name');
    	$param['description']  = $this->input->post('description');
    	$param['price_init']   = $this->input->post('price_init');
    	$param['image_url']    = $this->input->post('image_url');		//move image_url to product table, so need to be able to update in admin area 3-jan-2013
    	$param['cat_id']       = $this->input->post('cat_id');
    	$this->ProductModel->updateProduct($sku, $param);        
    	
    	//view page
    	$this::view($sku);
    }
    
    //for adding new photo
    public function addPhoto(){
    	$sku = $this->input->post('sku');
    	$url = $this->input->post('photoUrl');
    	$this->PhotoModel->addPhoto($sku, $url, 1);
    	
    	//view page
    	$this::view($sku);
    }
    
    /*
     * for ajax call to make a given sku online
     */
    public function ajaxMakeOnline(){
    	$sku = $this->input->get('sku');
    	if ($sku == false){echo('sku is missing');return;}
    	
    	$param = array();
    	$param['is_online'] = 1;
    	$product = $this->ProductModel->getProduct($sku);  	
    	if ($product->date_first_online == NULL){				//make first time online, stamp date :)
    		$param['date_first_online'] = date('Y-m-d H:i:s');
    	}
    	$this->ProductModel->updateProduct($sku, $param);
    	echo('OK');
    }
    
    /*
     * for ajax call to make a given sku offline
     */
    public function ajaxMakeOffline(){
    	$sku = $this->input->get('sku');
    	if ($sku == false){echo('sku is missing');return;}
    	
    	$this->ProductModel->updateProduct($sku, array('is_online' => 0));
    	echo('OK');
    }
    
    
    
    
    
    
    
    
    
    
    
    /*
     * this is for view product browsing in the admin page
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
     * this is for view/edit a given product sku
     * $data can have
     *  - product			= object of product
     *  - ??
     *  
     */
    private function loadViewProduct($data){
    	$data['head'] = $this->load->view('admin/head', '', TRUE);
    	$this->load->view('admin/product', $data);
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
    		$result = $result.'<input class="chkBrand" type="checkbox" name="brand[]" value="'.rawurlencode($brand['brand']).'"'.((in_array($brand['brand'], $brands_selected))?(' checked="true"'):('')).'> '.'<a href="/store/brands/'.url_title($brand['brand']).'" target="_blank" style="text-decoration: none; color:black;">'.$brand['brand'].'</a><br>'."\n";
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