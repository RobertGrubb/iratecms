<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Errors extends MY_Controller
{
    /**
     * Show Banned Error Method.
     **/
    public function banned()
    {
        //Load the template
        $this->load->view('errors/banned.php');
    }

    /**
     * Show Suspended Error Method.
     **/
    public function suspended()
    {
        //Load the template
        $this->load->view('errors/suspended.php');
    }
}
