<?php
class Sessions extends CI_Controller{
    
	public function __construct(){
        parent::__construct();
        
        $this->load->library('session');
        $this->load->model('UserModel');
	}

	public function index(){
		redirect(base_url().'admin/login');
	}

    public function authenticate(){
    	//1. read user_name and password from $post form
    	$username = $this->input->post('username');
    	$password = $this->input->post('password');
    	
    	//2. anthenticate via database
    	$auth = $this->UserModel->doAuthentication($username);
    	if ($auth == NULL){
    		$this::loginError('user is not found or incorrect password given');
    	}
    	
    	if (($auth->password != $password) || ($auth->is_active != 1)){
    		$this::loginError('wrong user name or password given or user is set to disabled');
    	}
    	
    	//3. success: redirect to lanucher admin page
    	$this->session->set_userdata('isAdminLogined', TRUE);
    	redirect(base_url().'admin/');
    }
    
    public function login(){
    	//load form helper
    	$this->load->helper('form');
    	
    	//load message display
    	$message = $this->input->get('error');
    	$data['message']  = $message;
    	
    	//load login view
    	$this->load->view('admin/login', $data);
    }
    
    public function logout(){
    	$this->session->unset_userdata('isAdminLogined');
    	redirect(base_url().'admin/login');
    }
    
    
    
    //function redirect to login page with error message given
    private function loginError($message){
    	redirect(base_url().'admin/login/?error='.$message);
    }
}