<?php
class Upload extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('ProductModel');   
        $this->load->helper('string');
    }	
    
    /*
     * show upload form, need sku as input
     */
    public function sku($sku){
    	$product = $this->ProductModel->getProduct($sku);    	
    	
    	$data = array();    	
    	$data['product']    = $product;
    	$data['is_error']   = FALSE;
    	$data['is_success'] = FALSE;
    	$data['file_name']  = '';
     	$data['error']	    = '';
    	$this->load->view('admin/upload', $data);
    }
    
    /*
     * function do actual upload and save file into selected location
     *  - is_error mean indicate of any error happen
     *  - is_success mean indicate of successful upload
     */
    public function doUpload(){
    	$error = '';    	
    	$sku = $this->input->get('sku');
    	$file_name = $sku.'-'.random_string('numeric', 5);; //file name pattern is sku-[5 random numerical number] (e.g. 99-1001-94857)
    	
    	$config = array();
    	$config['upload_path'] 		= './images/my/';			//file stored at http://www.afrofunk.com.au/store/images/my/    	
    	$config['allowed_types'] 	= 'gif|jpg|jpeg|png';		//allow only gif, jpg, jpeg, png
    	$config['max_size']			= '200';
    	$config['max_width']  		= '800';
    	$config['max_height']  		= '800';
    	$config['file_name']		= $file_name;
    	
    	$this->load->library('upload', $config);
    	
    	$data = array();
    	
    	if ( ! $this->upload->do_upload()){
    		//ERROR !!! upload failed
    		$error = $this->upload->display_errors().'click <a href="javascript:history.back()">here</a> to try again';
    		
    		$data['is_error']   = TRUE;
    		$data['is_success'] = FALSE;
    	}
    	else{
    		$file = $this->upload->data();
    		$file_name = $file['orig_name'];
    		
    		$data['is_error']   = FALSE;
    		$data['is_success'] = TRUE;    		
    	} 	    	    
    	
    	$data['file_name']	= $file_name;
    	$data['product'] 	= $this->ProductModel->getProduct($sku);  	
    	$data['error']	 	= $error;
    	
    	$this->load->view('admin/upload', $data);
    }
    
}