<?php
/**
 * Forum ACL Model
 **/
	class acl extends CI_Model
	{
	   
       public function __construct()
       {
           //Do a check every load time.
           //-------------------------------
           if($this->isBanned('userip', $this->input->ip_address()))
           {
                show_error('You have been permanently banned from the site.');
           }
           
           if($this->loggedIn())
           {
               if($this->isBanned('userid', $this->session->userdata('userid')))
               {
                  //Destroy the session
		          $this->session->sess_destroy();  
                  redirect('/errors/banned/', 'refresh');
               }
           }
           //-------------------------------
       }
       
		/**
		 * ACL is Logged in Method
		 **/
		public function loggedIn()
		{
			//Check if session is logged in
			if($this->session->userdata('logged_in'))
				//Ifso, return valid
				return true;
			//If not
			else
				//return invalid
				return false;
		}
        
        /**
		 * ACL is Banned Method
		 **/
        public function isBanned($check, $value)
        {
            //Check for userid in the banned table
            $banned = $this->db->query("SELECT * FROM banned WHERE " . $check . " = '" . $value . "'");
            //If is present
            if($banned->num_rows() >= 1)
                //return true
                return true;
            //if not banned
            else
                //return false.
                return false;
        }

		/**
		 * ACL Access CP Method
		 **/
		public function accesscp()
		{
			//If the user can access the cp
			if($this->perm('can_access_cp'))
				//Return true.
				return true;
			//If they can't
			else
				//return false.
				return false;
		}

		/**
		 * ACL Permission Check Method
		 * This method is to check if user has
		 * a permission from the table "permissions".
		 **/
		public function perm($perm, $groupid = null)
		{
			//Check if the user is not logged in.
			//If the usergroupd id is also NULL, this means
			//that we need to return the guest group.
			if($groupid == null && !$this->loggedIn())
				//Guest GroupID is 0, set it to that.
				$groupid = 0;
			//If the user is logged in, and the groupid is
			//null, then we will use the user's group id.
			elseif($groupid == null && $this->loggedIn())
				//Get the user's group id:
				$groupid = $this->group($this->session->userdata('userid'), 'id');
			//setup a permission query
			$permq = $this->db->query("SELECT * FROM permissions WHERE perm = '" . $perm . "'");
			//Get the number or rows
			$num   = $permq->num_rows();
			//If the row exists:
			if($num >= 1)
			{
				//Get the permission information
				$permf = $permq->result_array();
				//Get the groups:
				if(!empty($permf[0]["usergroups"]))
				{
					$groups = unserialize($permf[0]["usergroups"]);
					//If the user has this permission:
					if(in_array($groupid, $groups))
						//Return true:
						return true;
					//If not
					else
						//Tell them no.
						return false;
				}
				//If the usergroups field is empty:
				else
				{
					//return false;
					return false;
				}
			}
			//If the permission does not exist:
			else
			{
				//Let them know by returning false.
				return false;
			}
		}

		/**
		 * ACL Access Check Method
		 * This method is to check a permission that is
		 * stored within a certain database table. 
		 * For instance: "forums" table.
		 **/
		public function access($table, $id, $groupid = null)
		{
			//Check if the user is not logged in.
			//If the usergroupd id is also NULL, this means
			//that we need to return the guest group.
			if($groupid == null && !$this->loggedIn())
				//Guest GroupID is 0, set it to that.
				$groupid = 0;
			//If the user is logged in, and the groupid is
			//null, then we will use the user's group id.
			elseif($groupid == null && $this->loggedIn())
				//Get the user's group id:
				$groupid = $this->group($this->session->userdata('userid'), 'id');
			//setup a permission query
			$forumq = $this->db->query("SELECT * FROM " . $table . " WHERE id = '" . $id . "'");
			//Get the number or rows
			$num   = $forumq->num_rows();
			//If the row exists:
			if($num >= 1)
			{
				//Get the permission information
				$ff = $forumq->result_array();
				//Get the groups:
				if(!empty($ff[0]["perms"]))
				{
					$groups = unserialize($ff[0]["perms"]);
					//If the user has this permission:
					if(in_array($groupid, $groups))
						//Return true:
						return true;
					//If not
						else
						//Tell them no.
						return false;
				}
				//If the usergroups field is empty:
				else
				{
					//return false;
					return false;
				}
			}
			//If the permission does not exist:
			else
			{
				//Let them know by returning false.
				return false;
			}
		}

		/**
		 * ACL Access Update Method
		 **/
		public function update_access($table, $id, $groups)
		{
			//Serialize the Groups array:
			$groups = serialize($groups);
			//Update the database table:
			if($this->db->query("UPDATE " . $table . " SET perms = '" . $groups . "' WHERE id = '" . $id . "'"))
				//If we succeeded, let them know:
				return true;
			//If we failed:
			else
				//Return false
				return false;
		}

		/**
		 * ACL Permission Update Method
		 **/
		public function update_perm($perm, $groupid, $access)
		{
			//Get the Permission from the specified perm parameter
			$query = $this->db->query("SELECT * FROM permissions WHERE perm = '" . $perm . "'");
			//Set the result to an array:
			$fetch = $query->result_array();
			//Setup our current groups that have access
			$groups = unserialize($fetch[0]["usergroups"]);
			//If they do have access, and we are told they no longer
			//have access, we need to update it.
			if(in_array($groupid, $groups) && $access == "false")
			{
				//Remove the groupid from the groups array.
				$groups = array_values(array_diff($groups, array($groupid)));
			}
			//If the specified group id is NOT in the groups array,
			//and we are wanting to let them have access, then what
			//we need to do is add them.
			elseif(!in_array($groupid, $groups) && $access == "true")
			{
				$groups[] = $groupid;
			}
			//Now, let's setup the new array into a string format,
			//and get it ready for a database insertion.
			$groups = serialize($groups);
			//Do the update query
			if($this->db->query("UPDATE permissions SET usergroups = '" . $groups . "' WHERE perm = '" . $perm . "'"))
				//If successful, return true
				return true;
			//If we run into a problem with the query
			else
				//Let them know by returning false.
				return false;
		}

		/**
		 * ACL Group Method
		 **/
		public function group($userid, $field)
		{
			//Get user information:
			$uq = $this->db->query("SELECT * FROM users WHERE id = '" . $userid . "'");
			//Get the user number of rows
			$un = $uq->num_rows();
			//If the user exists:
			if($un >= 1)
			{
				//Get the fetch array
				$uf = $uq->result_array();
				//Get the usergroup information:
				$gq = $this->db->query("SELECT * FROM usergroups WHERE id='" . $uf[0]['groupid'] . "'");
				//Get the group number of rows:
				$gn = $gq->num_rows();
				//If the group does exist:
				if($gn >= 1)
				{
					//Get the group information
					$gf = $gq->result_array();
					//Check if field exists:
					if(isset($gf[0][$field]))
						//Return the field
						return $gf[0][$field];
					//If the field doesnt exist:
					else
						//Return nothing
						return null;
				}
				//If we got this far, that means
				//the group doesnt exist, therefore
				//we need to return nothing.
				else
				{
					return null;
				}
			}
			//If we get this far, that means the
			//user doesnt exist, therefore we dont
			//need to return anything.
			else
			{
				return null;
			}
		}
	}
?>