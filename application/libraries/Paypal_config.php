<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Paypal config library
 * 
 * the config class contain test and live paypal configuration
 *    
 */
// ------------------------------------------------------------------------

class Paypal_config {

	var $config_live;				//live config array
	var $config_test;				//test config array
	var $mode = '';					//config mode, can be TEST or LIVE
	
	/*
	 * constructure
	 *  mode can be
	 *   - LIVE
	 *   - TEST (used as default, if not specified)
	 */
	public function __construct($param){
		$this->mode = $param['mode'];
		
		$this::set_configTest();
		$this::set_configLive();
	}

	// dynamic property
	public function __get($name){
		if ($this->mode == 'TEST'){
			return $this->config_test[$name];
		}
	
		if ($this->mode == 'LIVE'){
			return $this->config_live[$name];
		}
	
		return NULL;
	}
	
	private function set_configTest(){		
		$this->config_test = array(
				'paypal_url_nvp' 		=> 'https://api-3t.sandbox.paypal.com/nvp',
				'paypal_url_redirect' 	=> 'https://www.sandbox.paypal.com/cgi-bin/webscr',
				'paypal_username'		=> 'apichart.tang-facilitator_api1.gmail.com',
				'paypal_password'		=> '1386115952',
				'paypal_signature'		=> 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-A77S5jwNmhl4EZGW6MelTscV6vmw',
				'paypal_version' 		=> '78',
				'my_url_success' 		=> 'http://localhost:88/store/paypal/success',
				'my_url_cancel' 		=> 'http://localhost:88/store/paypal/cancel',
				'my_currency' 			=> 'AUD',
		);
	}
	
	private function set_configLive(){
		$this->config_live = array(
				'paypal_url_nvp' 		=> 'https://api-3t.paypal.com/nvp',
				'paypal_url_redirect' 	=> 'https://www.paypal.com/cgi-bin/webscr',
				'paypal_username'		=> 'live-username',
				'paypal_password'		=> 'live-password',
				'paypal_signature'		=> 'live-signature',
				'paypal_version' 		=> '78',
				'my_url_success' 		=> 'http://www.afrofunk.com.au/store/paypal/success',
				'my_url_cancel' 		=> 'http://www.afrofunk.com.au/store/paypal/cancel',
				'my_currency' 			=> 'AUD',
		);		
	}
	
}