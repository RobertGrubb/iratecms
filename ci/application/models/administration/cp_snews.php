<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_snews extends CI_Model
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
				case'addnews':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_site_news'))
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
    					{	// set a db array for the information
                        
                            if(!empty($_FILES['userfile']['name']))
                            {
                                //Load the upload model.
            				    $this->load->model('upload/files');
                                //If the upload process failed
                                $image = $this->files->process("news");
                            }
                        
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'content' => $this->input->post('content'),
                                             'short_desc' => $this->input->post('short_desc'),
	    									 'authorid' => $this->session->userdata('userid'));
                                             
                            if(!empty($_FILES['userfile']['name']))
                            {
                                $dbarray['image'] = $image;
                            }                 
                                             
                            
	    					if($this->db->insert("news",$dbarray))
	    					{
		    					//Redirect if successful
                                redirect('/administration/snews/', 'refresh');
	    					}
	    					else
	    					{	
	    						//Set the error message for the user
		    					$data['error'] = "Something went wrong with your post.";
	    					}
	    									
    					}
    					 // Load the template
                         $this->load->view('pages/snews/addnews.php');
                        
                        //------------------------------
                        return true;
                    }
					break;
				//Edit news Action
				case'edit':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_site_news'))
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
                                $image = $this->files->process("news");
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
                                             
                                             
	    					if($this->db->update("news",$dbarray))
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
                    	//get the news
                    	$this->db->where('id',$newsid);
                    	//get the database
                    	$nq = $this->db->get('news');
                    	// set the information to an array
                    	$n = $nq->result_array();
                    	//data
                    	$data["n"] = $n[0];
                    	//Load the template
	                    $this->load->view('pages/snews/edit.php', $data);
	                    
                        return true;
                    }
					break;
					
					//Default Action
			    case 'delete':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_site_news'))
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
                        $newsid = $this->uri->segment(4);
                        //Get the news:
                        $this->db->where('id', $newsid);
                        $nq = $this->db->delete("news");
                        redirect('/administration/snews/', 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_site_news'))
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
                        $this->db->order_by('date','desc');
                        //Get the information from the news table
                        $site_news = $this->db->get("news");
                        //set the information in a array
                        $data['news'] = $site_news->result_array();
                        //Load the template
                        $this->load->view('pages/snews/snews.php', $data);

                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>