<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class User extends MY_Controller
{
    //Set the template directory:
    public $user_template_dir = 'user/';

    /**
     * Class constructor.
     **/
    public function __construct()
    {
        parent::__construct();
    }

    public function credentials()
    {
        if ($this->userinfo->get($this->session->userdata('userid'), 'suspended')) {
            //Destroy the session
            $this->session->sess_destroy();
            //Show the problem
            echo 'suspended';
            exit;
        }
    }

    /**
     * User Registration Method.
     **/
    public function register()
    {
        //Load the Form Validation Library:
        $this->load->library('form_validation');
        //Set the Forum validation rules:
        //-----------------------------------------------------
        $this->form_validation->set_rules('username', 'Username',         'trim|required|min_length[5]|max_length[12]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password',         'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('email',    'Email Address',    'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('agree',    'TOS Agreement',    'required');
        //-----------------------------------------------------

        //Set Navigation Data:
        $data['nav'] = array('title' => 'Register');

        //If the form validation fails:
        if (!$this->form_validation->run()) {
            $this->db->order_by('id', 'ASC');
            $tq = $this->db->get('timezones');
            $data['timezones'] = $tq->result_array();
            //Load the registration for again with the errors.
            $this->load->view($this->user_template_dir.'user_register.php', $data);
        } else {
            //Load the Registration Model:
            $this->load->model('user/register');
            //Set the User information
            $userinfo = array('username' => $this->input->post('username'),
                              'password' => $this->input->post('password'),
                              'passconf' => $this->input->post('passconf'),
                              'email' => $this->input->post('email'),
                              'location' => $this->input->post('location'),
                              'timezone' => $this->input->post('timezone'),
                              'dst' => $this->input->post('dst'), );
            //Run it through our Register function.
            //If it doesn't pass:
            if (!$this->register->process($userinfo)) {
                //Set the error to the data array:
                $data['reg_error'] = $this->register->reg_error;
                //Load the form again, with the errors displayed:
                $this->load->view($this->user_template_dir.'user_register.php', $data);
            }
            //If we get here, it means the process was successful.
            //Send them to the success page.
            else {
                $this->session->set_flashdata('msg', 'You have successfully registered. You may now login.');
                redirect('login', 'refresh');
            }
        }
    }

    /**
     * User Forgotten Password.
     **/
    public function forgot()
    {

        //Load the Form Validator:
        $this->load->library('form_validation');
        //Set Navigation Data:
        $data['nav'] = array('title' => 'Forgotten Password');
        //Set rules for the fields.
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');

        //If the form validation fails:
        if (!$this->form_validation->run()) {
            $this->session->keep_flashdata('redirect');
            //Load the login form again with the errors.
            $this->load->view($this->user_template_dir.'user_forgot.php', $data);
        } else {
            //Setup login model data:
            $userinfo = array('email' => $this->input->post('email'));

            //Run it through our Register function.
            //If it doesn't pass:
            if (!$this->userinfo->changepass($userinfo)) {
                //Set the error
                $data['error'] = $this->userinfo->error;
                //and load the login form.
                $this->load->view($this->user_template_dir.'user_forgot.php', $data);
            } else {
                //If we get here, this means the login process was
                //successful. So all we have to do now is redirect
                //them to the homepage.
                $this->session->set_flashdata('msg', 'Password reset successfully. Check your email.');
                redirect('user/login/', 'refresh');
            }
        }
    }

    /**
     * User Login Method.
     **/
    public function login()
    {

        //Load the Form Validator:
        $this->load->library('form_validation');
        //Set Navigation Data:
        $data['nav'] = array('title' => 'Login');
        //Set rules for the fields.
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $data['msg'] = $this->session->flashdata('msg');

        //If the form validation fails:
        if (!$this->form_validation->run()) {
            $this->session->keep_flashdata('redirect');
            //Load the login form again with the errors.
            $this->load->view($this->user_template_dir.'user_login.php', $data);
        } else {
            //Load the login model:
            $this->load->model('user/login');
            //Setup login model data:
            $userinfo = array('username' => $this->input->post('username'),
                              'password' => $this->input->post('password'), );

            //Run it through our Register function.
            //If it doesn't pass:
            if (!$this->login->process($userinfo)) {
                //Set the error
                $data['login_error'] = $this->login->login_error;
                //and load the login form.
                $this->load->view($this->user_template_dir.'user_login.php', $data);
            } else {
                //If we get here, this means the login process was
                //successful. So all we have to do now is redirect
                //them to the homepage.
                redirect(''.$this->session->flashdata('redirect'), 'refresh');
            }
        }
    }

     /**
      * User Edit Account Method.
      **/
     public function edit()
     {
         if (!$this->session->userdata('logged_in')) {
             show_404();
         } else {
             //set username to a variable
            $username = $this->session->userdata('username');
            //Load the Form Validation Library:
            $this->load->library('form_validation');
             if ($this->input->post('update') == 'editinfo') {
                 $this->form_validation->set_rules('timezone',    'Timezone',    'required');
                 $this->form_validation->set_rules('email',    'Email Address',    'required');
                 if ($this->form_validation->run()) {
                     //Setup a database array
                    $dbarray = array('email' => $this->input->post('email'),
                                     'location' => $this->input->post('location'),
                                     'dst' => $this->input->post('dst'),
                                     'signature' => $this->input->post('sig'),
                                     'timezone' => $this->input->post('timezone'),
                                     'skype' => $this->input->post('skype'),
                                     'youtube' => $this->input->post('youtube'),
                                     'facebook' => $this->input->post('facebook'),
                                     'twitter' => $this->input->post('twitter'),
                                     'bio' => $this->input->post('bio'), );
                    //Setup the where clause
                    $this->db->where('username', $username);
                    //Do the update
                    if ($this->db->update('users', $dbarray)) {
                        //if successful, return a message
                        $data['msg'] = 'Updated Successfully.';
                    }
                    //if not successful
                    else {
                        //return an error.
                        $data['errors'] = 'Updated Unsuccessfully.';
                        $this->load->view($this->user_template_dir.'user_edit.php', $data);
                    }
                 }
             } elseif ($this->input->post('update') == 'changeavatar') {
                 //Load the upload model.
                $this->load->model('upload/files');
                //If the upload process failed
                if (!$image = $this->files->upload_avatar()) {
                    //Tell them to upload a valid file.
                    $data['error'] = 'Be sure you upload a valid file.';
                }
                //If it succeeded:
                else {
                    //Setup a database array
                    $dbarray = array('avatar' => $image);
                    $this->db->where('username', $username);
                    //Do the insertion
                    if ($this->db->update('users', $dbarray)) {
                        //if successful, return a message
                        $data['msg'] = 'Avatar Updated Successfully.';
                    }
                    //If it failed
                    else {
                        //return an error.
                        $data['error'] = 'Updated Unsuccessfully.';
                    }
                }
             } elseif ($this->input->post('update') == 'changepass') {
                 //Set the Forum validation rules:
                $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
                 $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required');
                 if ($this->form_validation->run()) {
                     //Setup a database array
                    $salt = time();

                     $newpass = md5(md5($salt.$this->input->post('password')));
                     $dbarray = array('password' => $newpass, 'salt' => $salt);
                    //Setup the where clause
                    $this->db->where('username', $username);
                    //Do the update
                    if ($this->db->update('users', $dbarray)) {
                        //if successful, return a message
                        $data['msg'] = 'Password Updated Successfully.';
                    }
                    //if not successful
                    else {
                        //return an error.
                        $data['error'] = 'Updated Unsuccessfully.';
                    }
                 }
             }
            //Select the specified user info from the database
            echo $username;
             $this->db->where('username', $username);
             $uinfo = $this->db->get('users');
             $uf = $uinfo->result_array();
            //Set the email
            $data['info'] = $uf[0];
            //Grab the timezone list from the db
            $this->db->order_by('id', 'ASC');
             $tq = $this->db->get('timezones');
             $data['timezones'] = $tq->result_array();
             $this->load->view($this->user_template_dir.'user_edit.php', $data);
         }
     }

    public function sendfr()
    {
        if (!$this->session->userdata('logged_in')) {
            show_404();
        } else {
            $theirid = $this->uri->segment(3);
            $userid = $this->session->userdata('userid');

            if (!$this->userinfo->is_friends($theirid)) {
                $this->db->insert('friends', array('userid' => $userid, 'friendid' => $theirid, 'status' => '0'));
            }

            $username = $this->userinfo->get($theirid, 'username');

            redirect(base_url().'profile/'.$username, 'refresh');
        }
    }

    public function cancelfr()
    {
        if (!$this->session->userdata('logged_in')) {
            show_404();
        } else {
            $theirid = $this->uri->segment(3);
            $userid = $this->session->userdata('userid');

            if ($this->userinfo->is_pending($theirid)) {
                $this->db->where('userid', $userid);
                $this->db->where('friendid', $theirid);
                $this->db->or_where('userid', $theirid);
                $this->db->where('friendid', $userid);
                $this->db->delete('friends');
            }

            $username = $this->userinfo->get($theirid, 'username');

            redirect(base_url().'profile/'.$username, 'refresh');
        }
    }

    public function removefr()
    {
        if (!$this->session->userdata('logged_in')) {
            show_404();
        } else {
            $theirid = $this->uri->segment(3);
            $userid = $this->session->userdata('userid');

            if ($this->userinfo->is_friends($theirid)) {
                $this->db->where('userid', $userid);
                $this->db->where('friendid', $theirid);
                $this->db->or_where('userid', $theirid);
                $this->db->where('friendid', $userid);
                $this->db->delete('friends');
            }

            $username = $this->userinfo->get($theirid, 'username');

            redirect(base_url().'profile/'.$username, 'refresh');
        }
    }

    /**
     * User Logout Method.
     **/
    public function logout()
    {
        //Destroy the session
        $this->session->sess_destroy();
        //Redirect them.
        redirect('', 'refresh');
    }
}
