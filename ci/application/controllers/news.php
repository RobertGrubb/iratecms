<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class News extends MY_Controller
{
    //Setup a Template Directory:
    public $news_template_dir = 'news/';
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

        //Load the pagination library:
        $this->load->library('pagination');
        //Configure Pagination:
        //----------------------------------------
            //Set the base url
            $config['base_url'] = base_url().'news/index/';
            //set the URI Segment.
            $config['uri_segment'] = 3;
            //Whether we are using page numbers
            $config['use_page_numbers'] = false;
            //Set opening tag for selected page
            $config['cur_tag_open'] = '<li class="active"><a href="#" >';
            //Set closing tag for selected page
            $config['cur_tag_close'] = '</a></li>';
            //Do the query so we can get the total number of rows.
            $nq = $this->db->get('news');
            //Set the total rows
            $config['total_rows'] = $nq->num_rows();
            //Set the items per page.
            $config['per_page'] = 8;
            //Set the current page:
            $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
            //Set the Limit for the query:
            //$limit = ($page * $this->replies_per_page);
            //Initialize the pagination script.
            $this->pagination->initialize($config);
        //----------------------------------------
        //The where clause
        $this->db->order_by('id', 'DESC');
        //Limit depending on our pagination script
        $this->db->limit($config['per_page'], $page);
        //Get the logs
        $news = $this->db->get('news');
        //Set the logs to the data array
        $data['news'] = $news->result_array();
        //Load the template
        $this->load->view($this->news_template_dir.'news.php', $data);
    }

    /**
     * Method: view
     * Displays a specific
     * document to the user.
     **/
    public function view()
    {
        //Get the newsid:
        $newsid = $this->uri->segment(3);
        //Select the specified document from the database
        $this->db->where('id', $newsid);
        $newsq = $this->db->get('news');
        //Check if it exists:
        if ($newsq->num_rows() >= 1) {
            //Set the user information to the data array
            $data['news'] = $newsq->result_array();
            //Load the view file
            $this->load->view($this->news_template_dir.'view.php', $data);
        }
        //If the document does NOT exist:
        else {
            //Show a template that handles that specific error.
            $this->load->view($this->news_template_dir.'nonexist.php');
        }
    }
}
