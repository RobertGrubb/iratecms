<?php
    /**
     * --------------------------------------
     * @file: cp_sitenav.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the Site Navigation
     * Administration.
     * --------------------------------------
     **/
    class cp_sitenav extends CI_Model
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
            //Setup a data variable.
            $data   = null;
            //Run a switch for the current action.
            switch($action)
            {
                    
                //ACTION: Add a section:
    			//---------------------------------
                case 'addsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('href', 'Location', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'href'  => $this->input->post('href'));
                            //Do the insertion
                            if($this->db->insert('nav_sections', $dbarray))
                                //if successful, redirect the user
                                redirect('/administration/sitenav/', 'refresh');
                            //If not successful
                            else
                                //return an error
                                $data["error"] = "Something went wrong.";
                        }
                        //load the template
                        $this->load->view($this->admin_template_dir . "pages/sitenav/sitenav_addsection.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Add a Link:
    			//---------------------------------
                case 'addlink':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //get the section id from the uri
                        $secid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('href', 'Location', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'href'  => $this->input->post('href'),
                                             'secid' => $secid);
                            //do the insertion
                            if($this->db->insert('nav_links', $dbarray))
                                //redirect the user 
                                redirect('/administration/sitenav/', 'refresh');
                            //if not successful
                            else
                                //display an error
                                $data["error"] = "Something went wrong.";
                        }
                        //display the template
                        $this->load->view($this->admin_template_dir . "pages/sitenav/sitenav_addlink.php", $data);
                    }
                    break;
                    
                //ACTION: Edit a Link:
    			//---------------------------------
                case 'editlink':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        $linkid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('href', 'Location', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup a database array
        				    $dbarray = array('title' => $this->input->post('title'),
                                             'href'  => $this->input->post('href'));
                            //Setup the where clause
                            $this->db->where('id', $linkid);
                            //Do the update
                            if($this->db->update('nav_links', $dbarray))
                                //if successful, return a message
                                $data["msg"] = "Updated Succesfully.";
                            //if not successful
                            else
                                //return an error.
                                $data["error"] = "Something went wrong.";
                        }
                        //Get the Navigation Links from the database
                        $lq = $this->db->query("SELECT * FROM nav_links WHERE id = '" . $linkid . "'");
                        $lf = $lq->result_array();
                        //Set the information to a data variable
                        $data["link"] = $lf[0];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/sitenav/sitenav_editlink.php", $data);
                        return true;
                    }
                    break;
                
                //ACTION: Delete a Link:
    			//---------------------------------
                case 'deletelink':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the link id from the uri
                        $linkid = $this->uri->segment(4);
                        //Delete the link from the database
                        $this->db->query("DELETE FROM nav_links WHERE id = '" . $linkid . "'");
                        //Redirect the user to the navigation page.
                        redirect('/administration/sitenav', 'refresh');
                        return true;
                    }
                    break;
                    
                //ACTION: Edit Section:
    			//---------------------------------
                case 'editsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the section id from the uri
                        $secid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('href', 'Location', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup the database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'href'  => $this->input->post('href'));
                            //Set the where clause
                            $this->db->where('id', $secid);
                            //Do the update
                            if($this->db->update('nav_sections', $dbarray))
                                //If successful, return a message
                                $data["msg"] = "Updated Succesfully.";
                            //If failed
                            else
                                //return a error
                                $data["error"] = "Something went wrong.";
                        }
                        //Get the navigation sections from the database
                        $sq = $this->db->query("SELECT * FROM nav_sections WHERE id = '" . $secid . "'");
                        $sf = $sq->result_array();
                        //Set the information to the data variable
                        $data["section"] = $sf[0];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/sitenav/sitenav_editsection.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Delete a section:
    			//---------------------------------
                case 'deletesection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the section id from the uri
                        $secid = $this->uri->segment(4);
                        //Delete the section from the database
                        $this->db->query("DELETE FROM nav_sections WHERE id = '" . $secid . "'");
                        //Redirect the user to the navigation page.
                        redirect('/administration/sitenav', 'refresh');
                        return true;
                    }
                    break;
                
                //ACTION: Re-order the sections:
    			//---------------------------------
                case 'secorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the new order from the post variable
                        $neworder = $this->input->post('order');
                        //Go through each re-ordered sections
    					foreach(explode(',', $neworder) as $key => $value)
    					{
    						//Do the update query.
    						$query = $this->db->query("UPDATE nav_sections SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;
                    
                //ACTION: Re-order Links:
    			//---------------------------------
                case 'linkorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the new order from the post variable
                        $neworder = $this->input->post('order');
                        //Go through each re-ordered links
    					foreach(explode(',', $neworder) as $key => $value)
    					{
    						//Do the update query.
    						$query = $this->db->query("UPDATE nav_links SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;   
                    
                //ACTION: Default:
    			//---------------------------------
                default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_navigation'))
                    {
                        return false;
                    }
                    else
                    {
                        //Setup a data variable
                        $data = null;
                        $nsq = $this->db->query("SELECT * FROM nav_sections ORDER BY orderid ASC");
                        $nsf = $nsq->result_array();
                        foreach($nsf as $key => $row)
        				{
        					//Get the forum information
        					$nlq = $this->db->query("SELECT * FROM nav_links WHERE secid = '" . $row['id'] . "'");
        					//Set the forum information to an array
        					$row["links"]  = $nlq->result_array();
        					//Push the array into the category array.
        					$nsf[$key] = $row;
        				}
        				//Push information into the data array.
        				$data["navs"] = $nsf;
                        //Load the template.
                        $this->load->view($this->admin_template_dir . "pages/sitenav/sitenav.php", $data);
                        return true;
                    }
                    break;
            }  
            //-----------------------------------
        }  
    }  
?>