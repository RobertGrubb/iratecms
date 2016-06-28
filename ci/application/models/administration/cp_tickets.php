<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_tickets extends CI_Model
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
                //Example Action:
                case 'categories':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_ticket_categories'))
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
                        //Set the order by
                        $this->db->order_by('orderid', 'ASC');
                        //Get the ticket categories from the db
                        $categories = $this->db->get("ticket_categories");
                        //set the data to the variable
                        $data["categories"] = $categories->result_array();
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/tickets/categories.php", $data);
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //Example Action:
                case 'addcat':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_ticket_categories'))
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
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'));
                            //Do the insertion
                            if($this->db->insert('ticket_categories', $dbarray))
                                //if successful, redirect the user
                                redirect('/administration/tickets/categories/', 'refresh');
                            //If not successful
                            else
                                //return an error
                                $data["error"] = "Something went wrong.";
                        }
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/tickets/addcat.php", $data);
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //Example Action:
                case 'editcat':
                    $catid = $this->uri->segment(4);
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_ticket_categories'))
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
        				//-----------------------------------------------
        				$this->form_validation->set_rules('title', 'Title', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    $this->db->where('id', $catid);
        				    //Setup a database array
    	                    $dbarray = array('title' => $this->input->post('title'));
                            //Do the insertion
                            if($this->db->update('ticket_categories', $dbarray))
                                //if successful, redirect the user
                                $data["msg"] = "Updated Successfully.";
                            //If not successful
                            else
                                //return an error
                                $data["error"] = "Something went wrong.";
                        }
                        //Set the where clause
                        $this->db->where('id', $catid);
                        //Get the ticket categories from the db
                        $category = $this->db->get("ticket_categories");
                        //Get the result array
                        $category = $category->result_array();
                        //set the info to the data array
                        $data["cat"] = $category[0];
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/tickets/editcat.php", $data);
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //Example Action:
                case 'deletecat':
                    $catid = $this->uri->segment(4);
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_ticket_categories'))
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
                        //Set the where clause
                        $this->db->where('id', $catid);
                        //Do the deletion
                        $this->db->delete('ticket_categories');
                        //Redirect the user
                        redirect('/administration/tickets/categories');
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //ACTION: Change Slide Order:
    			//---------------------------------    
                case 'catorder':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_ticket_categories'))
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
    						$query = $this->db->query("UPDATE ticket_categories SET orderid = '" . $key . "' WHERE id = '" . $value . "'");
    					}
                        return true;
                    }
                    break;
                    
                case 'tickets':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_tickets'))
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
                        //Load the pagination library:
            			$this->load->library('pagination');
            			//Configure Pagination:
            			//----------------------------------------
            				//Set the base url
            				$config['base_url'] = settings('site_url') . settings('admin_dir') . 'tickets/tickets/';
            				//set the URI Segment.
            				$config['uri_segment'] = 4;
            				//Whether we are using page numbers
            				$config['use_page_numbers'] = false;
            				//Set opening tag for selected page
            				$config['cur_tag_open'] = '<a href="#" class="pagination-selected">';
            				//Set closing tag for selected page
            				$config['cur_tag_close'] = "</a>";
            				//Do the query so we can get the total number of rows.
            				$this->db->order_by('status', 'ASC');
                            $this->db->order_by('created', 'ASC');
                            $nq = $this->db->get("tickets");
            				//Set the total rows
            				$config['total_rows'] = $nq->num_rows();
            				//Set the items per page.
            				$config['per_page'] = 18; 
            				//Set the current page:
            				$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
            				//Set the Limit for the query:
            				//$limit = ($page * $this->replies_per_page); 
            				//Initialize the pagination script.
            				$this->pagination->initialize($config); 
            			//----------------------------------------
                        //Set the order by status
                        $this->db->order_by('status', 'ASC');
                        //Set the order by created
                        $this->db->order_by('id', 'DESC');
                        //Limit depending on our pagination script
                        $this->db->limit($config['per_page'], $page);
                        //Get the tickets from the db
                        $tickets = $this->db->get("tickets");
                        //Set the result array to the data array
                        $data["tickets"] = $tickets->result_array();
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/tickets/tickets.php", $data);
                        //------------------------------
                        return true;
                    }
                    break;
                    
                case 'view':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_tickets'))
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
                        $this->load->helper('misc/bbcode');
                        //Do Script Here
                        //------------------------------
                        $ticketid = $this->uri->segment(4);
                        //Set Validation Rules:
        				//-----------------------------------------------
        				$this->form_validation->set_rules('category', 'Category', 'required');
                        $this->form_validation->set_rules('subject', 'Subject', 'required');
                        $this->form_validation->set_rules('status', 'Status', 'required');
        				//-----------------------------------------------
        				//If the form validation was successful.
        				if($this->form_validation->run())
        				{
        				    //Set the where clause
        				    $this->db->where('id', $ticketid);
                            //If status is set to closed
                            if($this->input->post('status'))
                                //Set the closed time to now
                                $closed = time();
                            //If it's not set
                            else
                                //Leave it blank.
                                $closed = "";
        				    //Setup a database array
    	                    $dbarray = array('catid' => $this->input->post('category'),
                                             'subject'  => $this->input->post('subject'),
                                             'status'   => $this->input->post('status'),
                                             'closed'   => $closed);
                            //Do the update.
                            if($this->db->update('tickets', $dbarray))
                                //Set the message if successful.
                                $data["msg"] = "Ticket Updated Successfully.";
                            //If not successful
                            else
                                //Set an error
                                $data["error"] = "Ticket update failed.";
                            //Get the content from the form:
                            $content = $this->input->post('content');
                            //If the content is NOT empty
                            if(!empty($content))
                            {
                                //Setup a database array for the new comment.
                                $dbarray = array('content' => $this->input->post('content'),
                                                 'ticket_id' => $ticketid,
                                                 'userid' => $this->session->userdata('userid'));
                                //Do the insertion.
                                $this->db->insert('ticket_comments', $dbarray);
                            }
                        }
                        //Set the where clause
                        $this->db->where('id', $ticketid);
                        //Get the tickets
                        $ticket = $this->db->get('tickets');
                        //Set the ticket result array
                        $ticket = $ticket->result_array();
                        //Set the new information to the data array.
                        $data["ticket"] = $ticket[0];
                        //Get Category:
                        //-----------------------------------------
                        $this->db->where('id', $ticket[0]["catid"]);
                        $catq = $this->db->get("ticket_categories");
                        if($catq->num_rows < 1)
                        {
                            $data["cat_title"] = "OTHER";
                            $data["cat_id"]    = 0;
                        }
                        else
                        {
                            $cat = $catq->result_array();
                            $data["cat_title"] = $cat[0]["title"];
                            $data["cat_id"]    = $cat[0]["id"];
                        }
                        //-----------------------------------------
                        //Set the order by
                        $this->db->order_by('orderid', 'ASC');
                        //Get the ticket categories
                        $cq = $this->db->get("ticket_categories");
                        //Set the categories to the data array.
                        $data["categories"] = $cq->result_array();
                        //Set the where clause
                        $this->db->where('ticket_id', $ticketid);
                        //Set the order by clause
                        $this->db->order_by('date', 'ASC');
                        //Get the ticket comments
                        $replies = $this->db->get("ticket_comments");
                        //Get the comments result array
                        $data["replies"] = $replies->result_array();
                        //Load the template.
                        $this->load->view($this->admin_template_dir . "pages/tickets/view.php", $data);
                        //------------------------------
                        return true;
                    }
                    break;
             
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_tickets'))
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