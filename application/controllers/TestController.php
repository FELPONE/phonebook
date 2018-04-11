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
       
        

    }

    public function index(){
        echo 'test';
    }

   

}
