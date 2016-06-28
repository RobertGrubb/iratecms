<?php

	class login extends CI_Model
	{
		//Setup a variable to hold the error:
		public $login_error = null;

		/**
		 * Login Process Method
		 **/
		public function process($userinfo)
		{
			//Get user information from the database.
			$this->db->where("username", $userinfo['username']);
			$uq = $this->db->get("users");
			//Check the number of rows from the query
			//if it's 0, then the user does not exist.
			if($uq->num_rows() < 1)
			{
				//Set the error
				$this->login_error = "User does not exist.";
				//return false.
				return false;
			}
			//If we got here, this means the number of rows
			//returned 1, which means the user does exist.
			else
			{
				//Iterate through the query result
				//(There's only going to be 1 result)
				foreach($uq->result_array() as $user)
				{
				    if(md5(md5($user["salt"] . $userinfo['password'])) == $user["password"])
                    {
                        if(!$user["suspended"])
                        {
                            if(!$this->acl->isBanned('userid', $user["id"]))
                            {
                                //Setup the Session information:
            					$sessdata = array(
            	                    'username'  => $user["username"],
            	                    'userid'    => $user["id"],
            	                    'email'		=> $user["email"],
            	                    'logged_in' => TRUE
            	                );
            	                //Call the session set method.
            					$this->session->set_userdata($sessdata);
                            }
                            //If they are banned:
                            else
                            {
                                $this->login_error = "You are currently banned.";
                                return false;
                            }
                        }
                        //If they are suspended:
                        else
                        {
                            $this->login_error = "You are currently suspended.";
                            return false;
                        }
                    }
                    //If an incorrect password was given:
                    else
                    {
                        $this->login_error = "Incorrect Password.";
                        return false;
                    }
				}
				//return true.
				return true;
			}
		}
	}
?>