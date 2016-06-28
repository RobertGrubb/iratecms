<?php
    /**
     * --------------------------------------
     * @file: log.php
     * @since: Version 1.0
     * @description: Handles all methods that
     * deal with logging an action. These logs
     * are sent to the database.
     * --------------------------------------
     **/
    class log extends CI_Model
    {
        /**
         * @method: staff()
         * @param: string controller
         * @param: string action
         * @desc: logs a staff member's actions
         * in the database.
         **/
        public function staff($controller = null, $action)
        {
            //Setup a database array with the following 
            //information.
            $dbarray = array('type'       => 'staff',
                             'action'     => $action,
                             'controller' => $controller,
                             'userid'     => $this->session->userdata('userid'),
                             'userip'     => $this->input->ip_address());
            //Do the insertion.
            $this->db->insert('logs', $dbarray);
        }
        
        /**
         * @method: user()
         * @param: string controller
         * @param: string action
         * @desc: logs a member's actions
         * in the database.
         **/
        public function user($controller = null, $action)
        {
            //Setup a database array with the following 
            //information.
            $dbarray = array('type'       => 'user',
                             'action'     => $action,
                             'controller' => $controller,
                             'userid'     => $this->session->userdata('userid'),
                             'userip'     => $this->input->ip_address());
            //Do the insertion
            $this->db->insert('logs', $dbarray);
        }
    }
?>