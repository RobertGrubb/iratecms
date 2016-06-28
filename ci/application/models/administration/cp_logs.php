<?php
    /**
     * --------------------------------------
     * @file: cp_logs.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the Display Logs.
     * --------------------------------------
     **/
    class cp_logs extends CI_Model
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
                //ACTION: Show Staff Logs:
    			//---------------------------------
                case 'staff':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_logs'))
                    {
                        return false;
                    }
                    else
                    {
                        //Load the pagination library:
            			$this->load->library('pagination');
            			//Configure Pagination:
            			//----------------------------------------
            				//Set the base url
            				$config['base_url'] = settings('site_url') . settings('admin_dir') . 'logs/staff/';
            				//set the URI Segment.
            				$config['uri_segment'] = 4;
            				//Whether we are using page numbers
            				$config['use_page_numbers'] = false;
            				//Set opening tag for selected page
            				$config['cur_tag_open'] = '<li class="active"><a href="#" class="pagination-selected">';
            				//Set closing tag for selected page
            				$config['cur_tag_close'] = "</a></li>";
            				//Do the query so we can get the total number of rows.
            				$this->db->where('type', 'staff');
                            $this->db->order_by('date', 'desc');
                            $nq = $this->db->get('logs');
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
                        //The where clause
                        $this->db->where('type', 'staff');
                        //Order by the date
                        $this->db->order_by('date', 'desc');
                        //Limit depending on our pagination script
                        $this->db->limit($config['per_page'], $page);
                        //Get the logs
                        $lq = $this->db->get('logs');
                        //Set the logs to the data array
                        $data["logs"] = $lq->result_array();
                        //Load the template
                        $this->load->view($this->admin_template_dir . "pages/logs/stafflogs.php", $data);
                        //Return that they accessed this page successfully:
                        return true;
                    }
                    break;
                        
                    //ACTION: Show User Logs:
        			//---------------------------------
                    case 'user':
                        //Check if User has Permissions for this:
                        if(!$this->acl->perm('can_view_logs'))
                        {
                            return false;
                        }
                        else
                        {
                            //Load the pagination library:
                			$this->load->library('pagination');
                			//Configure Pagination:
                			//----------------------------------------
                				//Set the base url
                				$config['base_url'] = settings('site_url') . settings('admin_dir') . 'logs/user/';
                				//set the URI Segment.
                				$config['uri_segment'] = 4;
                				//Whether we are using page numbers
                				$config['use_page_numbers'] = false;
                				//Set opening tag for selected page
                				$config['cur_tag_open'] = '<li class="active"><a href="#" class="pagination-selected">';
                            //Set closing tag for selected page
                            $config['cur_tag_close'] = "</a></li>";
                				//Do the query so we can get the total number of rows.
                				$this->db->where('type', 'user');
                                $this->db->order_by('date', 'desc');
                                $nq = $this->db->get('logs');
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
                            //The where clause
                            $this->db->where('type', 'user');
                            //Order by the date
                            $this->db->order_by('date', 'desc');
                            //Limit depending on our pagination script
                            $this->db->limit($config['per_page'], $page);
                            //Get the logs
                            $lq = $this->db->get('logs');
                            //Set the logs to the data array
                            $data["logs"] = $lq->result_array();
                            //Load the template
                            $this->load->view($this->admin_template_dir . "pages/logs/userlogs.php", $data);
                            //Return that they accessed this page successfully:
                            return true;
                        }
                        break;  
                //-----------------------------------
            }
        }  
    }  
?>