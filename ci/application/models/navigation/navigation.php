<?php
    /**
     * --------------------------------------
     * @file: navigation.php
     * @since: Version 1.0
     * @description: Handles all methods that
     * deal with the site navigation.
     * --------------------------------------
     **/
	class navigation extends CI_Model
	{
       /**
        * Method: general links
        * This will output the general
        * links to the navigation bar.
        * Ex. Forums, Support.
        **/
       public function general_links()
       {
           //Setup an output variable:
           $output = null;
           //Set the order_by
           $this->db->order_by('orderid', 'ASC');
           //Get the navigation sections
           $nav_secq = $this->db->get("nav_sections");
           //Get the data from it.
           $nav_secr = $nav_secq->result_array();
           //Go through each return
           foreach($nav_secr as $section)
           {
               //Set the where clause
               $this->db->where('secid', $section["id"]);
               //Set the order by
               $this->db->order_by('orderid', 'ASC');
               //Get the nav links.
               $nav_linksq = $this->db->get("nav_links");
               //If we have sub section
               if($nav_linksq->num_rows() >= 1)
               {
                   //Set the drop class
                   $dropclass = " dropdown";
                   $drop_essentials = ' class="dropdown-toggle" data-toggle="dropdown"';
                   $caret = ' <span class="caret"></span>';
              }
               //If we dont have any sub-links:
               else
               {
                   //Set the drop class to nothing.
                   $dropclass = null;
                   $drop_essentials = null;
                   $caret = null;
               }

               //Here, we are setting up the actual navigation.
               //This is the actual button.
               $output .= '<li class="' . $dropclass . '">
                              <a href="' . $this->construct_link($section["href"]) . '"' . $drop_essentials . '>
                                  ' . $section["title"] . $caret .'
                              </a>';
               //Check the number of rows
               if($nav_linksq->num_rows() >= 1)
               {
                   //If there are sub-links,
                   //Start another UL inside of the
                   //parent.
                   $output .= '<ul class="dropdown-menu">';
                   //Setup the information to a variable:
                   $nav_linkr = $nav_linksq->result_array();
                   //Go through each return
                   foreach($nav_linkr as $link)
                   {
                       //Create a LI tag for each return.
                       $output .= '<li>
                                       <a href="' . $this->construct_link($link["href"]) . '">
                                           ' . $link["title"] . '
                                       </a>
                                   </li>'; 
                   }
                   //Close the Sub-UL
                   $output .= '</ul>';
               }
               //Close the parent LI.
               $output .= '</li>';
           }
           //Return the new information
           return $output;
       }
       /**
        * Method: general links
        * This will output the general
        * links to the navigation bar.
        * Ex. Forums, Support.
        **/
       public function footer_links()
       {
           //Setup an output variable:
           $output = null;
           //Set the order_by
           $this->db->order_by('orderid', 'ASC');
           //Get the navigation sections
           $nav_secq = $this->db->get("nav_sections");
           $num_navs = $nav_secq->num_rows();
           //Get the data from it.
           $nav_secr = $nav_secq->result_array();
           //Go through each return
           $count = 1;
           $initial = true;
           $max = 7;
           for($i = -1; $i < $num_navs; $i++)
           {
               if($i > $max)
               {
                 break;
               }
               if($count == 1)
               {
                  $output .= '<ul class="pre-footer-nav">';
               }
               if($initial == true)
               {
                    $output .= '<li>
                              <a href="' . base_url() . '">
                                  Home
                              </a></li>';
                    $initial = false;
               }else {
                    //Here, we are setting up the actual navigation.
                   //This is the actual button.
                   $output .= '<li>
                                  <a href="' . $this->construct_link($nav_secr[$i]["href"]) . '">
                                      ' . $nav_secr[$i]["title"] . '
                                  </a></li>';
                               
               }
               
               if($i == ($num_navs - 1))
               {
                  $output .= '</ul>';
               }

               //Close the parent LI
               if ($count == 3) {
                  $output .= '</ul>'; 
                  $count = 1; 
               }
               elseif($i == $max){
                  $output .= '</ul>'; 
               }else{
                  $count++;
               }
           }
           //Return the new information
           return $output;
       }
       
       /**
        * Method: construct link
        * This method will construct the
        * links according to the href given,
        * plus if clean urls are enabled or not.
        **/
       public function construct_link($href)
       {
           //If the href does not contain the http
           //portion of the link, then we are lead
           //to believe it's an internal link.
           if(strpos($href, 'http://') !== 0) {
               //If we are not using clean urls:
               if(!settings('clean_urls'))
                   //Include code igniters index.php/ in the link
                   return settings('site_url') . "index.php/" . $href;
               //If we are using clean urls:
               else
                   //Return just the site url, and the URI.
                   return settings('site_url') . $href; 
           } 
           //If the href contains the http portion of the
           //link, then we will consider it an external
           //link and send them there.
           else 
           {
               //Return the full link as is.
               return $href;
           } 
       }
    }
?>