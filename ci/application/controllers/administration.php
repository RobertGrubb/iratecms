<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * IrateCMS v3.0.X
 **/

class Administration extends Admin_Controller
{
    //Setup a Template Directory:
    public $admin_template_dir = '';

    /**
     * Class Constructor.
     **/
    public function __construct()
    {
        //Call the parent constructor
        parent::__construct();
        //Load the form validation library.
        $this->load->library('form_validation');
        //Load the admin cp model:
        $this->load->model('administration/cp_core');
        //Load the BBCode helper
        $this->load->helper('misc/bbcode');
    }

    /**
     * Administration Index Method.
     **/
    public function index()
    {
        //Check if the current session is logged in
        if ($this->session->userdata('logged_in')) {
            //Check if the user is an admin.
            if (!$this->acl->accesscp()) {
                //If they are not an admin, show the no privelages error
                $this->load->view($this->admin_template_dir.'errors/no_privs.php');
            }
            //If the user is an admin:
            else {
                //Load the admin index.
                $this->load->view($this->admin_template_dir.'admin_index.php');
            }
        }
        //If the session is not logged in:
        else {
            $this->session->set_flashdata('redirect', '/administration/');
            redirect('user/login', 'refresh');
        }
            //Show the login box
    }

    /**
     * -------------------------------------------------------------------------------
     * ADMINISTRATION PAGE METHODS
     * -------------------------------------------------------------------------------.
     **/
    public function maintenance()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_maintenance');
            //If the method returns false,
            if (!$this->cp_maintenance->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    public function fpage()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_fpage');
            //If the method returns false,
            if (!$this->cp_fpage->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    public function sidebars()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_sidebars');
            //If the method returns false,
            if (!$this->cp_sidebars->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    public function store()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_store');
            //If the method returns false,
            if (!$this->cp_store->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    public function videos()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_videos');
            //If the method returns false,
            if (!$this->cp_videos->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    public function logs()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_logs');
            //If the method returns false,
            if (!$this->cp_logs->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    public function sitenav()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_sitenav');
            //If the method returns false,
            if (!$this->cp_sitenav->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * USERGROUP PAGES:
     * ------------------------------------------.
     **/
    public function users()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_users');
            //If the method returns false,
            if (!$this->cp_users->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * USERGROUP PAGES:
     * ------------------------------------------.
     **/
    public function usergroups()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_usergroups');
            //If the method returns false,
            if (!$this->cp_usergroups->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * SETTINGS PAGES:
     * ------------------------------------------.
     **/
    public function settings()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        }
        //If the user does have access.
        else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_settings');
            //If the method returns false,
            if (!$this->cp_settings->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * DOCUMENTS PAGES:
     * ------------------------------------------.
     **/
    public function pages()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_pages');
            //If the method returns false,
            if (!$this->cp_pages->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * FORUMS PAGES:
     * ------------------------------------------.
     **/
    public function forums()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_forums');
            //If the method returns false,
            if (!$this->cp_forums->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * GALLERIES PAGES:
     * ------------------------------------------.
     **/
    public function galleries()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_galleries');
            //If the method returns false,
            if (!$this->cp_galleries->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * SHOUTBOX PAGES:
     * ------------------------------------------.
     **/
    public function shoutbox()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_shoutbox');
            //If the method returns false,
            if (!$this->cp_shoutbox->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * TICKET PAGES:
     * ------------------------------------------.
     **/
    public function tickets()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_tickets');
            //If the method returns false,
            if (!$this->cp_tickets->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * TICKET PAGES:
     * ------------------------------------------.
     **/
    public function tournaments()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_tourneys');
            //If the method returns false,
            if (!$this->cp_tourneys->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * CP NEWS PAGES:
     * ------------------------------------------.
     **/
    public function cpnews()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_cpnews');
            //If the method returns false,
            if (!$this->cp_cpnews->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * SITE NEWS PAGES:
     * ------------------------------------------.
     **/
    public function snews()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_snews');
            //If the method returns false,
            if (!$this->cp_snews->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * BLOGS PAGES:
     * ------------------------------------------.
     **/
    public function blogs()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_blogs');
            //If the method returns false,
            if (!$this->cp_blogs->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

    /**
     * ------------------------------------------
     * PLATFORM MANAGEMENT PAGES:
     * ------------------------------------------.
     **/
    public function platforms()
    {
        //Calling this method will check  if the user
        //can access the cp based on their usergroup.
        //This will automatically exit the script if it
        //returns false.
        if (!$this->acl->accesscp()) {
            $this->load->view($this->admin_template_dir.'errors/no_privs.php');
        } else {
            //Load the model for this admin area.
            $this->load->model('administration/cp_platforms');
            //If the method returns false,
            if (!$this->cp_platforms->process()) {
                //Return an error.
                $this->cp_core->error('Not enough access');
            }
        }
    }

        /**
         * -------------------------------------------------------------------------------
         * ADMINISTRATION TEMPLATE METHODS
         * -------------------------------------------------------------------------------.
         **/
        /**
         * Administration Frontpage.
         **/
        public function frontpage()
        {
            //Calling this method will check  if the user
            //can access the cp based on their usergroup.
            //This will automatically exit the script if it
            //returns false.
            if (!$this->acl->accesscp()) {
                //Load the no privelages view file:
                $this->load->view($this->admin_template_dir.'errors/no_privs.php');
            } else {
                //Get the Number of Users:
                $uq = $this->db->get('users');
                //Get the Number of rows:
                $data['num_users'] = $uq->num_rows();
                //Get the admin news:
                $this->db->order_by('date', 'desc');
                $acp_news = $this->db->get('acp_news');
                $data['news'] = $acp_news->result_array();
                //Get Members today:
                $mtq = $this->db->query('SELECT * FROM users WHERE created >= CURDATE() AND created < (CURDATE() + INTERVAL 1 DAY)');
                $data['mems_today'] = $mtq->num_rows();
                //Load the front page
                $this->load->view($this->admin_template_dir.'pages/frontpage.php', $data);
            }
        }

        /**
         * Administration Navigation.
         **/
        public function navigation()
        {
            //Calling this method will check  if the user
            //can access the cp based on their usergroup.
            //This will automatically exit the script if it
            //returns false.
            if (!$this->acl->accesscp()) {
                $this->load->view($this->admin_template_dir.'errors/no_privs.php');
            } else {
                //Get the navigation sections:
                $nq = $this->db->query('SELECT * FROM acp_nav_sections ORDER BY orderid ASC');
                //set the information to a variable:
                $nav = $nq->result_array();
                //Run through each section
                foreach ($nav as $key => $row) {
                    //Set where clause:
                    $this->db->where('secid', $row['id']);
                    $this->db->order_by('orderid', 'ASC');
                    //Retrieve the links from the database
                    $linkq = $this->db->get('acp_nav_links');
                    //Set the information to a sub-array of the navigation sections:
                    $row['links'] = $linkq->result_array();
                    $nav[$key] = $row;
                }
                $data['nav'] = $nav;
                //Load the navigation
                $this->load->view($this->admin_template_dir.'globals/admin_navigation.php', $data);
            }
        }

        /**
         * Administration Header.
         **/
        public function header()
        {
            //Calling this method will check  if the user
            //can access the cp based on their usergroup.
            //This will automatically exit the script if it
            //returns false.
            if (!$this->acl->accesscp()) {
                //Load the no privelages view file:
                $this->load->view($this->admin_template_dir.'errors/no_privs.php');
            } else {
                //Load the header bar.
                $this->load->view($this->admin_template_dir.'globals/admin_headerbar.php');
            }
        }

    public function error($message)
    {
        echo $message;
    }
    /*
     * -------------------------------------------------------------------------------
     * END ADMINISTRATION TEMPLATE METHODS
     * -------------------------------------------------------------------------------
     **/
}
