<?php
/**
 * IrateCMS v3.0.X.
 **/

    /**
     * Method: forumPostCount.
     *
     * @param int
     * This will retrieve the number
     * of posts in the specified forum.
     **/
    function forumPostCount($fid)
    {
        //set the query
        $query = mysql_query("SELECT * FROM replies WHERE fid = '".$fid."'");
        //fetch the number of rows
        $num = mysql_num_rows($query);
        //return the int
        return $num;
    }
    /**
     * Method: forumThreadCount.
     *
     * @param int
     * This will retrieve the number
     * of threads in the specified forum.
     **/
    function forumThreadCount($fid)
    {
        //set the query
        $query = mysql_query("SELECT * FROM threads WHERE fid = '".$fid."'");
        //fetch the number of rows
        $num = mysql_num_rows($query);
        //return the int
        return $num;
    }

    /**
     * Method: getLatestPost.
     *
     * @param int
     * This will retrieve the latest
     * post for a specific forum.
     **/
    function getLatestPost($fid)
    {
        //Grab the reply information:
        $replyq = mysql_query("SELECT * FROM replies WHERE fid = '".$fid."' ORDER BY id DESC LIMIT 1");
        $replyn = mysql_num_rows($replyq);
        //Grab the thread information
        $threadq = mysql_query("SELECT * FROM threads WHERE fid = '".$fid."' ORDER BY id DESC LIMIT 1");
        $threadn = mysql_num_rows($threadq);
        //Check if there is atleast 1 thread or 1 reply
        if ($replyn > 0 || $threadn > 0) {
            //fetch the array for replies:
            $replyf = mysql_fetch_array($replyq);
            //fetch the array for threads:
            $threadf = mysql_fetch_array($threadq);
            //If reply is for some reason empty, set it to an int
            $replyf['date'] = ($replyf['date'])  ? $replyf['date']  : 0;
            //If thread is for some reason empty, set it to an int
            $threadf['date'] = ($threadf['date']) ? $threadf['date'] : 0;
            //If the reply is more recent than the thread
            if ($replyf['date'] > $threadf['date']) {
                //Get the user information for that reply
                $uq = mysql_query("SELECT * FROM users WHERE id = '".$replyf['userid']."'");
                $uf = mysql_fetch_array($uq);
                //Get this thread's information:
                $threadq = mysql_query("SELECT * FROM threads WHERE id = '".$replyf['tid']."'");
                $threadf = mysql_fetch_array($threadq);
                //Set the data into an array:
                $data = array('tid' => $replyf['tid'],
                               't_title' => $threadf['title'],
                               'username' => $uf['username'],
                               'userid' => $uf['id'], );
                //return the data
                return $data;
            }
            //If the thread is more recent than the reply
            elseif ($threadf['date'] > $replyf['date']) {
                //Get the user information for that reply
                $uq = mysql_query("SELECT * FROM users WHERE id = '".$threadf['userid']."'");
                $uf = mysql_fetch_array($uq);
                //Set the data into an array:
                $data = array('tid' => $threadf['id'],
                               't_title' => $threadf['title'],
                               'username' => $uf['username'],
                               'userid' => $uf['id'], );
                //return the data
                return $data;
            }
            //If the thread is equal to the reply (If both are 0)
            else {
                //This means that they were both 0, which  means
                //there was no posts.
                return;
            }
        }
        //If it gets this far, it means that
        //there isn't a reply or a thread
        //in the specified forum.
        else {
            return;
        }
    }
