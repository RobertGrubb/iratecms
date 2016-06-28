<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Videos extends MY_Controller
{
    //Setup a Template Directory:
    public $videos_template_dir = 'videos/';
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

    public function index()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(12);
        $videos = $this->db->get('videos');
        $videos = $videos->result_array();
        $data['videos'] = $videos;
        $this->load->view($this->videos_template_dir.'videos.php', $data);
    }

    /**
     * Method: view
     * Displays a specific
     * document to the user.
     **/
    public function view()
    {
        //Get the newsid:
        $videoid = $this->uri->segment(3);
        //Select the specified document from the database
        $this->db->where('id', $videoid);
        $videoid = $this->db->get('videos');
        //Check if it exists:
        if ($videoid->num_rows() >= 1) {
            //Set the user information to the data array
            $data['video'] = $videoid->result_array();
            //Load the view file
            $this->load->view($this->videos_template_dir.'view.php', $data);
        }
        //If the document does NOT exist:
        else {
            //Show a template that handles that specific error.
            show_404();
        }
    }
}
