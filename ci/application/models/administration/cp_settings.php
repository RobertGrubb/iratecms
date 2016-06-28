<?php
    /**
     * --------------------------------------
     * @file: cp_settings.php
     * @since: Version 1.0
     * @description: Handles all methods
     * that deal with the Settings
     * Administration.
     * --------------------------------------
     **/
    class cp_settings extends CI_Model
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
            //Check if User has Permissions for this:
            if(!$this->acl->perm('can_admin_settings'))
            {
                return false;
            }
            else
            {
                //Do Script:
                //-----------------------------------
                //Get the settings from the database
    		    $settings = $this->db->query("SELECT * FROM settings");
                //Go through each setting
                foreach($settings->result_array() as $setting)
                {
                    //If the setting is required
                    if($setting["required"])
                    {
                        //Setup a form rule.
                        $this->form_validation->set_rules('setting[' . $setting["variable"] . ']', $setting["title"], 'required');
                    }    
                }
    			//Setup variable for data:
    			$data = null;
    			//Run the form validator:
    			if($this->form_validation->run())
    			{
    			    //Get the settings from the form
    			    $NewSettings = $this->input->post('setting');
                    //Go through each setting
    				foreach($NewSettings as $key => $value)
                    {
                        //Setup the where clause
                        $this->db->where('variable', $key);
                        //Setup the database array
                        $dbarray = array('value' => $value);
                        //Update that setting
                        if($this->db->update('settings', $dbarray))
                            //Set the success msg
                            $data["msg"] = "Updated Successfully";
                        //If there was a problem
                        else
                            //Set an error
                            $data["error"] = "Something went wrong.";
                    }
    			}
                //Get the Permission Sections
    			$sectionsq = $this->db->query("SELECT * FROM settings_sections");
    			//Get the Section Query
    			$sections  = $sectionsq->result_array();
    			//Ideal way to process the forums within the categories.
    			foreach($sections as $key => $row)
    			{
    				//Get the forum information
    				$settingq = $this->db->query("SELECT * FROM settings WHERE secid = '" . $row['id'] . "' ORDER BY orderid ASC");
    				//Set the forum information to an array
    				$row["settings"]  = $settingq->result_array();
    				//Push the array into the category array.
    				$sections[$key] = $row;
    			}
    			//Push information into the data array.
    			$data["sections"] = $sections;
    			//Load the template
    			$this->load->view($this->admin_template_dir . "pages/settings/settings.php", $data);
                //-----------------------------------
                return true;
            }
        }  
    }  
?>