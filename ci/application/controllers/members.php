<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * IrateCMS v3.0.X
 **/
class Members extends MY_Controller
{
    //Setup a Template Directory:
    public $members_template_dir = 'members/';
    /**
     * Class Constructor.
     **/
    public function __construct()
    {
        //Call the parent constructor
        parent::__construct();
    }
/**
 * Method: view
 * Displays a specific
 * document to the user.
 **/
    // This function will handle the members_list_page
    public function view()
    {
        //Load the pagination library:
        $this->load->library('pagination');
        //Configure Pagination:
        //----------------------------------------
            //Set the base url
            $config['base_url'] = settings('site_url').'members/view/';
            //set the URI Segment.
            $config['uri_segment'] = 3;
            //Whether we are using page numbers
            $config['use_page_numbers'] = false;
            //Set opening tag for selected page
            $config['cur_tag_open'] = '<a href="#" class="pagination-selected">';
            //Set closing tag for selected page
            $config['cur_tag_close'] = '</a>';
            //Do the query so we can get the total number of rows.
            $uq = $this->db->query('SELECT * FROM users');
            //Set the total rows
            $config['total_rows'] = $uq->num_rows();
            //Set the items per page.
            $config['per_page'] = 20;
            //Set the current page:
            $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
            //Set the Limit for the query:
            //$limit = ($page * $this->replies_per_page);
            //Initialize the pagination script.
            $this->pagination->initialize($config);
        //----------------------------------------
        $this->db->limit($config['per_page'], $page);
        $this->db->order_by('username', 'ASC');
        //Pull all the users from the Database
        $ulist = $this->db->get('users');
        //Set the users information into a array
        $data['info'] = $ulist->result_array();
        //Load the template
        $this->load->view($this->members_template_dir.'members_list.php', $data);
    }

    // This function will handle the members_search_page
    public function search()
    {
        //Load the pagination library:
            $this->load->library('form_validation');
            //Set a data variable
            $data = null;
            //Set show results as false.
            $data['show_results'] = false;
            //Set Validation Rules:
            //-----------------------------------------------
            $this->form_validation->set_rules('value', 'Value', 'required');
            //-----------------------------------------------
            //If the form validation was successful.
            if ($this->form_validation->run()) {
                //Set show results to true
                $data['show_results'] = true;
                //Set the search type
                $search_type = $this->input->post('search_type');
                //Get the value
                $value = $this->input->post('value');
                //set the search value to the data array
                $data['search_value'] = $value;
                //Get the user information
                $uq = $this->db->query('SELECT * FROM users WHERE '.$this->db->escape($search_type)." LIKE '%".$this->db->escape($value)."%' ORDER BY id ASC");

                //Set the user information to the data array
                $data['users'] = $uq->result_array();
            }
        //Load the template
        $this->load->view($this->members_template_dir.'members_search.php', $data);
    }
}
