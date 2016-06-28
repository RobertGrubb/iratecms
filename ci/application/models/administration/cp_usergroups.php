<?php
    /**
     * --------------------------------------
     * @file: cp_usergroups.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the Usergroup
     * Administration.
     * --------------------------------------
     **/
    class cp_usergroups extends CI_Model
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
            $this->log->staff('usergroups', 'Viewed Usergroups');
    		//Get the action from the current URI
    		$action = $this->uri->segment(3);
    		//Run a switch for the current action.
    		switch($action)
    		{
    		    //ACTION: Update the Category Order:
				//------------------------------------------------------
				case 'groupOrder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_usergroups'))
                    {
                        return false;
                    }
                    else
                    {
    					//retrieve the order from the post variable
    					$newOrder = $this->input->post('order');
    					//Go through each re-ordered category
    					foreach(explode(',', $newOrder) as $key => $value)
    					{
    						//Do the update query
    						$query = $this->db->query("UPDATE usergroups SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
					break;
                    
    			//ACTION: Permissions:
    			//---------------------------------
    			case 'permissions':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
        				//Get the GroupID from the URI
        				$groupid = $this->uri->segment(4);
        				//Setup a query for the usergroup
        				$groupq  = $this->db->query("SELECT * FROM usergroups WHERE id = '" . $groupid . "'");
        				//Set the result to an variable array.
        				$groupf  = $groupq->result_array();
        				//If the form was submitted:
        				if($this->input->post('update'))
        				{
        					//Iterate through each permission
        					foreach($this->input->post('perm') as $key => $value)
        					{
        						//Update each permission
        						$this->acl->update_perm($key, $groupid, $value);
        					}
        				}
        				//Get the Permission Sections
        				$sections = $this->db->query("SELECT * FROM perm_sections");
        				//Get the Section Query
        				$sectionq = $sections->result_array();
        				//Ideal way to process the forums within the categories.
        				foreach($sectionq as $key => $row)
        				{
        					//Get the forum information
        					$permq = $this->db->query("SELECT * FROM permissions WHERE secid = '" . $row['id'] . "'");
        					//Set the forum information to an array
        					$row["permissions"]  = $permq->result_array();
        					//Push the array into the category array.
        					$sectionq[$key] = $row;
        				}
        				//Push information into the data array.
        				$data["perms"] = $sectionq;
        				//Set the groupid to the template
        				$data["groupid"] = $groupid;
        				//Set the group title to the template
        				$data["group_title"] = $groupf[0]["title"];
        				//Load the template
        				$this->load->view($this->admin_template_dir . "pages/usergroups/permissions.php", $data);
                        return true;
                    }
    				break;
    
    			//ACTION: Adding a new Usergroup:
    			//---------------------------------
    			case 'addusergroup':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_usergroups'))
                    {
                        return false;
                    }
                    else
                    {
        				//Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        					//Setup a new database array we'll use for the insertion
        					$dbarray = array('title' => $this->input->post('title'),
        									 'static' => 0,
                                             'color' => $this->input->post('color'));
        					//Do the insertion:
        					if($this->db->insert('usergroups', $dbarray))
        					{
        						//If the insertion was successful, get the new id
        						//of the group.
        						$groupid = $this->db->insert_id();
        						//Iterate through each permission, and update them
        						//according to the information we've recieved for 
        						//the new group.
        						foreach($this->input->post('perm') as $key => $value)
        						{
        							//Do the update:
        							$this->acl->update_perm($key, $groupid, $value);
        						}
                                //Log the action:
                                $this->log->staff('Add Usergorup', 'Added Usergroup: ' . $dbarray["title"]);
        						//Redirect the user to the usergroups index page.
        						redirect('/administration/usergroups/', 'refresh');
        					}
        					//If we get here, it means the database insertion
        					//failed.
        					else
        					{
        						//So let's setup an error variable letting them know.
        						$data["error"] = "Database insertion unsuccessful.";
        					}
        				}
        				//Get the Permission Sections
        				$sections = $this->db->query("SELECT * FROM perm_sections");
        				//Get the Section Query
        				$sectionq = $sections->result_array();
        				//Ideal way to process the forums within the categories.
        				foreach($sectionq as $key => $row)
        				{
        					//Get the forum information
        					$permq = $this->db->query("SELECT * FROM permissions WHERE secid = '" . $row['id'] . "'");
        					//Set the forum information to an array
        					$row["permissions"]  = $permq->result_array();
        					//Push the array into the category array.
        					$sectionq[$key] = $row;
        				}
        				//Push information into the data array.
        				$data["perms"] = $sectionq;
        				//Load the template:
        				$this->load->view($this->admin_template_dir . "pages/usergroups/addusergroup.php", $data);
                        return true;
                    }
    				break;
                    
                //ACTION: Edit Usergroup:
    			//---------------------------------
                case 'editusergroup':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_usergroups'))
                    {
                        return false;
                    }
                    else
                    {
                        $groupid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('color', 'Color', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        					//Setup a new database array we'll use for the insertion
        					$dbarray = array('title' => $this->input->post('title'),
                                             'color' => $this->input->post('color'));
                            $this->db->where('id', $groupid);
        					//Do the insertion:
        					if($this->db->update('usergroups', $dbarray))
        					{
        						//Iterate through each permission, and update them
        						//according to the information we've recieved for 
        						//the new group.
        						foreach($this->input->post('perm') as $key => $value)
        						{
        							//Do the update:
        							$this->acl->update_perm($key, $groupid, $value);
        						}
                                //Log the action:
                                $this->log->staff('Edit Usergorup', 'Updated Usergroup: ' . $dbarray["title"]);
                                //Setup a success message
        						$data["msg"] = "Updated Successfully.";
        					}
        					//If we get here, it means the database insertion
        					//failed.
        					else
        					{
        						//So let's setup an error variable letting them know.
        						$data["error"] = "Database update unsuccessful.";
        					}
        				}
                        $gq = $this->db->query("SELECT * FROM usergroups WHERE id = '" . $groupid . "'");
                        $gf = $gq->result_array();
                        $data["usergroup"] = $gf[0];
                        //Get the Permission Sections
        				$sections = $this->db->query("SELECT * FROM perm_sections");
        				//Get the Section Query
        				$sectionq = $sections->result_array();
        				//Ideal way to process the forums within the categories.
        				foreach($sectionq as $key => $row)
        				{
        					//Get the forum information
        					$permq = $this->db->query("SELECT * FROM permissions WHERE secid = '" . $row['id'] . "'");
        					//Set the forum information to an array
        					$row["permissions"]  = $permq->result_array();
        					//Push the array into the category array.
        					$sectionq[$key] = $row;
        				}
        				//Push information into the data array.
        				$data["perms"] = $sectionq;
                        //Load the template:
        				$this->load->view($this->admin_template_dir . "pages/usergroups/editusergroup.php", $data);
                        return true;
                    }
                    break;
                
                //ACTION:: Delete Usergroup
                //---------------------------------    
                case 'deleteusergroup':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_usergroups'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the groupid
                        $groupid = $this->uri->segment(4);
                        //Get the query
                        $uq = $this->db->query("SELECT * FROM users WHERE groupid = '" . $groupid . "'");
                        //Iterate through each user
                        foreach($uq->result_array() as $user)
                        {
                            //Update the user
                            $this->db->query("UPDATE users SET groupid = '1' WHERE id = '" . $user["id"] . "'");
                        }
                        //Delete the usergroup
                        $this->db->query("DELETE FROM usergroups WHERE id = '" . $groupid . "'");
                        //Log the action:
                        $this->log->staff('Delete Usergorup', 'Deleted UsergroupID: ' . $groupid);
                        //Redirect the user
                        redirect('/administration/usergroups/', 'refresh');
                        return true;
                    }
                    break;
                    
                //ACTION:: Perms Manager
                //---------------------------------
                case 'perms':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the Permission Sections
        				$sections = $this->db->query("SELECT * FROM perm_sections");
        				//Get the Section Query
        				$sectionq = $sections->result_array();
        				//Ideal way to process the forums within the categories.
        				foreach($sectionq as $key => $row)
        				{
        					//Get the forum information
        					$permq = $this->db->query("SELECT * FROM permissions WHERE secid = '" . $row['id'] . "'");
        					//Set the forum information to an array
        					$row["permissions"]  = $permq->result_array();
        					//Push the array into the category array.
        					$sectionq[$key] = $row;
        				}
        				//Push information into the data array.
        				$data["perms"] = $sectionq;
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/usergroups/perms.php", $data);
                        return true;
                    }
                    break;
        
                //ACTION:: Add Permission Section
                //---------------------------------
                case 'addpermsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        $data = null;
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup the database array
        				    $dbarray = array('title' => $this->input->post('title'));
                            //Do the insertion   
                            $this->db->insert('perm_sections', $dbarray);
                            //redirect them back to the permissions page.
                            redirect('/administration/usergroups/perms/', 'refresh');
                        }
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/usergroups/addpermsection.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION:: Edit Permission Section
                //---------------------------------
                case 'editpermsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        $secid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup the where clause
        				    $this->db->where('id', $secid);
                            //setup the database array
        				    $dbarray = array('title' => $this->input->post('title')); 
                            //Do the update  
                            $this->db->update('perm_sections', $dbarray);
                            //Setup a variable to show success
                            $data["msg"] = "Updated Successfully.";
                        }
                        //Get the Permission Section Information:
                        $sq = $this->db->query("SELECT * FROM perm_sections WHERE id = '" . $secid . "'");
                        //Set the data to a variable:
                        $sf = $sq->result_array();
                        //Set the section title to a variable the template can use
                        $data["sec_title"] = $sf[0]["title"];
                        //Load the template.
                        $this->load->view($this->admin_template_dir . "pages/usergroups/editpermsection.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION:: Delete Permission Section
                //---------------------------------
                case 'deletepermsection':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the section id from the uri
                        $secid = $this->uri->segment(4);
                        //Delete the permissions for this section
                        $this->db->query("DELETE FROM permissions WHERE secid = '" . $secid . "'");
                        //Then delete the section itself.
                        $this->db->query("DELETE FROM perm_sections WHERE id = '" . $secid . "'");
                        //Redirect the user back to the permissions page.
                        redirect('/administration/usergroups/perms/', 'refresh');
                        return true;
                    }
                    break;
                    
                //ACTION:: Add Permission
                //---------------------------------
                case 'addperm':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the section id from the ur
                        $secid = $this->uri->segment(4);
                        //set the data variable to null by default.
                        $data = null;
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('perm', 'Call Name', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup the database array.
        				    $dbarray = array('title' => $this->input->post('title'),
                                             'perm' => $this->input->post('perm'),
                                             'secid' => $secid,
                                             'usergroups' => "a:0:{}"); 
                            //Do the database insertion.  
                            $this->db->insert('permissions', $dbarray);
                            //Redirect the user back to the permissions page.
                            redirect('/administration/usergroups/perms/', 'refresh');
                        }
                        //Load the template.
                        $this->load->view($this->admin_template_dir . "pages/usergroups/addperm.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION:: Edit Permission
                //---------------------------------
                case 'editperm':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the permission id from the uri
                        $permid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('perm', 'Call Name', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Set the where clause.
        				    $this->db->where('id', $permid);
                            //Setup a database array
        				    $dbarray = array('title' => $this->input->post('title'),
                                             'perm' => $this->input->post('perm')); 
                            //Do the update  
                            $this->db->update('permissions', $dbarray);
                            //Setup a variable that holds the success message.
                            $data["msg"] = "Updated Successfully.";
                        }
                        //Get the Permission Information
                        $pq = $this->db->query("SELECT * FROM permissions WHERE id = '" . $permid . "'");
                        //Set the information to a variable
                        $pf = $pq->result_array();
                        //Set the template variable for title
                        $data["perm_title"] = $pf[0]["title"];
                        //Set the template variable for the call title.
                        $data["perm_call"]  = $pf[0]["perm"];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/usergroups/editperm.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION:: Delete Permission
                //---------------------------------
                case 'deleteperm':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_permissions'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the Permission ID:
                        $permid = $this->uri->segment(4);
                        //Delete the permission from the database
                        $this->db->query("DELETE FROM permissions WHERE id = '" . $permid . "'");
                        //Redirect the user back to the permissions page.
                        redirect('/administration/usergroups/perms/', 'refresh');
                        return true;
                    }
                    break;
    
    			//DEFAULT ACTION:
    			//---------------------------------
    			default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_usergroups'))
                    {
                        return false;
                    }
                    else
                    {
        				//Setup a query for the usergroups loop.
        				$query = $this->db->query("SELECT * FROM usergroups ORDER BY orderid ASC");
        				//Set the information to a template variable:
        				$data["usergroups"] = $query->result_array();
        				//Load the template.
        				$this->load->view($this->admin_template_dir . "pages/usergroups/usergroups.php", $data);
                        return true;
                    }
    				break;
    		}
            //-----------------------------------
        }  
    }  
?>