<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Galleries extends MY_Controller
{
    //Setup a Template Directory:
    public $galleries_template_dir = 'galleries/';
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
        $galleries = $this->db->get('galleries');
        $galleries = $galleries->result_array();
        $data['galleries'] = $galleries;
        $this->load->view($this->galleries_template_dir.'galleries.php', $data);
    }

    /**
     * Method: view
     * Displays a specific
     * document to the user.
     **/
    public function view()
    {
        //Get the newsid:
        $galleryid = $this->uri->segment(3);
        //Select the specified document from the database
        $this->db->where('id', $galleryid);
        $gallery = $this->db->get('galleries');
        //Check if it exists:
        if ($gallery->num_rows() >= 1) {
            $this->db->where('galleryid', $galleryid);
            $this->db->order_by('id', 'DESC');
            $images = $this->db->get('gallery_images');
            $images = $images->result_array();

            $gallery = $gallery->result_array();
            $data['gallery'] = $gallery[0];
            $data['images'] = $images;

            $this->load->view($this->galleries_template_dir.'view.php', $data);
        }
        //If the document does NOT exist:
        else {
            //Show a template that handles that specific error.
            show_404();
        }
    }
}
