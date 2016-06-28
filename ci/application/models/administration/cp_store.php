<?php
    /**
     * Control Panel Area Model
     * This will handle all methods
     * for this specific area.
     **/
    class cp_store extends CI_Model
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
                case "config":
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_store'))
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


                        //Set Validation Rules:
                        $this->form_validation->set_rules('payment_gateway', 'Payment Gateway', 'required');
                        //End Validation Rules:
                        // Runs the form validation 
                        if($this->form_validation->run())
                        {   

                            $this->db->where("variable", "payment_gateway");
                            $this->db->update("store_config", array('value' => $this->input->post('payment_gateway')));

                            $this->db->where("variable", "paypal_api_username");
                            $this->db->update("store_config", array('value' => $this->input->post('paypal_api_username')));

                            $this->db->where("variable", "paypal_api_password");
                            $this->db->update("store_config", array('value' => $this->input->post('paypal_api_password')));

                            $this->db->where("variable", "paypal_api_signature");
                            $this->db->update("store_config", array('value' => $this->input->post('paypal_api_signature')));

                            $this->db->where("variable", "test_mode");
                            $this->db->update("store_config", array('value' => $this->input->post('test_mode')));

                            $data['msg'] = "Update successful!";

                        }

                        $this->db->where("variable", "payment_gateway");
                        $payment_gateway = $this->db->get("store_config");
                        $payment_gateway = $payment_gateway->result_array();
                        $payment_gateway = $payment_gateway[0]["value"];
                        $data["payment_gateway"] = $payment_gateway;

                        $this->db->where("variable", "paypal_api_username");
                        $paypal_api_username = $this->db->get("store_config");
                        $paypal_api_username = $paypal_api_username->result_array();
                        $paypal_api_username = $paypal_api_username[0]["value"];
                        $data["paypal_api_username"] = $paypal_api_username;

                        $this->db->where("variable", "paypal_api_password");
                        $paypal_api_password = $this->db->get("store_config");
                        $paypal_api_password = $paypal_api_password->result_array();
                        $paypal_api_password = $paypal_api_password[0]["value"];
                        $data["paypal_api_password"] = $paypal_api_password;

                        $this->db->where("variable", "paypal_api_signature");
                        $paypal_api_signature = $this->db->get("store_config");
                        $paypal_api_signature = $paypal_api_signature->result_array();
                        $paypal_api_signature = $paypal_api_signature[0]["value"];
                        $data["paypal_api_signature"] = $paypal_api_signature;

                        $this->db->where("variable", "test_mode");
                        $test_mode = $this->db->get("store_config");
                        $test_mode = $test_mode->result_array();
                        $test_mode = $test_mode[0]["value"];
                        $data["test_mode"] = $test_mode;

                        //Load the template
                        $this->load->view('pages/store/config.php', $data);
                        return true;
                    }
                    break;

                case "cats":
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_store'))
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
                        $data = null;
                        //Load the template
                        $this->load->view('pages/store/cats.php', $data);
                        return true;
                    }
                    break;

                case "items":
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_store'))
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
                        $data = null;
                        //Load the template
                        $this->load->view('pages/store/items.php', $data);
                        return true;
                    }
                    break;

                case "sales":
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_store'))
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
                        $data = null;
                        //Load the template
                        $this->load->view('pages/store/sales.php', $data);
                        return true;
                    }
                    break;

                //Default Action
			    default:
                    //Check if User has Permissions for this:
                    if(!$this->acl->perm('can_admin_store'))
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
                        $data = null;
                        //Load the template
                        $this->load->view('pages/store/store.php', $data);
                        return true;
                    }
                    break; 
            }
            //------------------------------------------
        }  
    }  
?>