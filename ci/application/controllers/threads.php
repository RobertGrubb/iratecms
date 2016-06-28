<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Threads extends MY_Controller
{
    //Set the template directory:
    public $thread_template_dir = 'threads/';
    //Set replies per page.
    public $replies_per_page = 8;

    /**
     * Class Constructor.
     **/
    public function __construct()
    {
        parent::__construct();
        //Load the BBCode helper
        $this->load->helper('misc/bbcode');
        //Load the thread helper
        $this->load->helper('threads/threads');
    }

    /**
     * Index Method
     * If this method is called, this means
     * that a thread id wasn't specified, and that
     * we need to display an error to them.
     **/
    public function index()
    {
        //Load the non-existent thread page.
        show_404();
    }

    public function editpost()
    {
        if (!$this->session->userdata('logged_in')) {
            show_404();
        } else {
            //Get the type of edit
            $type = $this->uri->segment(3);
            //Get the post id
            $id = $this->uri->segment(4);
            //If type or id is empty, end the process.
            if (empty($type) || empty($id)) {
                show_404();
            }
            //If both are set
            else {
                //If we are editing a thread post:
                if ($type == 't') {
                    //Get the thread information from the database
                    $this->db->where('id', $id);
                    $tq = $this->db->get('threads');
                    //If the thread exists.
                    if ($tq->num_rows() >= 1) {
                        //Set the thread information to a variable
                        $tf = $tq->result_array();
                        //If the current user is the poster, or
                        //has access to edit:
                        if ($this->acl->perm('can_edit_threads') ||
                           $tf[0]['userid'] == $this->session->userdata('userid')) {
                            //Load the Form Validation Library:
                            $this->load->library('form_validation');
                            //Set the form rules:
                            //------------------------------------------------------------------
                            $this->form_validation->set_rules('title', 'Title', 'required');
                            $this->form_validation->set_rules('content', 'Content', 'required');
                            //------------------------------------------------------------------
                            //Run the validator:
                            if ($this->form_validation->run()) {
                                //If the form was submitted, setup a database array
                                $dbarray = array('title' => $this->input->post('title'),
                                                 'content' => $this->input->post('content'), );
                                //Set the where clause
                                $this->db->where('id', $id);
                                //Execute the query
                                if ($this->db->update('threads', $dbarray)) {
                                    //If successful, redirect to the thread
                                    redirect('/threads/view/'.$id, 'refresh');
                                }
                                //If not successful
                                else {
                                    //Set an error message.
                                    $data['error'] = 'Update not successful.';
                                }
                            }
                            //Set the type to the data array
                            $data['type'] = $type;
                            //Set the title to the data array
                            $data['title'] = $tf[0]['title'];
                            //Set the content to the data array
                            $data['content'] = $tf[0]['content'];
                            //Get the Forum information
                            $fq = $this->db->query("SELECT * FROM forums WHERE id = '".$tf[0]['fid']."'");
                            //Set the forum information to a variable:
                            $ff = $fq->result_array();
                            //Set the navigation array:
                            $data['nav'] = array('fid' => $ff[0]['id'],
                                                 'f_title' => $ff[0]['title'],
                                                 'tid' => $tf[0]['id'],
                                                 't_title' => $tf[0]['title'],
                                                 'title' => 'Edit Post', );
                            //Load the template:
                            $this->load->view($this->thread_template_dir.'editpost.php', $data);
                        }
                        //If incorrect access:
                        else {
                            //Show the error template.
                            show_404();
                        }
                    }
                    //If the post does not exist:
                    else {
                        //Load the error template
                        $this->load->view($this->thread_template_dir.'edit_error.php');
                    }
                }
                //If we are editing a post:
                elseif ($type == 'p') {
                    //Get the reply information
                    $this->db->where('id', $id);
                    $rq = $this->db->get('replies');
                    //Check if the reply exists
                    if ($rq->num_rows() >= 1) {
                        //Get the reply information
                        $rf = $rq->result_array();
                        //If the user has access to edit the reply
                        if ($this->acl->perm('can_edit_replies') ||
                           $rf[0]['userid'] == $this->session->userdata('userid')) {
                            //Load the Form Validation Library:
                            $this->load->library('form_validation');
                            //Set rules for the reply message:
                            $this->form_validation->set_rules('content', 'Content', 'required');
                            //Run the validator
                            if ($this->form_validation->run()) {
                                //If the form validated, setup the database array/
                                $dbarray = array('content' => $this->input->post('content'));
                                //Set the where clause.
                                $this->db->where('id', $id);
                                //Execute the query
                                if ($this->db->update('replies', $dbarray)) {
                                    //If success, redirect to the thread
                                    redirect('/threads/view/'.$rf[0]['tid'], 'refresh');
                                }
                                //If failed
                                else {
                                    //Set a error message
                                    $data['error'] = 'Update not successful.';
                                }
                            }
                            //Set the type to the data array
                            $data['type'] = $type;
                            //Set the content to the data array
                            $data['content'] = $rf[0]['content'];
                            //Get the thread information
                            $tq = $this->db->query("SELECT * FROM threads WHERE id = '".$rf[0]['tid']."'");
                            $tf = $tq->result_array();
                            //Get the forum information
                            $fq = $this->db->query("SELECT * FROM forums WHERE id = '".$rf[0]['fid']."'");
                            $ff = $fq->result_array();
                            //Set the navigation array
                            $data['nav'] = array('fid' => $ff[0]['id'],
                                                 'f_title' => $ff[0]['title'],
                                                 'tid' => $tf[0]['id'],
                                                 't_title' => $tf[0]['title'],
                                                 'title' => 'Edit Post', );
                            //Show the template
                            $this->load->view($this->thread_template_dir.'editpost.php', $data);
                        }
                        //If not enough access
                        else {
                            show_404();
                        }
                    }
                    //If reply doesnt exist:
                    else {
                        show_404();
                    }
                }
            }
        }
    }

    /**
     * View Method
     * This will handle all output
     * for a specific thread.
     **/
    public function view()
    {
        //Get the Thread ID
        $tid = $this->uri->segment(3);
        //Check for thread existence.
        $this->db->where('id', $tid);
        $tq = $this->db->get('threads');
        //Get the number of rows:
        $tn = $tq->num_rows();
        //If the number returns 1 or more, then the thread
        //does infact exist.
        if ($tn > 0) {
            //Get the thread information
            $tf = $tq->result_array();
            if ($this->acl->access('forums', $tf[0]['fid'])) {
                updateViews($tid);
                //Load the Form Validation Library:
                $this->load->library('form_validation');
                //Set rules for the reply message:
                $this->form_validation->set_rules('content', 'Content', 'required');
                //Run the form validator:
                if ($this->form_validation->run()) {
                    //Check if the user is logged in before
                    //continuing on with this process.
                    if ($this->session->userdata('logged_in')) {
                        //Setup the text variable:
                        $text = $this->input->post('content');
                        //retrieve the userid
                        $userid = $this->session->userdata('userid');
                        //Setup the db array:
                        $dbarray = array('fid' => $tf[0]['fid'],
                                         'tid' => $tf[0]['id'],
                                         'catid' => $tf[0]['catid'],
                                         'userid' => $userid,
                                         'content' => $text, );
                        //Do the db insert.
                        if (!$this->db->insert('replies', $dbarray)) {
                            //If it wasn't successful, let's return
                            //an unkown error.
                            $data['error'] = 'An error occured.';
                        } else {
                            $currentTime = time();
                            //Update the thread's last reply date.
                            $this->db->query("UPDATE threads SET latest_reply_date = '".$currentTime."' WHERE id = '".$tf[0]['id']."'");
                        }
                    }
                    //If the user is not logged in:
                    else {
                        //So the error stating that they may not post here.
                        $data['error'] = 'You are not logged in, and can not post a reply to this thread.';
                    }
                }

                //Set thread info to a data variable so we can pass it to the template.
                $data['thread'] = $tq->result_array();
                //Varius Queries we need for Navigation information:
                //==============================================================
                $fq = $this->db->query("SELECT * FROM forums WHERE id = '".$data['thread'][0]['fid']."'");
                $ff = $fq->result_array();
                //==============================================================

                //Load the pagination library:
                $this->load->library('pagination');
                //Configure Pagination:
                //----------------------------------------
                    //Set the base url
                    $config['base_url'] = settings('site_url').'threads/view/'.$tf[0]['id'].'/';
                    //set the URI Segment.
                    $config['uri_segment'] = 4;
                    //Whether we are using page numbers
                    $config['use_page_numbers'] = false;
                    //Set opening tag for selected page
                    $config['cur_tag_open'] = '<li class="active"><a href="#" >';
                    //Set closing tag for selected page
                    $config['cur_tag_close'] = '</a></li>';
                    //Do the query so we can get the total number of rows.
                    $rq = $this->db->query("SELECT * FROM replies WHERE tid = '".$tf[0]['id']."'");
                    //Set the total rows
                    $config['total_rows'] = $rq->num_rows();
                    //Set the items per page.
                    $config['per_page'] = $this->replies_per_page;
                    //Set the current page:
                    $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
                    //Set the Limit for the query:
                    //$limit = ($page * $this->replies_per_page);
                    //Initialize the pagination script.
                    $this->pagination->initialize($config);
                //----------------------------------------

                //Retrieve all replies to this thread:
                //Ideal way to process the replies within the thread.
                foreach ($data['thread'] as $key => $row) {
                    //Set the limit (Depending on pagination config)
                    $this->db->limit($config['per_page'], $page);
                    //Set the where
                    $this->db->where('tid', $row['id']);
                    //Get the info from the db
                    $rq = $this->db->get('replies');
                    //Setup the replies
                    $row['replies'] = $rq->result_array();
                    //add the replies to the thread array.
                    $data['thread'][$key] = $row;
                }

                //Setup the navigation data we will send to the navigation
                //from the thread template.
                $data['nav'] = array('fid' => $ff[0]['id'],
                                     'f_title' => $ff[0]['title'],
                                     'tid' => $data['thread'][0]['id'],
                                     't_title' => $data['thread'][0]['title'], );

                $data['msg'] = $this->session->flashdata('msg');

                //Load the template.
                $this->load->view($this->thread_template_dir.'threads_view.php', $data);
            } else {
                show_404();
            }
        }
        //If it returns 0, then we have a problem because
        //the thread doesn't exist. Let them know.
        else {
            show_404();
        }
    }

    /** Moderator Functions **/
    public function sticky()
    {
        //Get thread ID
        $tid = $this->uri->segment(3);
        //Check permission:
        if ($this->acl->perm('can_sticky_thread')) {
            $this->db->where('id', $tid);
            $this->db->update('threads', array('type' => '1'));
            $this->session->set_flashdata('msg', 'Thread stickied successfully.');
            redirect('/threads/view/'.$tid, 'refresh');
        } else {
            show_404();
        }
    }

    public function unsticky()
    {
        //Get thread ID
        $tid = $this->uri->segment(3);
        //Check permission:
        if ($this->acl->perm('can_sticky_thread')) {
            $this->db->where('id', $tid);
            $this->db->update('threads', array('type' => '0'));
            $this->session->set_flashdata('msg', 'Thread un-stickied successfully.');
            redirect('/threads/view/'.$tid, 'refresh');
        } else {
            show_404();
        }
    }

    public function close()
    {
        //Get thread ID
        $tid = $this->uri->segment(3);
        //Check permission:
        if ($this->acl->perm('can_lock_thread')) {
            $this->db->where('id', $tid);
            $this->db->update('threads', array('locked' => '1'));
            $this->session->set_flashdata('msg', 'Thread locked successfully.');
            redirect('/threads/view/'.$tid, 'refresh');
        } else {
            show_404();
        }
    }

    public function open()
    {
        //Get thread ID
        $tid = $this->uri->segment(3);
        //Check permission:
        if ($this->acl->perm('can_lock_thread')) {
            $this->db->where('id', $tid);
            $this->db->update('threads', array('locked' => '0'));
            $this->session->set_flashdata('msg', 'Thread unlocked successfully.');
            redirect('/threads/view/'.$tid, 'refresh');
        } else {
            show_404();
        }
    }
}
