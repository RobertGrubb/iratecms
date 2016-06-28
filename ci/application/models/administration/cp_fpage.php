<?php
    /**
     * --------------------------------------
     * @file: cp_fpage.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the Frontpage
     * Administration.
     * --------------------------------------
     **/
    class cp_fpage extends CI_Model
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
                //ACTION: Slide Manager:
    			//---------------------------------
                case 'slider':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
                    {
                        return false;
                    }
                    //If the user does have access,
                    //run the following code:
                    else
                    {
                        //Setup a order_by clause.
                        $this->db->order_by('orderid', 'ASC');
                        //Get the slides from the database
                        $sq = $this->db->get('fp_slides');
                        //Set the slide information to the data array
                        $data["slides"] = $sq->result_array();
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/fpage/slider.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Add Slide:
    			//---------------------------------
                case 'addslide':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
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
        				    //Load the upload model.
        				    $this->load->model('upload/files');
                            //If the upload process failed
                            if(!$image = $this->files->process("slides"))
                            {
                                //Tell them to upload a valid file.
                                $data["error"] = "Be sure you upload a valid file.";
                            }
                            //If it succeeded:
                            else
                            {
                                //Setup a database array
                                $dbarray = array('title' => $this->input->post('title'),
                                                 'desc'  => $this->input->post('desc'),
                                                 'image' => $image);
                                //Do the insertion
                                if($this->db->insert('fp_slides', $dbarray))
                                    //If successful, redirect them
                                    redirect('/administration/fpage/slider', 'refresh');
                                //If it failed
                                else
                                    //Show a error.
                                    $data["error"] = "Something went wrong.";
                            }
                        }
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/fpage/addslide.php", $data);
                        return true;
                    }
                    break; 
                
                //ACTION: Edit Slide:
    			//---------------------------------    
                case 'editslide':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the slide ID from the uri
                        $slideid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup a database array
        				    $dbarray = array('title' => $this->input->post('title'),
                                             'desc'  => $this->input->post('desc'));
                            //Declare the where clause
                            $this->db->where('id', $slideid);
                            //Do the update
                            $this->db->update('fp_slides', $dbarray);
                            //Set a success message.
                            $data["msg"] = "Updated successfully.";   
                        }
                        //Get the slides from the database
                        $sq = $this->db->query("SELECT * FROM fp_slides WHERE id = '" . $slideid . "'");
                        //Set the slide information to an array
                        $sf = $sq->result_array();
                        //Set the array to a data array
                        $data["slide"] = $sf[0];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/fpage/editslide.php", $data);
                        return true;
                    }
                    break;
                
                //ACTION: Delete Slide:
    			//---------------------------------    
                case 'deleteslide':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the slide id
                        $slideid = $this->uri->segment(4);
                        //Get the slide information
                        $sq = $this->db->query("SELECT * FROM fp_slides WHERE id = '" . $slideid . "'");
                        //Set the slide information to an array.
                        $sf = $sq->result_array();
                        //Delete the image
                        $this->db->query("DELETE FROM images WHERE filename = '" . $sf[0]["image"] . "'");
                        //Delete the slide itself
                        $this->db->query("DELETE FROM fp_slides WHERE id = '" . $slideid . "'");
                        //Redirect the user
                        redirect('/administration/fpage/slider/', 'refresh');
                        return true;
                    }
                    break;
                
                //ACTION: Change Slide Order:
    			//---------------------------------    
                case 'slideorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
                    {
                        return false;
                    }
                    else
                    {
                        //Get the new order from the post variable
                        $neworder = $this->input->post('order');
                        //Go through each re-ordered slides
    					foreach(explode(',', $neworder) as $key => $value)
    					{
    						//Do the update query.
    						$query = $this->db->query("UPDATE fp_slides SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;
                
                //ACTION: Widgets Management:
    			//---------------------------------    
                case 'widgets':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
                    {
                        return false;
                    }
                    else
                    {
                        //If the form was submitted:
        				if($this->input->post('update'))
        				{
        					//Iterate through each permission
        					foreach($this->input->post('widget') as $id => $value)
        					{
        					    //Declare the where clause
        						$this->db->where('id', $id);
                                //Setup a database array with new info
                                $dbarray = array('enabled' => $value);
                                //Do the update
                                $this->db->update('widgets', $dbarray);
        					}
                            //Set a success message
                            $data["msg"] = "Updated Successfully.";
        				}
                        //Get the widget information
                        $widgets = $this->db->query("SELECT * FROM widgets ORDER BY orderid ASC");
                        //Set it to a data array
                        $data["widgets"] = $widgets->result_array();
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/fpage/widgets.php", $data);
                        return true;
                    }
                    break;
                    
                //ACTION: Widget Re-Order:
    			//---------------------------------    
                case 'widgetorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
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
    						$query = $this->db->query("UPDATE widgets SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;
                    
                //ACTION: Front Page Settings:
    			//---------------------------------    
                case 'settings':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_frontpage'))
                    {
                        return false;
                    }
                    else
                    {
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('featured_video', 'Featured Video', 'max_length[255]');
                        $this->form_validation->set_rules('facebook_url', 'Facebook URL', 'max_length[255]');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Set a database array with the new information
        				    $dbarray = array('featured_video' => $this->input->post('featured_video'),
                                             'facebook_url'   => $this->input->post('facebook_url'));
                            //Do the update
                            $this->db->update("fp_settings", $dbarray);
                            //Set a success message
                            $data["msg"] = "Updated Successfully.";
                        }
                        //Setup a query
                        $fpq = $this->db->get('fp_settings');
                        //Get the information from the query
                        $fp = $fpq->result_array();
                        //Set the information to a data array
                        $data["settings"] = $fp[0];
                        //Load the template.
                        $this->load->view($this->admin_template_dir . "pages/fpage/settings.php", $data);
                        return true;
                    }
                    break;
            }
            //-----------------------------------
        }  
    }  
?>