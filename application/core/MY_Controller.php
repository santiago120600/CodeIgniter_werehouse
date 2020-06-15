<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_RootController extends CI_Controller {

    function __construct()
	{
		parent::__construct();
    }
    
    public function __validateSession(){
        $session = $this->session->userdata('store_sess');
        if (!@$session->user_email) {
            redirect('login');
        }
    }

    public function index()
	{
		$this->load->view('welcome_message');
	}
    

}