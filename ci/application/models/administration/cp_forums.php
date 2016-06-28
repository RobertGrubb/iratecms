<?php
    /**
     * --------------------------------------
     * @file: cp_forums.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the Forums
     * Administration.
     * --------------------------------------
     **/
    class cp_forums extends CI_Model
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
            //Get the current action:
			$action = $this->uri->segment(3);
			//set a data array
			$data   = null;
			//Run a switch for the action
			switch($action)
			{
				//ACTION: Categories:
				//------------------------------------------------------
				case 'categories':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					//Get the categories
    					$cq = $this->db->query("SELECT * FROM categories ORDER BY orderid ASC");
    					//set the information to an array
    					$data["categories"] = $cq->result_array();
    					//Load the template
    					$this->load->view($this->admin_template_dir . "pages/forums/categories.php", $data);
                        return true;
                    }
					break;

				//ACTION: Edit Category:
				//------------------------------------------------------	
				case 'editcategory':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    				    //Get the Category ID
    					$id = $this->uri->segment(4);
    					//Set the ID to the data array.
    					$data["id"] = $id;
    					//Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
    					//-----------------------------------------------
    					if($this->form_validation->run())
    					{
    						//Setup the database array.
    						$dbarray = array('title' => $this->input->post('title'));
    						//Run the update query
    						if($this->db->query("UPDATE categories SET title = '" . $dbarray["title"] . "' WHERE id = '" . $id . "'"))
    							//If successful, set a message
    							$data["msg"]   = "Updated successfully";
    						//If a failed attempt
    						else
    							//Set an error message
    							$data["error"] = "Something went wrong.";
    					}
    					//Get the category information
    					$cq = $this->db->query("SELECT * FROM categories WHERE id = '" . $id . "'");
    					//set the information into the data array
    					$data["category"] = $cq->result_array();
    					//Load the template, and pass the data through.
    					$this->load->view($this->admin_template_dir . "pages/forums/editcategory.php", $data);
                        return true;
                    }
					break;

				//ACTION: Adding a Category:
				//------------------------------------------------------
				case 'addcategory':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					//Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
    					//-----------------------------------------------
    					if($this->form_validation->run())
    					{
    						//Setup the database array.
    						$dbarray = array('title' => $this->input->post('title'));
    						//Run the update query
    						if($this->db->insert('categories', $dbarray))
    							//if success redirect
    							redirect('/administration/forums/categories/', 'refresh');
    						//If a failed attempt
    						else
    							//if error, show the form.
    							$this->load->view($this->admin_template_dir . "pages/forums/addcategory.php", $data);
    					}
    					else
    					{
    						$this->load->view($this->admin_template_dir . "pages/forums/addcategory.php", $data);
    					}
                        return true;
                    }
					break;

				//ACTION: Delete a Category:
				//------------------------------------------------------
				case 'deletecat':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
                        /**
                         * @todo:
                         * Move all forums under this category to a
                         * new location, or delete them depending on
                         * what the user wants to do.
                         **/
                        //Get the category id
    					$catid = $this->uri->segment(4);
                        //Delete the category from the database
    					$this->db->query("DELETE FROM categories WHERE id = '" . $catid . "'");
                        //Redirect the user
    					redirect('/administration/forums/categories/', 'refresh');
                        return true;
                    }
					break;
                    
                case 'catperms':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the category id
    					$cid = $this->uri->segment(4);
                        //If we are updating:
    					if($this->input->post('update'))
    					{
    					    //Setup a new array for the new gorups
    						$newgroups = array();
                            //Go through each group from the post variable
    						foreach($this->input->post('groups') as $key => $value)
    						{
    						    //If the value is true
    							if($value == "true")
                                    //Add it to the new array
    								$newgroups[] = $key;
    						}
                            //Update the access for the categories
    						if($this->acl->update_access("categories", $cid, $newgroups))
                                //If successful, set a message for it
    							$data["msg"] = "Updated Successfully.";
                            //If it failed
    						else
                                //Show an error.
    							$data["error"] = "Update was unsuccessful.";
    					}
    					//Get the category information
    					$cq = $this->db->query("SELECT * FROM categories WHERE id = '" . $cid . "'");
    					//set the information into the data array
    					$data["cats"] = $cq->result_array();
    					//Get the Permission Sections
    					$usergroupq = $this->db->query("SELECT * FROM usergroups ORDER BY static DESC");
    					//Get the Section Query
    					$usergroups = $usergroupq->result_array();
    					//Push information into the data array.
    					$data["usergroups"] = $usergroups;
    					//Load the template
    					$this->load->view($this->admin_template_dir . "pages/forums/catperms.php", $data);
                        return true;
                    }
					break;

				//ACTION: View Forums:
				//------------------------------------------------------	
				case 'forums':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					//Get the Category information
    					$cq = $this->db->query("SELECT * FROM categories ORDER BY orderid ASC");
    					$cf = $cq->result_array();
    					//Ideal way to process the forums within the categories.
    					foreach($cf as $key => $row)
    					{
    						//Get the forum information
    						$fq = $this->db->query("SELECT * FROM forums WHERE catid = '" . $row['id'] . "' ORDER BY orderid ASC");
    						//Set the forum information to an array
    						$row["forums"]  = $fq->result_array();
    						//Push the array into the category array.
    						$cf[$key] 	    = $row;
    					}
    					//Push information into the data array.
    					$data["categories"] = $cf;
    					//Load the template
    					$this->load->view($this->admin_template_dir . "pages/forums/forums.php", $data);
                        return true;
                    }
					break;

				//ACTION: Adding a Forum:
				//------------------------------------------------------
				case 'addforum':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					$catid = $this->uri->segment(4);
    					$data["catid"] = $catid;
    					//Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
    					$this->form_validation->set_rules('desc', 'Description', 'required');
    					//-----------------------------------------------
    					if($this->form_validation->run())
    					{
    						//Setup the database array.
    						$dbarray = array('title' => $this->input->post('title'),
    										 'desc'  => $this->input->post('desc'),
    										 'catid' => $catid);
    						//Run the update query
    						if($this->db->insert('forums', $dbarray))
    							//if success redirect
    							redirect('/administration/forums/forums/', 'refresh');
    						//If a failed attempt
    						else
    							//if error, show the form.
    							$this->load->view($this->admin_template_dir . "pages/forums/addforum.php", $data);
    					}
    					else
    					{
    						$this->load->view($this->admin_template_dir . "pages/forums/addforum.php", $data);
    					}
                        return true;
                    }
					break;

				//ACTION: Deleting a Forum:
				//------------------------------------------------------
				case 'deleteforum':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
                        /**
                         * @todo:
                         * Move threads to a new location, or delete
                         * them depending on the users specifications.
                         **/
                        //Get the forum ID from the URI
    					$fid = $this->uri->segment(4);
                        //Delete the forums from the database
    					$this->db->query("DELETE FROM forums WHERE id = '" . $fid . "'");
                        //Redirect the user
    					redirect('/administration/forums/forums/', 'refresh');
                        return true;
                    }
					break;

				//ACTION: Editing a Forum:
				//------------------------------------------------------
				case 'editforum':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the Forum ID from the URI
    					$fid = $this->uri->segment(4);
                        //Set the ID to a data array
    					$data["fid"] = $fid;
    					//Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
    					$this->form_validation->set_rules('desc', 'Description', 'required');
    					//-----------------------------------------------
    					if($this->form_validation->run())
    					{
    						//Setup the database array.
    						$dbarray = array('title' => $this->input->post('title'),
    										 'desc'  => $this->input->post('desc'));
    						//Run the update query
    						if($this->db->query("UPDATE `forums` SET `title` = '" . $dbarray["title"] . "', 
    							        `desc` = '" . $dbarray["desc"] . "' WHERE `id` = '" . $fid . "'"))
    							//If successful, set a message
    							$data["msg"]   = "Updated successfully";
    						//If a failed attempt
    						else
    							//Set an error message
    							$data["error"] = "Something went wrong.";
    					}
    					//Get the category information
    					$fq = $this->db->query("SELECT * FROM forums WHERE id = '" . $fid . "'");
    					//set the information into the data array
    					$data["forum"] = $fq->result_array();
    					//Load the template
    					$this->load->view($this->admin_template_dir . "pages/forums/editforum.php", $data);
                        return true;
                    }
					break;

                //ACTION: Edit Forum permissions:
    			//---------------------------------
				case 'forumperms':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					//Get the GroupID from the URI
    					$fid = $this->uri->segment(4);
    					if($this->input->post('update'))
    					{
    						$newgroups = array();
    						foreach($this->input->post('groups') as $key => $value)
    						{
    							if($value == "true")
    								$newgroups[] = $key;
    						}
    						if($this->acl->update_access("forums", $fid, $newgroups))
    							$data["msg"] = "Updated Successfully.";
    						else
    							$data["error"] = "Update was unsuccessful.";
    					}
    					//Get the category information
    					$fq = $this->db->query("SELECT * FROM forums WHERE id = '" . $fid . "'");
    					//set the information into the data array
    					$data["forums"] = $fq->result_array();
    					//Get the Permission Sections
    					$usergroupq = $this->db->query("SELECT * FROM usergroups ORDER BY static DESC");
    					//Get the Section Query
    					$usergroups = $usergroupq->result_array();
    					//Push information into the data array.
    					$data["usergroups"] = $usergroups;
    					//Load the template
    					$this->load->view($this->admin_template_dir . "pages/forums/forumperms.php", $data);
                        return true;
                    }
					break;

				//ACTION: Update the Forums Order:
				//------------------------------------------------------
				case 'forumOrder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					//retrieve the order from the post variable
    					$newOrder = $this->input->post('order');
    					//Go through each re-ordered forum
    					foreach(explode(',', $newOrder) as $key => $value)
    					{
    						//Do the update query.
    						$query = $this->db->query("UPDATE forums SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
					break;

				//ACTION: Update the Category Order:
				//------------------------------------------------------
				case 'catOrder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
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
    						$query = $this->db->query("UPDATE categories SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
					break;
					
				//DEFAULT ACTION:
				//------------------------------------------------------
				default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_forums'))
                    {
                        return false;
                    }
                    else
                    {
    					//Show a 404 message.
    					show_404('administration/forums/');
                    }
					break;
			}
            //-----------------------------------
        }  
    }  
?>