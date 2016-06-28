<?php
    /**
     * --------------------------------------
     * @file: cp_users.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the User
     * Administration.
     * --------------------------------------
     **/
    class cp_users extends CI_Model
    {
        /**
         * ----------------------------------
         * @method: Process
         * @since: Version 1.0
         * @description: Processes the page, 
         * and displays depending on the 
         * action specified in the uri.
         * ----------------------------------
         **/
        public function process()
        {
            //Do Script:
            //-----------------------------------
            //Get the action from the current URI
    		$action = $this->uri->segment(3);
    		//Run a switch for the current action.
    		switch($action)
    		{
                //ACTION: Edit:
    			//---------------------------------
    		    case 'edit':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_users'))
                    {
                        return false;
                    }
                    else
                    {
                        $data = null;
                        $userid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
                        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Set the where clause
        				    $this->db->where('id', $userid);
                            //Setup the database array
        				    $dbarray = array('username' => $this->input->post('username'),
                                             'email'    => $this->input->post('email'),
                                             'groupid'  => $this->input->post('groupid'),
                                             'signature'=> $this->input->post('signature'),
                                             'location' => $this->input->post('location'),
                                             'twitter'  => $this->input->post('twitter'),
                                             'facebook' => $this->input->post('facebook'),
                                             'youtube'  => $this->input->post('youtube'),
                                             'skype'    => $this->input->post('skype'),
                                             'suspended'=> $this->input->post('suspended'));
                            //Do the update query
                            $this->db->update('users', $dbarray);
                            //Log the action:
                            $this->log->staff('Edit User', 'Update UserID: ' . $userid);
                            //Set a success message
                            $data["msg"] = "Updated successfully.";
        				}
                        //Get the users from the database
                        $uq = $this->db->query("SELECT * FROM users WHERE id = '" . $userid . "'");
                        $data["user"] = $uq->result_array();
                        //Get the usergroups from the database
                        $ugq = $this->db->query("SELECT * FROM usergroups WHERE id != '0' ORDER BY static DESC");
                        $data["usergroups"] = $ugq->result_array();
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/users/edit.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: View Banned Users:
    			//---------------------------------
                case 'ban':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_users'))
                    {
                        return false;
                    }
                    else
                    {
                        $banned = $this->db->query("SELECT * FROM banned ORDER BY id DESC");
                        $data["bans"] = $banned->result_array();
                        $this->load->view($this->admin_template_dir . "pages/users/ban.php", $data);
                        return true;
                    }
                    break;
                    
                case 'addban':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_users'))
                    {
                        return false;
                    }
                    else
                    {
                        $data = null;
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('value', 'Value', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Set the search type
                            $search_type = $this->input->post('search_type');
                            //Get the value
                            $value = $this->input->post('value');
                            $bq = $this->db->query("SELECT * FROM banned WHERE " . $search_type . " = '" . $value . "'");
                            if($bq->num_rows() < 1)
                            {
                                //The ban does NOT exist
                                switch ($search_type)
                                {
                                    case 'userid':
                                        $uq = $this->db->query("SELECT * FROM users WHERE id  ='" . $value . "'");
                                        if($uq->num_rows() >= 1)
                                        {
                                            //The user exists, go ahead with ban
                                            $dbarray = array('userid' => $value,
                                                             'reason' => $this->input->post('reason'),
                                                             'lift_date' => $this->input->post('lift_date'));
                                            $this->db->insert('banned', $dbarray);
                                            //Log the action:
                                            $this->log->staff('Ban User', 'Banned UserID: ' . $value);
                                            redirect('/administration/users/ban', 'refresh');
                                        }
                                        else
                                        {
                                            $data["error"] = "User does not exist.";
                                        }
                                        break;
                                        
                                    case 'userip':
                                        $dbarray = array('userip' => $value,
                                                         'reason' => $this->input->post('reason'),
                                                         'lift_date' => $this->input->post('lift_date'));
                                        $this->db->insert('banned', $dbarray);
                                        //Log the action:
                                        $this->log->staff('Ban User', 'Banned UserIP: ' . $value);
                                        redirect('/administration/users/ban', 'refresh');
                                        break;
                                }
                            }
                            else
                            {
                                $data["error"] = "Already banned, can not ban twice.";
                            }
                        }
                        $this->load->view($this->admin_template_dir . "pages/users/addban.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Default:
    			//---------------------------------
                default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_users'))
                    {
                        return false;
                    }
                    else
                    {
                        //Set a data variable
                        $data = null;
                        //Set show results as false.
                        $data["show_results"] = false;
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('value', 'Value', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Set show results to true
        				    $data["show_results"] = true;
                            //Set the search type
                            $search_type = $this->input->post('search_type');
                            //Get the value
                            $value = $this->input->post('value');
                            //set the search value to the data array
                            $data["search_value"] = $value;
                            //Get the user information
                            $uq = $this->db->query("SELECT * FROM users WHERE " . $search_type . " LIKE '%" . $value . "%' ORDER BY id ASC");
                            //Set the user information to the data array
                            $data["users"] = $uq->result_array();
                        }
                        //Load the template.
                        $this->load->view($this->admin_template_dir . "pages/users/search.php", $data);
                        return true;
                    }
                    break;
            }
            //-----------------------------------
        }  
    }  
?>