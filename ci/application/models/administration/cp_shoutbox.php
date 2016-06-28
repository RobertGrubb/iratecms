<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_shoutbox extends CI_Model
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
                case 'messages':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_shoutbox'))
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
                        $this->load->view($this->admin_template_dir . "shoutbox/messages.php");
                        //------------------------------
                        return true;
                    }
                    break;
                    
                //Example Action:
                case 'form':
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_shoutbox'))
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
                        $this->load->view($this->admin_template_dir . "shoutbox/form.php");
                        //------------------------------
                        return true;
                    }
                    break;
             
                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_view_shoutbox'))
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