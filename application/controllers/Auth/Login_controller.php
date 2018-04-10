<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
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
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('user_model');
        $this->load->helper('form');

    }

    /**
     * login function.
     *
     * @access public
     * @return void
     */
    public function login()
    {

        isset($_SESSION['logged_in']) ? redirect('/contact') : null;

        $data = new stdClass();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header');
            $this->load->view('auth/login/login_view');
            $this->load->view('templates/footer');

        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->user_model->resolve_user_login($username, $password)) {

                $user_id = $this->user_model->get_user_id_from_username($username);
                
                $user = $this->user_model->get_user($user_id);
               
                $_SESSION['user_id']   = (int) $user->id;
                $_SESSION['username']  = (string) $user->username;
                $_SESSION['logged_in'] = (bool) true;

                redirect('/contact');

            } else {

            	$this->session->set_flashdata('msg', 'Wrong username or password!');
                $this->load->view('templates/header');
                $this->load->view('auth/login/login_view');
                $this->load->view('templates/footer');

            }
        }

    }

    /**
     * logout function.
     *
     * @access public
     * @return void
     */
    public function logout()
    {
        $data = new stdClass();

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);

            }
        }

        redirect('/login');
    }

}
