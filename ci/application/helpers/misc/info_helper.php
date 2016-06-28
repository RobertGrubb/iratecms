<?php
/**
 * IrateCMS v3.0.X
 **/

    /**
     * Method: Settings.
     *
     * @param string
     * This will retrieve any setting
     * fields from the database.
     **/
    function settings($field)
    {
        //Set the query
        $query = mysql_query("SELECT * FROM settings WHERE variable = '".$field."'");
        //fetch the data
        $fetch = mysql_fetch_array($query);
        //If the field is set,
        //echo it.
        if (isset($fetch['value'])) {
            return $fetch['value'];
        }
    }

    /**
     * Method: url.
     *
     * @return string Site Url
     **/
    function url()
    {
        //Return the site url.
        if (!settings('clean_urls')) {
            echo settings('site_url').'index.php/';
        } else {
            echo settings('site_url');
        }
    }

    function utf8_urldecode($str)
    {
        $str = preg_replace('/%u([0-9a-f]{3,4})/i', '&#x\\1;', urldecode($str));

        return html_entity_decode($str, null, 'UTF-8');
    }

    function contentFix($str)
    {
        $site_url = settings('site_url');
        $str = str_replace('src="/', 'src="'.$site_url, $str);
        $str = str_replace("src='/", "src='".$site_url, $str);
        $str = str_replace('<iframe', "<div class='flex-video widescreen'><iframe", $str);
        $str = str_replace('/iframe>', '/iframe></div>', $str);

        return $str;
    }

    /**
     * Method: static_url.
     *
     * @return string Static Url
     **/
    function static_url()
    {
        //return the static url
        $theme = settings('theme');
        $static_url = settings('site_url').'templates/'.$theme.'/assets/';
        echo $static_url;
    }

    function admin_url()
    {
        if (!settings('clean_urls')) {
            //return the admin url
            echo settings('site_url').'index.php/'.settings('admin_dir');
        } else {
            //return the admin url
            echo settings('site_url').settings('admin_dir');
        }
    }

    function get_date($date)
    {
        $ts = date('F jS, Y g:i a', strtotime($date));

        return $ts;
    }
