<?php 

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('CategoryModel');
	}
	
	public function aboutus(){
		$data = array();
		$data['head']   = $this->load->view('head',   '', TRUE);
		
		$header = array();
		$header['cat_clothing']    = $this->CategoryModel->getCategoryList(1);
		$header['cat_accessories'] = $this->CategoryModel->getCategoryList(2);
		$data['header'] = $this->load->view('header', $header, TRUE);
		
		$data['footer'] = $this->load->view('footer', '', TRUE);
		
		$this->load->view('aboutus', $data);
	}
	
}