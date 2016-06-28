<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_Loader Class
 * 
 * Custom Loader class that extends the base CI_Loader to override the location
 * of the views directory.
 */
class MY_Loader extends CI_Loader {

	public $theme = 'default';

	function __construct() {

        parent::__construct();
        // Set the loader to use the default theme path.
        $this->set_theme($this->theme);
    }


    public function set_theme($theme_name)
    {
    	$this->theme = $theme_name;

        $this->_ci_view_paths = array(FCPATH . 'templates/' . $this->theme . '/views/' => TRUE);
    }
}