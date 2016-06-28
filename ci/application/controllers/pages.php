<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Pages extends MY_Controller
{
    //Setup a Template Directory:
    public $page_template_dir = 'pages/';
    /**
     * Class Constructor.
     **/
    public function __construct()
    {
        //Call the parent constructor
        parent::__construct();
    }
    /**
     * Method: view
     * Displays a specific
     * document to the user.
     **/
    public function view()
    {
        //Get the Document call name:
        $page_call_name = $this->uri->segment(1);
        //Select the specified document from the database
        $this->db->where('callname', $page_call_name);
        $pageq = $this->db->get('pages');
        //Check if it exists:
        if ($pageq->num_rows() >= 1) {
            //If it does exist, set the information
            //from the database to a variable:
            $pagef = $pageq->result_array();
            //Set the title
            $data['title'] = $pagef[0]['title'];

            $data['callname'] = $pagef[0]['callname'];
            //Set the contnet
            $data['content'] = $pagef[0]['content'];

            $data['template'] = $pagef[0]['template'];

            $data['comments'] = $pagef[0]['comments'];
            //Load the template
            $this->load->view($this->page_template_dir.'page.php', $data);
        }
        //If the document does NOT exist:
        else {
            show_404();
        }
    }
}
