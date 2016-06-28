<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_blogs extends CI_Model
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
				//Addnews Action
				case'add':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_blogs'))
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
                        //Set Validation Rules:
                        $this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
    					{	if(!empty($_FILES['userfile']['name']))
                            {
                                //Load the upload model.
            				    $this->load->model('upload/files');
                                //If the upload process failed
                                $image = $this->files->process("blogs");
                            }
                        
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'content' => $this->input->post('content'),
                                             'short_desc' => $this->input->post('short_desc'),
	    									 'authorid' => $this->session->userdata('userid'));
                                             
                            if(!empty($_FILES['userfile']['name']))
                            {
                                $dbarray['image'] = $image;
                            }  
	    					if($this->db->insert("blogs",$dbarray))
	    					{
		    					//Redirect if successful
                                redirect('/administration/blogs/', 'refresh');
	    					}
	    					else
	    					{	
	    						//Set the error message for the user
		    					$data['error'] = "Something went wrong with your post.";
	    					}
	    									
    					}
    					 // Load the template
                         $this->load->view('pages/blogs/add.php');
                        
                        //------------------------------
                        return true;
                    }
					break;
				//Edit news Action
				case'edit':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_blogs'))
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
                    	//Get the uri segment
                    	$newsid = $this->uri->segment(4);
                    	//Set Validation Rules:
                        $this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
    					{	
    					   
                            if(!empty($_FILES['userfile']['name']))
                            {
                                //Load the upload model.
            				    $this->load->model('upload/files');
                                //If the upload process failed
                                $image = $this->files->process("blogs");
                            }
                                                       
    						//Set the where
    						$this->db->where('id', $newsid);
	    					// set a db array for the information
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'content' => $this->input->post('content'),
                                             'short_desc' => $this->input->post('short_desc'),
	    									 'authorid' => $this->session->userdata('userid'));
                                             
                            if(!empty($_FILES['userfile']['name']))
                            {
                                $dbarray['image'] = $image;
                            }                  
                                             
	    					if($this->db->update("blogs",$dbarray))
	    					{
		    					//Redirect if successful
	                            $data['msg'] = "Update successful!";
	    					}
	    					else
	    					{	
	    						//Set the error message for the user
		    					$data['error'] = "Something went wrong with your post.";
	    					}
    					}
                    	//get the blogs
                    	$this->db->where('id',$newsid);
                    	//get the database
                    	$bq = $this->db->get('blogs');
                    	// set the information to an array
                    	$b = $bq->result_array();
                    	//data
                    	$data["b"] = $b[0];
                    	//Load the template
	                    $this->load->view('pages/blogs/edit.php', $data);
	                    
                        return true;
                    }
					break;
					
					//Default Action
			    case 'delete':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_blogs'))
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
                        $blogid = $this->uri->segment(4);
                        //Get the blogs:
                        $this->db->where('id', $blogid);
                        $bq = $this->db->delete("blogs");
                        redirect('/administration/blogs/', 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_blogs'))
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
                        //order the info that is being pulled
                        $this->db->order_by('id','desc');
                        //Get the information from the blogs table
                        $blogs = $this->db->get("blogs");
                        //set the information in a array
                        $data['blogs'] = $blogs->result_array();
                        //Load the template
                        $this->load->view('pages/blogs/blogs.php', $data);

                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>