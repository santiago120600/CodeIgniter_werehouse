<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_RootController {

    function __construct(){
        parent::__construct();
        $this->__validateSession();
    }

	public function index()
	{
            $this->load->view('includes/header');
            $this->load->view('includes/menu');
            $this->load->view('includes/navbar');
            $this->load->view('home_page');
            $this->load->view('includes/footer_nav');
            $this->load->view('includes/footer_l');
    }

}
