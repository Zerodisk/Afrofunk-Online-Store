<?php 

class Track extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('email');
    }	
    
    /*
     * this is for thrid party tracking on commission factory
     * 
     * <img src="http://www.afrofunk.com.au/store/track/?MerchantID=[MerchantID]&MerchantName=BB&OrderID=[OrderID]&SourceType=[SourceType]&SourceName=[SourceName]&Amount=[Amount]&Random=[Random]" />
     *
     */
    public function index(){
    	$merchantId    = $this->input->get('MerchantID');
    	$merchangeName = $this->input->get('MerchantName');
    	$orderId 	   = $this->input->get('OrderID');
    	$sourceType    = $this->input->get('SourceType');
    	$sourceName    = $this->input->get('SourceName');
    	$amount 	   = $this->input->get('Amount');
    	$random 	   = $this->input->get('Random');
    	
    	$config['mailtype'] = 'text';
    	$this->email->initialize($config);
    	
    	$this->email->from('info@afrofunk.com.au', 'afrofunk tracking');
    	$this->email->to('apichart.tang@gmail.com');
    	 
    	$this->email->subject('Afrofunk - new order');    	 
    	$body = 'Yo Yo !!
    			
    			Congraturation on the new order. Below are details
    			
    			Merchant ID:    '.$merchantId.'
    			Merchange Name: '.$merchangeName.'
    			Order ID:	    '.$orderId.'
    			Source Type:    '.$sourceType.'
    			Source Name:    '.$sourceName.'
    			Amount: 	    $'.$amount.'
    	
    			Have a nice day!
    			go
    			';
    	
    	$this->email->message($body);
    	$this->email->send();
    }
    
}