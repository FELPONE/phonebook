<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ContactController extends CI_Controller
{

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        isset($_SESSION['logged_in']) ? null : redirect('/login');
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('ContactModel');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    /**
     * Display contacts
     *
     * @access public
     * @return Response
     */
    public function index()
    {

        $this->form_validation->set_rules('search', 'Search', 'trim');

        $data           = array();
        $limit_per_page = 15;

        $this->form_validation->run();
        $search        = $this->ContactModel->searchterm_handler($this->input->post('search', true));

        $total_records = $this->ContactModel->get_total($search);

        $page = ($this->uri->segment(2)) ? ($this->uri->segment(2) - 1) : 0;

        if ($total_records > 0) {

            $data['data'] = $this->ContactModel->getContacts($limit_per_page, $page * $limit_per_page, $search);
            

            $config['base_url']    = base_url() . 'contact';
            $config['total_rows']  = $total_records;
            $config['per_page']    = $limit_per_page;
            $config["uri_segment"] = 2;
            $config['num_links']          = 2;
            $config['use_page_numbers']   = true;
            $config['reuse_query_string'] = true;
            $config['full_tag_open']   = '<div class="pagging text-center"><nav><ul class="pagination">';
            $config['full_tag_close']  = '</ul></nav></div>';
            $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']   = '</span></li>';
            $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']   = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
            $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['prev_tag_close']  = '</span></li>';
            $config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
            $config['first_tag_close'] = '</span></li>';
            $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['last_tag_close']  = '</span></li>';

            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
        }

        $this->load->view('templates/header');
        $this->load->view('contact/contact_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Create a new contact.
     *
     * @access public
     * @return Response
     */
    public function create()
    {

        $data = array();

        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric|max_length[20]');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('note', 'Note', 'trim|max_length[255]');

        if ($this->form_validation->run() === false) {

            $this->load->view('templates/header');
            $this->load->view('contact/contact_create_view');
            $this->load->view('templates/footer');

        } else {

            $data['name']         = $this->input->post('name');
            $data['last_name']    = $this->input->post('last_name');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['note']         = $this->input->post('note');
            $data['user_id']      = $_SESSION['user_id'];
            $data['created_at']   = date('Y-m-j H:i:s');

            if ($this->ContactModel->insert($data)) {

                $this->session->set_flashdata('msg', 'Contact created!');
                redirect(base_url('contact'));

            } else {

                $this->session->set_flashdata('msg', 'There was a problem creating your new contact. Please try again!');
                redirect(base_url('contact'));

            }
        }
    }

    /**
     * Update a contact.
     *
     * @access public
     * @return Response
     */
    public function update($id)
    {

        if(! $this->hasPermission($id)) redirect('contact');

        $data = array();

        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric|max_length[20]');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('note', 'Note', 'trim|max_length[255]');
        $id = $this->uri->segment(2);

        if ($this->form_validation->run() == false) {

            $contact = $this->ContactModel->getContactById($id);
            $this->load->view('templates/header');
            $this->load->view('contact/contact_update_view', $contact);
            $this->load->view('templates/footer');

        } else {

            $data['name']         = $this->input->post('name');
            $data['last_name']    = $this->input->post('last_name');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['note']         = $this->input->post('note');
            $data['user_id']      = $_SESSION['user_id'];
            $data['updated_at']   = date('Y-m-j H:i:s');

            if ($this->ContactModel->update($data, $id)) {

                $this->session->set_flashdata('msg', 'Contact updated!');
                redirect(base_url('contact'));

            } else {

                $this->session->set_flashdata('msg', 'There was a problem updating your contact. Please try again.');
                redirect(base_url('contact'));

            }

        }
    }

    /**
     * Delete a contact.
     *
     * @access public
     * @return Response
     */
    public function delete($id)
    {
        $id   = $this->uri->segment(2);
        if(! $this->hasPermission($id)) redirect('contact');
        $item = $this->ContactModel->delete($id);
        $this->session->set_flashdata('msg', 'Contact deleted!');
        redirect('contact');
    }

    /**
     * Unset session variable searchterm
     *
     * @access public
     * @return Response
     */
    public function reset_search()
    {
        $this->session->unset_userdata('searchterm');
        redirect(base_url('contact'));

    }

    /**
     * Check if the user has permission on contact.
     *
     * @access public
     *
     * @param int $id
     * @return Response
     */
    public function hasPermission($id)
    {
        $contact = $this->ContactModel->getContactById($id);

        if($contact['user_id'] == $_SESSION['user_id']) return TRUE;

        return FALSE;
    }

}
