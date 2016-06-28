<?php
    /**
     * --------------------------------------
     * @file: cp_pages.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the pages
     * Administration.
     * --------------------------------------
     **/
    class cp_pages extends CI_Model
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
            //Get the Current action
			$action = $this->uri->segment(3);
            //Setup a data variable
            $data   = null;
            //Create a switch for each action
            switch ($action)
            {
                //ACTION: Edit a Document:
    			//---------------------------------
                case 'editpage':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_pages'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the page id
                        $pageid = $this->uri->segment(4);
                        //Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('callname', 'Call Name', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
    					//-----------------------------------------------
                        //If we are running the form validation
                        //and it's valid:
                        if($this->form_validation->run())
    					{
    					    //Setup the where clause
    					    $this->db->where("id", $pageid);
                            //Setup a db array with the needed information:
    					    $dbarray = array('title' => $this->input->post('title'),
                                             'callname' => $this->input->post('callname'),
                                             'content' => $this->input->post('content'),
                                             'comments' => $this->input->post('comments'),
                                             'template' => $this->input->post('template'));
                            //Do the update
                            $this->db->update("pages", $dbarray);
                            //Setup a success message.
                            $data["msg"]   = "Updated successfully";  
                        }
                        //Get the pages
                        $pq = $this->db->query("SELECT * FROM pages WHERE id = '" . $pageid . "'");
                        $pf = $pq->result_array();
                        //Set the information to a variable
                        $data["page"] = $pf[0];
                        //Show the template
                        $this->load->view($this->admin_template_dir . "pages/pages/editpage.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: New Page:
    			//---------------------------------
                case 'newpage':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_pages'))
                    {
                        return false;
                    }
                    else
                    {
                        //Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('callname', 'Call Name', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
    					//-----------------------------------------------
                        //If we are running the form validation
                        //and it's valid:
                        if($this->form_validation->run())
    					{
    					    //Setup a db array with the needed information:
    					    $dbarray = array('title' => $this->input->post('title'),
                                             'callname' => $this->input->post('callname'),
                                             'content' => $this->input->post('content'),
                                             'comments' => $this->input->post('comments'),
                                             'template' => $this->input->post('template'));
                            //Do the insertion
                            if($this->db->insert("pages", $dbarray))
                                //Redirect if successful
                                redirect('/administration/pages/', 'refresh');
                            //If not successful
                            else
                                //Set an error.
                                $data["error"] = "Something went wrong."; 
                        }
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/pages/newpage.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Delete a page:
    			//---------------------------------
                case 'deletepage':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_pages'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the page id
                        $pageid = $this->uri->segment(4);
                        //Do the deletion
    					$this->db->query("DELETE FROM pages WHERE id = '" . $pageid . "'");
                        //Redirect the user
    					redirect('/administration/pages/', 'refresh');
                        return true;
                    }
                    break;
                    
                //ACTION: Default:
    			//---------------------------------
                default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_pages'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the pages
                        $pq = $this->db->query("SELECT * FROM pages ORDER BY id ASC");
                        //Set the information to a variable
                        $data["pages"] = $pq->result_array();
                        //Show the template
                        $this->load->view($this->admin_template_dir . "pages/pages/pages.php", $data);
                        return true;
                    }
                    break;
            }
            //-----------------------------------
        }  
    }  
?>