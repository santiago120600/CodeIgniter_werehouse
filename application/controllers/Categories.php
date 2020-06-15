<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_RootController {

    function __construct()
	{
        parent::__construct();
        $this->__validateSession();
    }

    public function index()
	{
            $this->load->view('includes/header');
            $data_menu['categories_selected'] = true;
            $this->load->view('includes/menu',$data_menu);
            $this->load->view('includes/navbar');
            $this->load->view('categories/categories_page');
            $this->load->view('includes/footer_nav');
            $this->load->view('includes/footer_l');
            $this->load->view('categories/categories_js');
    }
    public function showCategoriesForm(){
        echo $this->load->view('categories/categories_form',null,TRUE);
    }

    public function saveOrUpdate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_category','Nombre','required[min_length[3]|max_length[50]');
        if ($this->form_validation->run()) {
            echo "registrado";
        }
        else{
            $data['errors'] = $this->form_validation->error_array();
            echo $this->load->view('categories/categories_form',$data,TRUE);
        }
    }


}
