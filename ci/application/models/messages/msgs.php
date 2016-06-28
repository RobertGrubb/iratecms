<?php
    /**
     * --------------------------------------
     * @file: msgs.php
     * @since: Version 1.0
     * @description: Handles all methods that
     * may need to be called to get info about
     * the session users messages.
     * --------------------------------------
     **/
	class msgs extends CI_Model
	{ 
	    /**
         * Method Unread Message Number
         * This will return an integer
         * for how many unread messages the
         * current session user has.
         **/
        public function UnreadMessageNum()
        {
            //Get the session user's id
            $userid = $this->session->userdata("userid");
            //Setup the query.
            $rq = $this->db->get_where('privmsgs', array('recvid' => $userid,
                                                         'recv_read'   => 0,
                                                         'type' => 'parent'));
            $sq = $this->db->get_where('privmsgs', array('sendid' => $userid,
                                                         'sender_read'   => 0,
                                                         'type' => 'parent'));
            //Return the number of rows.
            return $rq->num_rows() + $sq->num_rows();
        }
    }
?>