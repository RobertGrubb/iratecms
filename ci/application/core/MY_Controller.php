<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_Loader Class
 * 
 * Custom Loader class that extends the base CI_Loader to override the location
 * of the views directory.
 */
class MY_Controller extends CI_Controller {


    function MY_Controller()
    {
    	parent::__construct();
    	
    	$theme_name = settings("theme");
		$this->load->set_theme($theme_name);
    }

    
}

class Admin_Controller extends CI_Controller {
	function Admin_Controller()
    {
    	parent::__construct();
		$this->load->set_theme("administration");
    }
}