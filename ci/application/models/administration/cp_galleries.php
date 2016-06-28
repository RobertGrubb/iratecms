<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_galleries extends CI_Model
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
				case'addimages':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                        $this->load->model('upload/files');
                               
                        $galleryid = $this->uri->segment(4);
                       
                        $this->files->upload_gallery_images($galleryid);
                          
    					//Redirect if successful
                        redirect('/administration/galleries/viewgallery/' . $galleryid, 'refresh');
                        
                        //------------------------------
                        return true;
                    }
					break; 
             
             
				//Addnews Action
				case'addgallery':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                        $this->form_validation->set_rules('desc', 'Description', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
    					{	
    					   
                           // set a db array for the information
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'desc' => $this->input->post('desc'));
	    					if($this->db->insert("galleries",$dbarray))
	    					{
	    					      
                                //Upload Images:
                           
                                $this->load->model('upload/files');
                               
                                $galleryid = $this->db->insert_id();
                               
                                $this->files->upload_gallery_images($galleryid);
                                  
		    					//Redirect if successful
                                redirect('/administration/galleries/', 'refresh');
	    					}
	    					else
	    					{	
	    						//Set the error message for the user
		    					$data['error'] = "Something went wrong with your post.";
	    					}
	    									
    					}
    					 // Load the template
                         $this->load->view('pages/galleries/addgallery.php');
                        
                        //------------------------------
                        return true;
                    }
					break;
				//Edit news Action
				case'editgallery':
					//Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                    	$galleryid = $this->uri->segment(4);
                    	//Set Validation Rules:
                        $this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('desc', 'Description', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
    					{	
    						//Set the where
    						$this->db->where('id', $galleryid);
	    					// set a db array for the information
	    					$dbarray = array('title' => $this->input->post('title'),
	    									 'desc' => $this->input->post('desc'));
	    					if($this->db->update("galleries",$dbarray))
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
                    	//get the galleries
                    	$this->db->where('id',$galleryid);
                    	//get the database
                    	$gq = $this->db->get('galleries');
                    	// set the information to an array
                    	$g = $gq->result_array();
                    	//data
                    	$data["g"] = $g[0];
                    	//Load the template
	                    $this->load->view('pages/galleries/editgallery.php', $data);
	                    
                        return true;
                    }
					break;
                    
                    
					
					//Default Action
			    case 'deletegallery':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                        $galleryid = $this->uri->segment(4);
                        //Get the blogs:
                        $this->db->where('id', $galleryid);
                        $bq = $this->db->delete("galleries");
                        $this->db->where('galleryid', $galleryid);
                        $this->db->delete("gallery_images");
                        redirect('/administration/galleries/', 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;
                    
                 case 'deleteimage':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                        $imageid = $this->uri->segment(4);
                        
                        $this->db->where("id", $imageid);
                        $image = $this->db->get("gallery_images");
                        $image = $image->result_array();
                        $image = $image[0];
                        $galleryid = $image["galleryid"];
                        $this->db->where("id", $imageid);
                        $this->db->delete("gallery_images");
                        redirect('/administration/galleries/viewgallery/' . $galleryid, 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;    
                    
                //Default Action
			    case "viewgallery":
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                        $galleryid = $this->uri->segment(4);
                        $data["galleryid"] = $galleryid;
                        $this->db->where("galleryid", $galleryid);
                        //order the info that is being pulled
                        $this->db->order_by('id','desc');
                        //Get the information from the blogs table
                        $images = $this->db->get("gallery_images");
                        //set the information in a array
                        $data['images'] = $images->result_array();
                        //Load the template
                        $this->load->view('pages/galleries/viewgallery.php', $data);

                        return true;
                    }
                    break;     
                    
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_gallery'))
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
                        $galleries = $this->db->get("galleries");
                        //set the information in a array
                        $data['galleries'] = $galleries->result_array();
                        //Load the template
                        $this->load->view('pages/galleries/galleries.php', $data);

                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>