<?php
class Category extends MY_Controller{

    public function __construct(){
        parent::__construct('admin');
        $this->load->model('CategoryModel');
    }	
    
    public function view_all(){
    	$categories = $this->CategoryModel->getCategoryListWithParent();
    	$data = array('categories' => $categories);
    	
    	$this::loadView($data);
    }
    
    public function update_description(){
    	$cat_id 	   = $this->input->post('cat_id');
    	$description   = $this->input->post('description');
    	
    	$param = array('description' => $description);
    	$this->CategoryModel->updateCategory($cat_id, $param);
    	
    	$categories = $this->CategoryModel->getCategoryListWithParent();
    	$data = array('categories' => $categories);
    	 
    	$this::loadView($data);
    }
    
    private function loadView($data){
    	$data['head']   = $this->load->view('admin/head',   '', TRUE);
    	$data['header'] = $this->load->view('admin/header', '', TRUE);
    	$data['footer'] = $this->load->view('admin/footer', '', TRUE);
    		
    	$this->load->view('admin/category', $data);
    }    
}