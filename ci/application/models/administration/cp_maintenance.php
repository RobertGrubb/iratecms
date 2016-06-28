<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_maintenance extends CI_Model
    {
        
        public function process()
        {
            //Get the current action:
			$action = $this->uri->segment(3);
			//set a data array
			$data   = null;
            //Run a switch for the action
            //------------------------------------------
			switch($action)
			{
                //Action: phpinfo
                case 'phpinfo':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
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
                        $this->load->view($this->admin_template_dir . "pages/maintenance/phpinfo.php");
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //Action: cpnav
                case 'cpnav':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
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
                        $nsq = $this->db->query("SELECT * FROM acp_nav_sections ORDER BY orderid ASC");
                        $nsf = $nsq->result_array();
                        foreach($nsf as $key => $row)
        				{
        					//Get the forum information
                            $this->db->where('secid', $row['id']);
                            $this->db->order_by('orderid', "ASC");
        					$nlq = $this->db->get("acp_nav_links");
        					//Set the forum information to an array
        					$row["links"]  = $nlq->result_array();
        					//Push the array into the category array.
        					$nsf[$key] = $row;
        				}
        				//Push information into the data array.
        				$data["navs"] = $nsf;
                        $this->load->view($this->admin_template_dir . "pages/maintenance/cpnav.php", $data);
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //ACTION: Add a section:
    			//---------------------------------
                case 'addcpnav':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
                    {
                        return false;
                    }
                    else
                    {
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('perms', 'Permission', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'perms'  => $this->input->post('perms'));
                            //Do the insertion
                            if($this->db->insert('acp_nav_sections', $dbarray))
                            {
                                ob_start();
                                //Refresh the navigation.
                                echo "<script>window.open('" . settings('site_url') . "index.php/" . settings('admin_dir') . "navigation/', 'nav-frame');</script>";
                                //redirect the user 
                                redirect('/administration/maintenance/cpnav/', 'refresh');
                            } 
                            //If not successful
                            else
                            {
                                //return an error
                                $data["error"] = "Something went wrong.";
                            }
                        }
                        //load the template
                        $this->load->view($this->admin_template_dir . "pages/maintenance/addcpnav.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Edit a Link:
    			//---------------------------------
                case 'editcplink':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
                    {
                        return false;
                    }
                    else
                    {
                        $linkid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('action', 'Action', 'required');
                        $this->form_validation->set_rules('perms', 'Permission', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'action'  => $this->input->post('action'),
                                             'sub_action' => $this->input->post('sub_action'),
                                             'perms' => $this->input->post('perms'));
                            //Setup the where clause
                            $this->db->where('id', $linkid);
                            //Do the update
                            if($this->db->update('acp_nav_links', $dbarray))
                                //if successful, return a message
                                $data["msg"] = "Updated Succesfully.";
                            //if not successful
                            else
                                //return an error.
                                $data["error"] = "Something went wrong.";
                                
                            //Refresh the navigation.
                            echo "<script>window.open('" . settings('site_url') . "index.php/" . settings('admin_dir') . "navigation/', 'nav-frame');</script>";
                        }
                        //Get the Navigation Links from the database
                        $lq = $this->db->query("SELECT * FROM acp_nav_links WHERE id = '" . $linkid . "'");
                        $lf = $lq->result_array();
                        //Set the information to a data variable
                        $data["link"] = $lf[0];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/maintenance/editcplink.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Edit Section:
    			//---------------------------------
                case 'editcpsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
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
                        $this->form_validation->set_rules('perms', 'Permission', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup the database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'perms'  => $this->input->post('perms'));
                            //Set the where clause
                            $this->db->where('id', $secid);
                            //Do the update
                            if($this->db->update('acp_nav_sections', $dbarray))
                                //If successful, return a message
                                $data["msg"] = "Updated Succesfully.";
                            //If failed
                            else
                                //return a error
                                $data["error"] = "Something went wrong.";
                                
                            //Refresh the navigation.
                            echo "<script>window.open('" . settings('site_url') . "index.php/" . settings('admin_dir') . "navigation/', 'nav-frame');</script>";
                        }
                        //Get the navigation sections from the database
                        $sq = $this->db->query("SELECT * FROM acp_nav_sections WHERE id = '" . $secid . "'");
                        $sf = $sq->result_array();
                        //Set the information to the data variable
                        $data["section"] = $sf[0];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/maintenance/editcpsection.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Add a Link:
    			//---------------------------------
                case 'addcplink':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
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
                        $this->form_validation->set_rules('action', 'Action', 'required');
                        $this->form_validation->set_rules('perms', 'Permission', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'),
                                             'action'  => $this->input->post('action'),
                                             'sub_action' => $this->input->post('sub_action'),
                                             'perms' => $this->input->post('perms'),
                                             'secid' => $secid);
                            //do the insertion
                            if($this->db->insert('acp_nav_links', $dbarray))
                            {
                                //Fix the Header Problem:
                                ob_start();
                                //Refresh the navigation.
                                echo "<script>window.open('" . settings('site_url') . "index.php/" . settings('admin_dir') . "navigation/', 'nav-frame');</script>";
                                //redirect the user 
                                redirect('/administration/maintenance/cpnav/', 'refresh');
                            }
                            //if not successful
                            else
                            {
                                //display an error
                                $data["error"] = "Something went wrong.";
                            }  
                        }
                        //display the template
                        $this->load->view($this->admin_template_dir . "pages/maintenance/addcplink.php", $data);
                    }
                    break;
                    
                //ACTION: Delete a Link:
    			//---------------------------------
                case 'deletecplink':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the link id from the uri
                        $linkid = $this->uri->segment(4);
                        //Delete the link from the database
                        $this->db->query("DELETE FROM acp_nav_links WHERE id = '" . $linkid . "'");
                        //Redirect the user to the navigation page.
                        //Fix the Header Problem:
                        ob_start();
                        //Refresh the navigation.
                        echo "<script>window.open('" . settings('site_url') . "index.php/" . settings('admin_dir') . "navigation/', 'nav-frame');</script>";
                        //redirect the user 
                        redirect('/administration/maintenance/cpnav/', 'refresh');
                        return true;
                    }
                    break;
                    
                //ACTION: Delete a section:
    			//---------------------------------
                case 'deletecpsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the section id from the uri
                        $secid = $this->uri->segment(4);
                        //Delete the section from the database
                        $this->db->query("DELETE FROM acp_nav_links WHERE secid = '" . $secid . "'");
                        $this->db->query("DELETE FROM acp_nav_sections WHERE id = '" . $secid . "'");
                        ob_start();
                        //Refresh the navigation.
                        echo "<script>window.open('" . settings('site_url') . "index.php/" . settings('admin_dir') . "navigation/', 'nav-frame');</script>";
                        //redirect the user 
                        redirect('/administration/maintenance/cpnav/', 'refresh');
                        return true;
                    }
                    break;
                    
                //ACTION: Re-order the sections:
    			//---------------------------------
                case 'cpnavsecorder':
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
    						$query = $this->db->query("UPDATE acp_nav_sections SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;
                    
                //ACTION: Re-order Links:
    			//---------------------------------
                case 'cplinkorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
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
    						$query = $this->db->query("UPDATE acp_nav_links SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break; 
             
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_maintenance'))
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
                        
                        
                        
                        //------------------------------
                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>