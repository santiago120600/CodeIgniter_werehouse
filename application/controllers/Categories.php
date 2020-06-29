<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_RootController {

    function __construct()
	{
        parent::__construct();
        $this->__validateSession();
        $this->load->model('DAO');
    }

    public function index()
	{
            $this->load->view('includes/header');
            $data_menu['categories_selected'] = true;
            $this->load->view('includes/menu',$data_menu);
            $this->load->view('includes/navbar');

            $data_container['container_data'] = $this->DAO->selectEntity('categories');
            $data_main['container_data'] = $this->load->view('categories/categories_data_page',$data_container,TRUE);
            $this->load->view('categories/categories_page',$data_main);
            $this->load->view('includes/footer_nav');
            $this->load->view('includes/footer_l');
            $this->load->view('categories/categories_js');
    }
    public function showCategoriesForm(){
        $data_view['action']=$this->input->get('action') ? $this->input->get('action') : 'new';
        if ($this->input->get('key')) {
            $data  = $this->DAO->selectEntity('categories',array('id_category'=>$this->input->get('key')),TRUE);
            $data_view['current_data'] = (array) $data;
        }
            echo $this->load->view('categories/categories_form',$data_view,TRUE);
    }

    public function showDataContainer()
    {        
        $data_container['container_data'] = $this->DAO->selectEntity('categories');
        echo $this->load->view('categories/categories_data_page',$data_container,TRUE);
    }

    public function saveOrUpdate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_category','Nombre','required|min_length[3]|max_length[50]');
        if ($this->form_validation->run()) {
            $data = array(
                "name_category" => $this->input->post('name_category'),
                "desc_category" => $this->input->post('desc_category')
            );
            $data_response = $this->DAO->saveOrUpdateEntity('categories',$data);
            echo json_encode($data_response);
        }
        else{
            $data['action'] = $this->input->post('form_action');
            $data['errors'] = $this->form_validation->error_array();
            $data['current_data'] = $this->input->post();
            $data_response = array(
                "status" => "warning",
                "message" => "Información incorrecta, valida los campos!",
                "data" =>  $this->load->view('categories/categories_form',$data,TRUE)
            );
            echo json_encode($data_response);
        }
    }

}
