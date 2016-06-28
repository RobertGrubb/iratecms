<?php
/**
 * IrateCMS v3.0.X.
 **/
    function getLatestReply($tid)
    {
        //set the query
        $query = mysql_query("SELECT * FROM replies WHERE tid = '".$tid."' ORDER BY date DESC LIMIT 1");
        //fetch the number of rows
        $num = mysql_num_rows($query);
        //If a reply does exist:
        if ($num > 0) {
            //Get the thread information
            $fetch = mysql_fetch_array($query);
            //Set the information to an array
            $data = array('userid' => $fetch['userid'],
                           'date' => $fetch['date'], );
            //return the data.
            return $data;
        }
        //If a reply does not exist:
        else {
            //Return nothing.
            return;
        }
    }

    function updateViews($tid)
    {
        $query = mysql_query("SELECT * FROM threads WHERE id = '".$tid."'");
        $num = mysql_num_rows($query);
        if ($num > 0) {
            //Get the thread information
            $fetch = mysql_fetch_array($query);
            $CurrentViews = $fetch['views'];
            $NewViews = ($CurrentViews + 1);
            mysql_query("UPDATE threads SET views = '".$NewViews."' WHERE id = '".$tid."'");
        }
    }

    function getViews($tid)
    {
        $query = mysql_query("SELECT * FROM threads WHERE id = '".$tid."'");
        $num = mysql_num_rows($query);
        if ($num > 0) {
            //Get the thread information
            $fetch = mysql_fetch_array($query);
            $CurrentViews = $fetch['views'];

            return $CurrentViews;
        } else {
            return 0;
        }
    }

    function replyCount($tid)
    {
        //set the query
        $query = mysql_query("SELECT * FROM replies WHERE tid = '".$tid."'");
        //fetch the number of rows
        $num = mysql_num_rows($query);
        //return the data
        return $num;
    }
