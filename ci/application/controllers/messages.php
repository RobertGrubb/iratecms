<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Messages extends MY_Controller
{
    //Setup a Template Directory:
    public $msgs_template_dir = 'messages/';
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
    public function inbox()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('redirect', '/messages/inbox/');
            redirect('/user/login/', 'refresh');
        } else {
            $this->log->user('messages', 'Viewed Inbox');
            //Get the current sessions userid
            $userid = $this->session->userdata('userid');
            //Load the Form Validation Library:
            $this->load->library('form_validation');
            //Set rules for the reply message:
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('title',    'Subject',  'required');
            $this->form_validation->set_rules('message',  'Message',  'required');
            //Run the form validator:
            if ($this->form_validation->run()) {
                //Get the user information for the specified userid
                $this->db->where('username', $this->input->post('username'));
                $uq = $this->db->get('users');
                //If the user does exist:
                if ($uq->num_rows() >= 1) {
                    //Set the data to a variable.
                    $uf = $uq->result_array();
                    //Setup a variable with our needed information
                    $dbarray = array('sendid' => $userid,
                                     'recvid' => $uf[0]['id'],
                                     'title' => $this->input->post('title'),
                                     'message' => $this->input->post('message'),
                                     'type' => 'parent',
                                     'last_reply_date' => time(),
                                     'sender_read' => 1, );
                    //Execute the insertion
                    if ($this->db->insert('privmsgs', $dbarray)) {
                        //If the insertion was successful,
                        //Get the new insert id.
                        $newid = $this->db->insert_id();
                        //redirect the user to the new conversation.
                        redirect('/messages/convo/'.$newid, 'refresh');
                    }
                    //If the insertion was not successful.
                    else {
                        //Let them know by setting a error.
                        $data['error'] = 'Message did not send.';
                    }
                }
                //If we get here, it means that the user
                //specified does not exist. Let them know.
                else {
                    $data['error'] = 'User does not exist.';
                }
            }
            //Load the pagination library:
            $this->load->library('pagination');
            //Configure Pagination:
            //----------------------------------------
                //Set the base url
                $config['base_url'] = settings('site_url').'messages/inbox/';
                //set the URI Segment.
                $config['uri_segment'] = 3;
                //Whether we are using page numbers
                $config['use_page_numbers'] = false;
            //Set opening tag for selected page
            $config['cur_tag_open'] = '<li class="active"><a href="#" >';
            //Set closing tag for selected page
            $config['cur_tag_close'] = '</a></li>';
                //Do the query so we can get the total number of rows.
                $this->db->where("(recvid = '".$userid."'  && recv_deleted   = '0' ||
                                   sendid = '".$userid."' && sender_deleted = '0')");
            $this->db->where('type', 'parent');
            $this->db->order_by('last_reply_date', 'desc');
            $nq = $this->db->get('privmsgs');
                //Set the total rows
                $config['total_rows'] = $nq->num_rows();
                //Set the items per page.
                $config['per_page'] = 16;
                //Set the current page:
                $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
                //Set the Limit for the query:
                //$limit = ($page * $this->replies_per_page);
                //Initialize the pagination script.
                $this->pagination->initialize($config);
            //----------------------------------------
            //Set the limit (Depending on pagination config)
            $this->db->where("(recvid = '".$userid."'  && recv_deleted   = '0' ||
                               sendid = '".$userid."' && sender_deleted = '0')");
            //Only get the messages that are parents.
            $this->db->where('type', 'parent');
            //Order by the last reply date.
            $this->db->order_by('last_reply_date', 'desc');
            //Limit only a certain amount per page.
            $this->db->limit($config['per_page'], $page);
            //Get the messages
            $messages = $this->db->get('privmsgs');
            //Set the information to the template
            $data['messages'] = $messages->result_array();
            $this->db->where('friendid', $userid);
            $this->db->where('status', '0');
            $requests = $this->db->get('friends');
            $requests = $requests->result_array();
            $data['requests'] = $requests;
            //Load the template.
            $this->load->view($this->msgs_template_dir.'messages.php', $data);
        }
    }

    public function acceptfr()
    {
        $theirid = $this->uri->segment(3);
        $userid = $this->session->userdata('userid');
        $this->db->where('userid', $theirid);
        $this->db->where('friendid', $userid);
        $this->db->update('friends', array('status' => 1));
        redirect(base_url().'messages/inbox/#frequests', 'refresh');
    }

    public function declinefr()
    {
        $theirid = $this->uri->segment(3);
        $userid = $this->session->userdata('userid');
        $this->db->where('userid', $theirid);
        $this->db->where('friendid', $userid);
        $this->db->delete('friends');
        redirect(base_url().'messages/inbox/#frequests', 'refresh');
    }

    public function delete()
    {
        if ($this->session->userdata('logged_in')) {
            //Get the current sessions userid
            $userid = $this->session->userdata('userid');
            //Go through each message that we're suppose to delete.
            foreach ($this->input->post('messages') as $msgid => $value) {
                //Select the message from the database
                $this->db->where('id', $msgid);
                $uq = $this->db->get('privmsgs');
                //Set the information to a variable.
                $uf = $uq->result_array();
                //If the session user has ownership over the selected message
                if ($uf[0]['sendid'] == $userid || $uf[0]['recvid'] == $userid) {
                    //Check if the user is the sender
                    if ($uf[0]['sendid'] == $userid) {
                        //Ifso, set the sender's read column to 1
                        $dbarray = array('sender_deleted' => 1,
                                         'sender_read' => 1, );
                        $this->db->where('id', $msgid);
                        $this->db->update('privmsgs', $dbarray);
                    }
                    //Check if the user is the receiver
                    else {
                        //Ifso, set the receiver's read column to 1
                        $dbarray = array('recv_deleted' => 1,
                                         'recv_read' => 1, );
                        $this->db->where('id', $msgid);
                        $this->db->update('privmsgs', $dbarray);
                    }
                }
            }
            //Redirect the user to their inbox.
            redirect('/messages/inbox/', 'refresh');
        }
    }
    /**
     * View Method:
     * This will display an
     * inbox message.
     **/
    public function convo()
    {
        //Get the message id
        $msgid = $this->uri->segment(3);
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('redirect', '/messages/convo/'.$msgid);
            redirect('/user/login/', 'refresh');
        } else {
            //Get the current session's userid.
            $userid = $this->session->userdata('userid');
            //Setup a query to get the private message.
            $this->db->where('id', $msgid);
            $mq = $this->db->get('privmsgs');
            //Check and see if the message exists.
            if ($mq->num_rows() >= 1) {
                $mf = $mq->result_array();
                if ($mf[0]['recvid'] == $userid || $mf[0]['sendid'] == $userid) {
                    //Setup the update for the read columns.
                    if ($mf[0]['recvid'] == $userid) {
                        //If we are the receiver, set theirs to unread
                        $read = "recv_read = '1'";
                    }
                    //If we are the sender
                    else {
                        //Set the reciever to unread.
                        $read = "sender_read = '1'";
                    }
                    //Set the message to read.
                    $this->db->query('UPDATE privmsgs SET '.$read." WHERE id = '".$this->db->escape($msgid)."'");
                    //Load the Form Validation Library:
                    $this->load->library('form_validation');
                    //Set rules for the reply message:
                    $this->form_validation->set_rules('message', 'Message', 'required');
                    //Run the form validator:
                    if ($this->form_validation->run()) {
                        //Setup a variable for the database information.
                        $dbarray = array('sendid' => $userid,
                                         'recvid' => $mf[0]['sendid'],
                                         'title' => $mf[0]['title'],
                                         'message' => $this->input->post('message'),
                                         'type' => 'sub',
                                         'parentid' => $mf[0]['id'], );
                        //Setup the update for the read columns.
                        if ($mf[0]['recvid'] == $userid) {
                            //If we are the receiver, set theirs to unread
                            $updateRow = "sender_read = '0', recv_read = '1'";
                        }
                        //If we are the sender
                        else {
                            //Set the reciever to unread.
                            $updateRow = "recv_read = '0', sender_read = '1'";
                        }
                        //Set the current timestamp:
                        $time = time();
                        //Insert the reply
                        $this->db->insert('privmsgs', $dbarray);
                        $this->db->query('UPDATE privmsgs SET '.$updateRow.", last_reply_date = '".$time."' WHERE id = '".$this->db->escape($msgid)."'");
                        redirect('/messages/convo/'.$msgid, 'refresh');
                    }
                    //They have access to this message.
                    $data['parent_message'] = $mf[0];
                    //Get the replies:
                    $this->db->where('parentid', $msgid);
                    $this->db->where('type', 'sub');
                    $rq = $this->db->get('privmsgs');
                    $data['replies'] = $rq->result_array();
                } else {
                    //They do not have access to this message.
                    /*
                     * @todo:
                     * Create a page explaining this error.
                     **/
                }
                //Load the template.
                $this->load->view($this->msgs_template_dir.'viewmsg.php', $data);
            }
            //If we get here, the message doesnt exist.
            else {
                //We will show an error here.
                /*
                 * @todo:
                 * Create a page explaining this error.
                 **/
            }
        }
    }
}
