<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Forums extends MY_Controller
{
    //Set the template directory:
    public $forum_template_dir = 'forums/';
    public $threads_per_page = 20;

    public function __construct()
    {
        //Call parent's constructor
        parent::__construct();
        //Load the forum helper.
        $this->load->helper('forums/forum');
        $this->load->helper('threads/threads');
    }

    /**
     * Form Home Method.
     **/
    public function index()
    {
        //Retrieve the forums:
        //-------------------------------------------------------------------
        $cq = $this->db->query('SELECT * FROM categories ORDER BY orderid ASC');
        $cf = $cq->result_array();
        //Ideal way to process the forums within the categories.
        foreach ($cf as $key => $row) {
            $fq = $this->db->query("SELECT * FROM forums WHERE catid = '".$row['id']."' ORDER BY orderid ASC");
            $row['forums'] = $fq->result_array();
            $cf[$key] = $row;
        }

        //Push information into the data array.
        $data['categories'] = $cf;
        //-------------------------------------------------------------------

        //Load the template:
        $this->load->view($this->forum_template_dir.'forums_home.php', $data);
    }

    /**
     * Form View Method.
     **/
    public function view()
    {
        $fid = $this->uri->segment(3);
        if (empty($fid)) {
            show_404();
        } else {
            //Get the Forum Information:
            $this->db->where('id', $fid);
            $fq = $this->db->get('forums');
            if ($fq->num_rows() >= 1) {
                $ff = $fq->result_array();
                if ($this->acl->access('forums', $fid)) {
                    $data['forum'] = $fq->result_array();
                    //Load the pagination library:
                    $this->load->library('pagination');
                    //Configure Pagination:
                    //----------------------------------------
                        //Set the base url
                        $config['base_url'] = settings('site_url').'forums/view/'.$data['forum'][0]['id'].'/';
                        //set the URI Segment.
                        $config['uri_segment'] = 4;
                        //Whether we are using page numbers
                        $config['use_page_numbers'] = false;
                        //Set opening tag for selected page
                        $config['cur_tag_open'] = '<li class="active"><a href="#" >';
                        //Set closing tag for selected page
                        $config['cur_tag_close'] = '</a></li>';
                        //Do the query so we can get the total number of rows.
                        $this->db->where('fid', $fid);
                    $rq = $this->db->get('threads');
                        //Set the total rows
                        $config['total_rows'] = $rq->num_rows();
                        //Set the items per page.
                        $config['per_page'] = $this->threads_per_page;
                        //Set the current page:
                        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
                        //Set the Limit for the query:
                        //$limit = ($page * $this->replies_per_page);
                        //Initialize the pagination script.
                        $this->pagination->initialize($config);
                    //----------------------------------------
                    //Get the Threads loop:
                    $this->db->limit($config['per_page'], $page);
                    $this->db->where('fid', $fid);
                    $this->db->order_by('type', 'DESC');
                    $this->db->order_by('latest_reply_date', 'DESC');
                    $tq = $this->db->get('threads');
                    $data['threads'] = $tq->result_array();
                    //Setup the navigation data we will send to the navigation
                    //from the forum template.
                    $data['nav'] = array('fid' => $data['forum'][0]['id'],
                                         'f_title' => $data['forum'][0]['title'], );
                    //Load the template:
                    $this->load->view($this->forum_template_dir.'forums_view.php', $data);
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }

    /**
     * Form Create Thread Method.
     **/
    public function createthread()
    {
        //Check if the user is logged in.
        if ($this->session->userdata('logged_in')) {
            //Get the Forum ID
            $fid = $this->uri->segment(3);
            //Get information for the forum
            $this->db->where('id', $fid);
            $fq = $this->db->get('forums');
            //Check if the forum exists
            if ($fq->num_rows() > 0) {
                $data['forum'] = $fq->result_array();
                //Setup the navigation data we will send to the navigation
                //from the forum template.
                $data['nav'] = array('fid' => $data['forum'][0]['id'],
                                     'f_title' => $data['forum'][0]['title'],
                                     'title' => 'Create Thread', );
                //Load the Form Validation Library:
                $this->load->library('form_validation');
                //Set rules for the reply message:
                //--------------------------------------------------------------------
                $this->form_validation->set_rules('content', 'Content', 'required');
                $this->form_validation->set_rules('title', 'Title', 'required');
                //--------------------------------------------------------------------
                if ($this->form_validation->run()) {
                    //Setup the title variable:
                    $title = $this->input->post('title');
                    //Setup the text variable:
                    $text = $this->input->post('content');
                    //retrieve the userid
                    $userid = $this->session->userdata('userid');
                    //Setup the new Database Array:
                    $dbarray = array('fid' => $fid,
                                     'catid' => $data['forum'][0]['catid'],
                                     'title' => $title,
                                     'content' => $text,
                                     'userid' => $userid,
                                     'latest_reply_date' => time(), );
                    //Do the Database Insertion:
                    if (!$this->db->insert('threads', $dbarray)) {
                        //If it wasn't successful, show an error.
                        $data['error'] = 'Something went wrong.';
                    }
                    //If it was successful:
                    else {
                        //Get the new id of the insert
                        $newid = $this->db->insert_id();
                        //Redirect them to the new thread
                        redirect('/threads/view/'.$newid, 'refresh');
                    }
                }
                //Display the Template.
                $this->load->view($this->forum_template_dir.'forums_createthread.php', $data);
            } else {
                show_404();
            }
        }
        //If the user is not logged in:
        else {
            show_404();
        }
    }
}
