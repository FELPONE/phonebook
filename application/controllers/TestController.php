<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestController extends CI_Controller
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
        $this->load->model('usermodel');
        $this->load->helper('form');

    }

    public function index(){
        echo 'test';
    }

   

}
