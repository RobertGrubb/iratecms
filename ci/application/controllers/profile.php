<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * IrateCMS v3.0.X
 **/
class Profile extends MY_Controller
{
    //Setup a Template Directory:
    public $profile_template_dir = 'profile/';

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
     * Default Method.
     **/
    public function index()
    {
        show_404();
    }

    /**
     * View Method.
     **/
    public function view()
    {
        $username = $this->uri->segment(2);
        $userdata = $this->userinfo->profiledata($username);

        //Get Recent Activity:
        $this->db->where('userid', $userdata['id']);
        $this->db->order_by('date', 'DESC');
        $this->db->limit(10);
        $threads = $this->db->get('threads');
        $threads = $threads->result_array();
        $data['threads'] = $threads;
        $this->db->where('userid', $userdata['id']);
        $this->db->order_by('date', 'DESC');
        $this->db->limit(10);
        $posts = $this->db->get('replies');
        $posts = $posts->result_array();
        $data['posts'] = $posts;
        $friends = $this->userinfo->friends($userdata['id']);
        $data['friends'] = $friends;
        $data['user'] = $userdata;
        $this->load->view($this->profile_template_dir.'view.php', $data);
    }
}
