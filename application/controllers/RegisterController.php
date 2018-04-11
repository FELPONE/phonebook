<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegisterController extends CI_Controller
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
        isset($_SESSION['logged_in']) ? redirect('/contact') : null;
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('UserModel');
        $this->load->helper('form');
        $this->load->library('form_validation');

    }

    /**
     * Register function.
     *
     * @access public
     * @return void
     */
    public function register()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[user.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', array('is_unique' => 'This mail already exists. Please choose another one.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() === false) {

            $this->load->view('templates/header');
            $this->load->view('auth/register/register_view');
            $this->load->view('templates/footer');

        } else {

            $username = $this->input->post('username');
            $email    = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->usermodel->create_user($username, $email, $password)) {

                $this->session->set_flashdata('msg', 'Succesfully registrated, you can now log in!');
                $this->load->view('templates/header');
                $this->load->view('auth/login/login_view');
                $this->load->view('templates/footer');

            } else {

                $this->session->set_flashdata('msg', 'There was a problem creating your new account. Please try again!');

                $this->load->view('templates/header');
                $this->load->view('auth/register/register_view');
                $this->load->view('templates/footer');

            }

        }

    }

}
