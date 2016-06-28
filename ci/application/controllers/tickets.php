<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Tickets extends MY_Controller
{
    //Setup a Template Directory:
    public $ticket_template_dir = 'tickets/';
    /**
     * Class Constructor.
     **/
    public function __construct()
    {
        //Call the parent constructor
        parent::__construct();
        //Load the BBCode helper
        $this->load->helper('misc/bbcode');

        if (!$this->session->userdata('logged_in')) {
            show_404();
        }
    }
    /**
     * Index Method:
     * This will display all inbox
     * messages, friend invites, team
     * invites, etc.
     **/
    public function all()
    {
        //Check if the user is logged in.
        if (!$this->session->userdata('logged_in')) {
            //Set the redirect data
            $this->session->set_flashdata('redirect', '/tickets/all/');
            //redirect them to the login page.
            redirect('/user/login/', 'refresh');
        }
        //If the user IS logged in:
        else {
            //Get the user id
            $userid = $this->session->userdata('userid');
            //Load the Form Validation Library:
            $this->load->library('form_validation');
            //Set rules for the reply message:
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('content',    'Message',  'required');
            //Run the form validator:
            if ($this->form_validation->run()) {
                //Setup a variable with our needed information
                $dbarray = array('userid' => $userid,
                                 'userip' => $this->input->ip_address(),
                                 'subject' => $this->input->post('subject'),
                                 'catid' => $this->input->post('category'),
                                 'content' => $this->input->post('content'),
                                 'status' => $this->input->post('status'),
                                 'proof' => serialize($this->input->post('url')), );
                //Execute the insertion
                if ($this->db->insert('tickets', $dbarray)) {
                    //If the insertion was successful,
                    //Get the new insert id.
                    $newid = $this->db->insert_id();
                    //redirect the user to the new conversation.
                    redirect('/tickets/view/'.$newid, 'refresh');
                }
                //If the insertion was not successful.
                else {
                    //Let them know by setting a error.
                    $data['error'] = 'Ticket was not created..';
                }
            }
            //Set the where clause
            $this->db->where('userid', $userid);
            //Set the order by
            $this->db->order_by('created', 'DESC');
            //Get the tickets from the database
            $tq = $this->db->get('tickets');
            //Set the information to the data array
            $data['tickets'] = $tq->result_array();
            //Set the order by
            $this->db->order_by('orderid', 'ASC');
            //Get the categories
            $cq = $this->db->get('ticket_categories');
            //Set them to the data array
            $data['categories'] = $cq->result_array();
            //Load the template
            $this->load->view($this->ticket_template_dir.'tickets.php', $data);
        }
    }

    /**
     * View Method:
     * This will display all inbox
     * messages, friend invites, team
     * invites, etc.
     **/
    public function view()
    {
        //Get the ticket id
        $ticketid = $this->uri->segment(3);
        //Check if the user is logged in
        if (!$this->session->userdata('logged_in')) {
            //Set the redirect data
            $this->session->set_flashdata('redirect', '/tickets/view/'.$ticketid);
            //redirect them to the login page
            redirect('/user/login/', 'refresh');
        }
        //If the user IS logged in:
        else {
            //Set the where clause
            $this->db->where('id', $ticketid);
            //Get the tickets
            $tq = $this->db->get('tickets');
            //Get the result array
            $tf = $tq->result_array();
            //If this is NOT the users ticket
            if ($tf[0]['userid'] != $this->session->userdata('userid')) {
                //This means that this is not there ticket.
                /*
                 * @todo: Create a error for this.
                 **/
            }
            //If this IS their ticket:
            else {
                //Load the Form Validation Library:
                $this->load->library('form_validation');
                //Set the rules
                $this->form_validation->set_rules('content',    'Message',  'required');
                //Run the form validator:
                if ($this->form_validation->run()) {
                    //Setup the database array.
                    $dbarray = array('userid' => $this->session->userdata('userid'),
                                     'ticket_id' => $ticketid,
                                     'content' => $this->input->post('content'), );
                    //Do the insert:
                    if ($this->db->insert('ticket_comments', $dbarray)) {
                        //Set the where clause
                         $this->db->where('id', $ticketid);
                         //Setup the database array.
                         $dbarray = array('status' => 0);
                         //Do the update query
                         $this->db->update('tickets', $dbarray);
                         //Nothing because it was successful.
                         $data['msg'] = 'Replied to ticket successfully.';
                    }
                    //If the insert doesn not go through
                    else {
                        //Setup an error.
                         $data['error'] = 'Attempt to reply failed.';
                    }
                }
                //Set the where clause
                $this->db->where('ticket_id', $ticketid);
                //Set the order by
                $this->db->order_by('date', 'ASC');
                //Get the ticket comments
                $replies = $this->db->get('ticket_comments');
                //Get the result array
                $data['replies'] = $replies->result_array();
                //Set the ticket to the data array.
                $data['ticket'] = $tf[0];
                //Get Category:
                //-----------------------------------------
                $this->db->where('id', $tf[0]['catid']);
                $catq = $this->db->get('ticket_categories');
                if ($catq->num_rows < 1) {
                    $data['cat_title'] = 'OTHER';
                    $data['cat_id'] = 0;
                } else {
                    $cat = $catq->result_array();
                    $data['cat_title'] = $cat[0]['title'];
                    $data['cat_id'] = $cat[0]['id'];
                }
                //-----------------------------------------
                //Load the template
                $this->load->view($this->ticket_template_dir.'view_ticket.php', $data);
            }
        }
    }
}
