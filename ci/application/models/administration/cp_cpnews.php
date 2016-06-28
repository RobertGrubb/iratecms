<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_cpnews extends CI_Model
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
                //Default Action
			    case 'edit':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_cpnews'))
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
                        //Set Validation Rules:
    					//-----------------------------------------------
    					$this->form_validation->set_rules('title', 'Title', 'required');
                        $this->form_validation->set_rules('content', 'Content', 'required');
    					//-----------------------------------------------
                        //If we are running the form validation
                        //and it's valid:
                        if($this->form_validation->run())
    					{
    					    //Setup the where clause
    					    $this->db->where("id", $newsid);
                            //Setup a db array with the needed information:
    					    $dbarray = array('title' => $this->input->post('title'),
                                             'content' => $this->input->post('content'),
                                             'userid' => $this->session->userdata('userid'));
                            //Do the update
                            $this->db->update("acp_news", $dbarray);
                            //Setup a success message.
                            $data["msg"]   = "Updated successfully";  
                        }
                        //Get the admin news:
                        $this->db->where('id', $newsid);
                        $nq = $this->db->get("acp_news");
                        $n  = $nq->result_array();
                        $data["n"] = $n[0];
                        $this->load->view($this->admin_template_dir . "pages/cpnews/edit.php", $data);
                        //------------------------------
                        return true;
                    }
                    break; 
                    
                //ACTION: New Document:
    			//---------------------------------
                case 'addnews':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_cpnews'))
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
                                             'userid' => $this->session->userdata('userid'));
                            //Do the insertion
                            if($this->db->insert("acp_news", $dbarray))
                                //Redirect if successful
                                redirect('/administration/cpnews/', 'refresh');
                            //If not successful
                            else
                                //Set an error.
                                $data["error"] = "Something went wrong."; 
                        }
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/cpnews/addnews.php", $data);
                        return true;
                    }
                    break;
                    
                //Default Action
			    case 'delete':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_cpnews'))
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
                        //Get the admin news:
                        $this->db->where('id', $newsid);
                        $nq = $this->db->delete("acp_news");
                        redirect('/administration/cpnews/', 'refresh');
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_cpnews'))
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
                        //Get the admin news:
                        $this->db->order_by('date', 'desc');
                        $acp_news = $this->db->get("acp_news");
                        $data["news"] = $acp_news->result_array();
                        $this->load->view($this->admin_template_dir . "pages/cpnews/cpnews.php", $data);
                        //------------------------------
                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>