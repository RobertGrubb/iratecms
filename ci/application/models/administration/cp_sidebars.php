<?php
    /**
     * --------------------------------------
     * @file: cp_sidebars.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the sidebars
     * Administration.
     * --------------------------------------
     **/
    class cp_sidebars extends CI_Model
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
            //Get the current action
		    $action = $this->uri->segment(3);
            //setup a data variable
            $data   = null;
            //Create a switch for the action
            switch($action)
            {
                    
                //ACTION: Sidebar Re-Order:
    			//---------------------------------    
                case 'reorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_sidebars'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the new order from the post variable
                        $neworder = $this->input->post('order');
                        //Go through each re-ordered widgets
    					foreach(explode(',', $neworder) as $key => $value)
    					{
    						//Do the update query.
    						$query = $this->db->query("UPDATE sidebars SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;


                //Default Action
                case 'edit':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_sidebars'))
                    {
                        //Return false so the admin
                        //file can handle the permission
                        //error.
                        return false;
                    }
                    //If the user does have permission,
                    //run the following code:
                    else
                    {
                        //Do Script Here
                        //------------------------------
                        $sidebarid = $this->uri->segment(4);
                        //Set Validation Rules:
                        //-----------------------------------------------
                        $this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
                        $this->form_validation->set_rules('enabled', 'Enabled', 'required');
                        //-----------------------------------------------
                        //If we are running the form validation
                        //and it's valid:
                        if($this->form_validation->run())
                        {
                            //Setup the where clause
                            $this->db->where("id", $sidebarid);
                            //Setup a db array with the needed information:
                            $dbarray = array('title' => $this->input->post('title'),
                                             'content' => $this->input->post('content'),
                                             'enabled' => $this->input->post('enabled'));
                            //Do the update
                            $this->db->update("sidebars", $dbarray);
                            //Setup a success message.
                            $data["msg"]   = "Updated successfully";  
                        }
                        //Get the admin news:
                        $this->db->where('id', $sidebarid);
                        $sq = $this->db->get("sidebars");
                        $s  = $sq->result_array();
                        $data["s"] = $s[0];
                        $this->load->view($this->admin_template_dir . "pages/sidebars/edit.php", $data);
                        //------------------------------
                        return true;
                    }
                    break; 

                //ACTION: Add:
                //---------------------------------
                case 'add':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_sidebars'))
                    {
                        return false;
                    }
                    else
                    {
                        //Set Validation Rules:
                        //-----------------------------------------------
                        $this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
                        //-----------------------------------------------
                        //If we are running the form validation
                        //and it's valid:
                        if($this->form_validation->run())
                        {
                            //Setup a db array with the needed information:
                            $dbarray = array('title' => $this->input->post('title'),
                                             'content' => $this->input->post('content'),
                                             'enabled' => $this->input->post('enabled'));
                            //Do the insertion
                            if($this->db->insert("sidebars", $dbarray))
                                //Redirect if successful
                                redirect('/administration/sidebars/', 'refresh');
                            //If not successful
                            else
                                //Set an error.
                                $data["error"] = "Something went wrong."; 
                        }
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/sidebars/add.php", $data);
                        return true;
                    }
                    break;

                //Default Action
                case 'delete':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_sidebars'))
                    {
                        //Return false so the admin
                        //file can handle the permission
                        //error.
                        return false;
                    }
                    //If the user does have permission,
                    //run the following code:
                    else
                    {
                        //Do Script Here
                        //------------------------------
                        $sidebarid = $this->uri->segment(4);
                        //Get the admin news:
                        $this->db->where('id', $sidebarid);
                        $nq = $this->db->delete("sidebars");
                        redirect('/administration/sidebars/', 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;

                //ACTION: Default:
                //---------------------------------   
                default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_sidebars'))
                    {
                        return false;
                    }
                    else
                    {
                        $this->db->order_by("orderid", "ASC");
                        $this->db->where("enabled", "1");
                        $sidebars = $this->db->get("sidebars");
                        $sidebars = $sidebars->result_array();
                        $data["sidebars"] = $sidebars;
                        $this->load->view($this->admin_template_dir . "pages/sidebars/sidebars.php", $data);
                        return true;
                    }
                    break;
            }
            //-----------------------------------
        }  
    }  
?>