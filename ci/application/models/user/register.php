<?php

	class register extends CI_Model
	{
		//Set a variable that will hold the error
		public $reg_error = null;
		//Setup a variable that holds all the default
		//settings incase some isn't filled in by the
		//user, or if some of it has to be filled out
		//by the server side.
		public $defaults  = array('groupid'       => '1',
								  'recieve_email' => '1',
								  'timezone'      => '8', //Eastern
								  'dst'           => '1');

		/**
		 * Register Process Method
		 * This will handle the main login process.
		 **/
		public function process($userinfo)
		{
			//Setup the data array that we will use to insert
			//the user into the database.

			$salt = time();
            $newpass = md5(md5($salt . $userinfo['password']));


			//----------------------------------------------------
			$data = array('username' 	  => $userinfo['username'],
						  'password' 	  => $newpass,
						  'email'    	  => $userinfo['email'],
						  'groupid'  	  => $this->defaults['groupid'],
						  'timezone' 	  => $userinfo['timezone'],
						  'dst'      	  => $userinfo['dst'],
						  'recieve_email' => $this->defaults['recieve_email'],
						  'userip'   	  => $this->input->ip_address(),
                          'location'      => $userinfo['location'],
                          'salt' 		  => $salt);
			//----------------------------------------------------

			//Do the insert, and make sure it returns true.
			if($this->db->insert('users', $data))
			{
				//Return true if successful.
				return true;
			}
			else
			{
				//If not successful, set the error and return it to the user.
				$this->reg_error = "Something went wrong with the Insertion Process. Please contact an administrator.";
				return false;
			}	
		}
	}
?>