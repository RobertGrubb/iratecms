<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * IrateCMS v3.0.X
 **/
class Homepage extends MY_Controller
{
    //Setup a Template Directory:
    public $home_template_dir = 'homepage/';

    /**
     * Class Constructor.
     **/
    public function __construct()
    {
        //Call the parent constructor
        parent::__construct();
        //Load the BBCode helper
        $this->load->helper('misc/bbcode');
    }

    /**
     * Default Page Method.
     **/
    public function index()
    {
        //Retrieve the slides from the database.
        $slides = $this->db->query('SELECT * FROM fp_slides ORDER BY orderid ASC');
        //Set the information to the data array
        $data['slides'] = $slides->result_array();
        //Get the FP settings from the database
        $sq = $this->db->query('SELECT * FROM fp_settings');
        //Set the result array to a variable
        $settings = $sq->result_array();
        //Set the information to the data array
        $data['settings'] = $settings[0];

        //Grab the last 2 news posts:
        //=========================================

        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $news = $this->db->get('news');
        $news = $news->result_array();

        $data['news'] = $news;

        //=========================================
        //Show a template that handles that specific error.
        $this->load->view($this->home_template_dir.'homepage.php', $data);
    }
}
