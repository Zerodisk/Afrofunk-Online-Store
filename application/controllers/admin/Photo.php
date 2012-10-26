<?php
class Photo extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
    }	
    
    //main product browsing controller
    public function index(){
    	
    }
    
    public function ajaxSetPhotoStatus(){
    	$id   = $this->input->get('id');
    	$is_active = $this->input->get('is_active'); 
    	
    	$param = array();
    	$param['is_active'] = $is_active;
    	
    	$this->PhotoModel->updatePhoto($id, $param);    	
    	echo('OK');
    }
    
    
 }