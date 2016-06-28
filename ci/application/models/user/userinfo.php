<?php

	class userinfo extends CI_Model
	{

		public $error = null;

		/**
		 * User Get Method
		 * @param string Field
		 * Returns information about a
		 * specific user.
		 **/
		public function get($userid = null, $field)
		{
            if($userid == null)
                $userid = $this->session->userdata('userid');
			//Setup a query to get the user data.
            $this->db->where("id", $userid);
            $query = $this->db->get("users");
			//If the user does not exist:
			if($query->num_rows() < 1)
			{
				//return null.
				return null;
			}
			//if the user does exist:
			else
			{
				//Fetch the data
				$fetch = $query->result_array();
                
                if($field == "colored_username")
                {
                    return '<span style="color: ' . $this->usergroup($fetch[0]["groupid"], 'color') . ';font-weight: bold;">
                              ' . $fetch[0]["username"] . '
                            </span>';
                }
                else
                {
                    //If the field is set,
    				if(isset($fetch[0][$field]))
    					//return it
    					return $fetch[0][$field];
    				//if it's not set
    				else
    					//return nothing.
    					return null;
                }	
			}
		}
        
        public function profiledata($username)
		{
			//Setup a query to get the user data.
            $this->db->where("username", $username);
            $query = $this->db->get("users");
			//If the user does not exist:
			if($query->num_rows() < 1)
			{
				//return null.
				return false;
			}
			//if the user does exist:
			else
			{
				//Fetch the data
				$fetch = $query->result_array();
                
                return $fetch[0];	
			}
		}
        
        public function usergroup($groupid, $field)
        {
            $uq = $this->db->query("SELECT * FROM usergroups WHERE id = '" . $groupid . "'");
            $uf = $uq->result_array();
            if(isset($uf[0][$field]))
                return $uf[0][$field];
            else
                return null;
        }

		/**
		 * User Posts Method
		 * @param int userid
		 * Returns total posts for a 
		 * specific user.
		 **/
		public function posts($userid)
		{
			//Get thread data
            $this->db->where("userid", $userid);
            $tq = $this->db->get("threads");
			//Get reply data:
            $this->db->where("userid", $userid);
            $rq = $this->db->get("replies");
			//Add the two and return the total.
			return ($tq->num_rows() + $rq->num_rows());
		}
        
        public function is_pending($friendid, $userid = null)
		{
			//If user id is null
			if($userid == null)
			{
				//use the session
				$userid = $this->session->userdata("userid");
			}

            $this->db->where("status", "0");
			$this->db->where("userid", $userid);
			$this->db->where("friendid", $friendid);
			$yourid = $this->db->get("friends");
            
            $this->db->where("status", "0");
            $this->db->where("userid", $friendid);
			$this->db->where("friendid", $userid);
			$theirid = $this->db->get("friends");
            
			//If that id is in the array
			if($yourid->num_rows() >= 1 || $theirid->num_rows() >= 1){
				//return true
				return true;
			}
			//If they are not friends
			else
			{
				//return no
				return false;
			}
		}
        
        public function frnum()
        {
            $userid = $this->session->userdata("userid");
            
            $this->db->where("status", "0");
			$this->db->where("friendid", $userid);
            $frs = $this->db->get("friends");
            
            $num_of_frs = $frs->num_rows();
            
            return $num_of_frs;
        }
        
        public function is_friends($friendid, $userid = null)
		{
			//If user id is null
			if($userid == null)
			{
				//use the session
				$userid = $this->session->userdata("userid");
			}

            $this->db->where("status", "1");
			$this->db->where("userid", $userid);
			$this->db->where("friendid", $friendid);
			$yourid = $this->db->get("friends");
            
            $this->db->where("status", "1");
            $this->db->where("userid", $friendid);
			$this->db->where("friendid", $userid);
			$theirid = $this->db->get("friends");
            
			//If that id is in the array
			if($yourid->num_rows() >= 1 || $theirid->num_rows() >= 1){
				//return true
				return true;
			}
			//If they are not friends
			else
			{
				//return no
				return false;
			}
		}
        
        public function friends($userid = null)
        {
            if($userid == null)
			{
				//use the session
				$userid = $this->session->userdata("userid");
			}
            
            $this->db->where("`userid` = '" . $userid . "' || `friendid` = '" . $userid . "'");
            $friends = $this->db->get("friends");
            $friends = $friends->result_array();
            $f = array();
            foreach($friends as $friend)
            {
                if($userid == $friend["userid"])
                {
                    $friendid = $friend["friendid"];
                }
                else
                {
                    $friendid = $friend["userid"];
                }
                
                $f[] = $friendid;
            }
            return $f;
        }
        
        public function avatar($userid = null)
        {
            if($userid == null)
                $userid = $this->session->userdata('userid');
            
            
            $userImage = $this->get($userid, "avatar");
            
            if(!empty($userImage) && !is_null($userImage))
            {
                $full_path = url() . "uploads/avatars/" . $userImage;
            }
            else
            {
                $full_path = url() . "uploads/avatars/default.jpg";
            }
            
            return $full_path;
        }
        
        public function construct_profile_link($userid = null)
        {
            if($userid == null)
                $userid = $this->session->userdata('userid');
                
            $username = $this->get($userid, "username");
                
            $profile_link = url() . "profile/" . $username;
            
            return $profile_link;
        }

        public function changepass($userdata)
        {
        	if(!empty($userdata["email"]))
        	{
        		$this->db->where("email", $userdata["email"]);
        		$user = $this->db->get("users");
        		if($user->num_rows() < 1)
        		{
        			$this->error = "User was not found in our database.";
        			return false;
        		}
        		else
        		{
        			//User was found, we can continue:

        			//UPDATE PASSWORD
        			//=====================================================
        			$newpass_clean = random_string('alnum', 16);
                    
                    $salt = time();
            
                    $newpass = md5(md5($salt . $newpass_clean));

                    $this->db->where("email", $userdata["email"]);
                    $this->db->update("users", array("password" => $newpass, "salt" => $salt));

        			//=====================================================

        			//EMAIL USER
        			//=====================================================
        			$this->load->library('email');

        			//Setup information we need:
        			$admin_email = settings("admin_email");
        			$site_title = settings("site_title");
        			$subject = "You've changed your password!";
					$this->email->from($admin_email, $site_title);
					$this->email->to($userdata["email"]); 
					$this->email->subject($subject);

					//Set data for email template
					$data["subject"] = $subject;
					$data["newpass"] = $newpass_clean;

					//Set the message via the view template
					$msg = $this->load->view('emails/changepass', $data, true);
					$this->email->message($msg); 

					//Send the email
					$this->email->send();

					return true;
        			//=====================================================
        		}
        	}
        	$this->error = "User was not found in our database.";
        	return false;
        }
	}
?>