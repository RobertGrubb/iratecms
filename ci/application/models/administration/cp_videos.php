<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_videos extends CI_Model
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
                    if(!$this->acl->perm('can_admin_videos'))
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
                        $this->form_validation->set_rules('source', 'Source', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
    					{	// set a db array for the information
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'source' => $this->input->post('source'));
	    					if($this->db->insert("videos",$dbarray))
	    					{
		    					//Redirect if successful
                                redirect('/administration/videos/', 'refresh');
	    					}
	    					else
	    					{	
	    						//Set the error message for the user
		    					$data['error'] = "Something went wrong with your video.";
	    					}
	    									
    					}
    					 // Load the template
                         $this->load->view('pages/videos/add.php');
                        
                        //------------------------------
                        return true;
                    }
					break;
				//Edit news Action
				case'edit':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_videos'))
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
                        $this->form_validation->set_rules('source', 'Source', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
    					{	
    						//Set the where
    						$this->db->where('id', $newsid);
	    					// set a db array for the information
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'source' => $this->input->post('source'));
	    					if($this->db->update("videos",$dbarray))
	    					{
		    					//Redirect if successful
	                            $data['msg'] = "Update successful!";
	    					}
	    					else
	    					{	
	    						//Set the error message for the user
		    					$data['error'] = "Something went wrong with your video.";
	    					}
    					}
                    	//get the blogs
                    	$this->db->where('id',$newsid);
                    	//get the database
                    	$vq = $this->db->get('videos');
                    	// set the information to an array
                    	$v = $vq->result_array();
                    	//data
                    	$data["v"] = $v[0];
                    	//Load the template
	                    $this->load->view('pages/videos/edit.php', $data);
	                    
                        return true;
                    }
					break;
					
					//Default Action
			    case 'delete':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_videos'))
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
                        $videoid = $this->uri->segment(4);
                        //Get the blogs:
                        $this->db->where('id', $videoid);
                        $vq = $this->db->delete("videos");
                        redirect('/administration/videos/', 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_videos'))
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
                        $videos = $this->db->get("videos");
                        //set the information in a array
                        $data['videos'] = $videos->result_array();
                        //Load the template
                        $this->load->view('pages/videos/videos.php', $data);

                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>