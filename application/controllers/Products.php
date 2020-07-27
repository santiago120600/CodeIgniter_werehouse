<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_RootController {

	function __construct()
	{
        parent::__construct();
        $this->__validateSession();
        $this->load->model('DAO');

    }
    
    public function index(){
        redirect('products/initial');
    }

    public function initial($category_id = null){
        //Se mandó un id
        if ($category_id) {
            //Checar si el id de la categoria existe 
            $category_exists = $this->DAO->selectEntity('categories',array('id_category'=>$category_id),TRUE); 
            if ($category_exists) {
                $data_container['category_selected'] = $category_exists;
                $data_container['products_data'] = $this->DAO->selectEntity('producto',array('category_id'=>$category_id));
                
                $data_js['category_selected'] = $category_id;
            }else{
                //No existe el id en la BD
                redirect('categories');
            }
            
        }else {
            //No se mandó un id 
            //Mostrar todos los productos
            $data_container['products_data'] = $this->DAO->selectEntity('producto');
            $data_js['category_selected'] = null;


        }
        $this->load->view('includes/header');
        $data_menu['products_selected'] = true;
        $this->load->view('includes/menu',$data_menu);
        $this->load->view('includes/navbar');

        $data_main['container_data'] = $this->load->view('products/products_data_page',$data_container,TRUE);
        $this->load->view('products/products_page',$data_main);

        $data_footer_nav['modal_size'] = "modal-lg";
        $this->load->view('includes/footer_nav',$data_footer_nav);
        $this->load->view('includes/footer_l');
        $this->load->view('products/products_js',$data_js);
    }

    public function showProductForm(){
        //si mando un id traer la categoria con ese id
        if ($this->input->get('category_id')) {
            $data_view['category_exists'] = $this->DAO->selectEntity('categories',array('id_category'=>$this->input->get('category_id')),TRUE);
        }else {
            //traer todas las categorias si no viene id
            $data_view['category_list'] = $this->DAO->selectEntity('categories');
        }
        $data_view['action']=$this->input->get('action') ? $this->input->get('action') : 'new';
        if ($this->input->get('key')) {
            $data  = $this->DAO->selectEntity('producto',array('id_producto'=>$this->input->get('key')),TRUE);
            $data_view['current_data'] = (array) $data;
        }
            echo $this->load->view('products/products_form',$data_view,TRUE);
    }

    public function saveOrUpdate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_product','Nombre','required|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('sell_product','Precio Venta','required|decimal');
        $this->form_validation->set_rules('buy_product','Precio Venta','required|decimal');
        //Pendiente validar que exista
        $this->form_validation->set_rules('category','Categor&iacute;a','required');

        $this->form_validation->set_rules('prod_picture','pic','callback_valid_pic');
        if ($this->form_validation->run()) {
            //lo va a hacer new y edit
            if ($this->input->post('form_action') != "delete") {
                $uploaded_file = false;
                //si es nuevo guardar
                if ($this->input->post('form_action')== 'new') {
                    $config['upload_path']          = './uploads/products';
                    $config['allowed_types']        = 'jpg|png';
                    $config['max_size']             = 2048;
                    $config['file_name'] = time();    
                    $this->load->library('upload',$config);

                    $uploaded_file = $this->upload->do_upload('prod_picture');
                }

                //Si se subio la imagen y es un nuevo registro, guardar
                if ($uploaded_file && $this->input->post('form_action')== 'new') {
                    $data = array(
                        "icon_product" => $this->upload->data()['file_name'],
                        "name_product" => $this->input->post('name_product'),
                        "price_sell_product" => $this->input->post('sell_product'),
                        "price_buy_product" => $this->input->post('buy_product'),
                        "desc_product" => $this->input->post('desc_product'),
                        "category_id" => $this->input->post('category')
                    );
                }else if(!$uploaded_file && $this->input->post('form_action')== 'new'){
                    //si no se guardo la imagen
                    $data_response = array(
                        "status" => "error",
                        "message" => "Error al subir la foto",
                        "data" =>  $this->load->view('products/products_form',$data,TRUE)
                    );
                    echo json_encode($data_response);
                }else{
                    //Editar
                    $data = array(
                        "name_product" => $this->input->post('name_product'),
                        "price_sell_product" => $this->input->post('sell_product'),
                        "price_buy_product" => $this->input->post('buy_product'),
                        "desc_product" => $this->input->post('desc_product'),
                        "category_id" => $this->input->post('category')
                    );
                }
            }else {
                $data = array(
                    "status_product" => "Inactive"
                );
            }
            //Edit
            if ($this->input->post('form_action') != 'new') {
                $where_clause = array('id_producto'=> $this->input->post('id_producto'));
            }else {
                $where_clause=array();
            }
            $data_response = $this->DAO->saveOrUpdateEntity('producto',$data,$where_clause);
            echo json_encode($data_response);
        }
        else{   

            //Para que siga apareciendo la categoria si los datos en el formulario fueron incorrectos
            if ($this->input->post('category')) {
                $data['category_exists'] = $this->DAO->selectEntity('categories',array('id_category'=>$this->input->get('category_id')),TRUE);
            }else {
                //traer todas las categorias si no viene id
                $data['category_list'] = $this->DAO->selectEntity('categories');
            }


            $data['action'] = $this->input->post('form_action');
            $data['errors'] = $this->form_validation->error_array();
            $data['current_data'] = $this->input->post();
            $data_response = array(
                "status" => "warning",
                "message" => "Información incorrecta, valida los campos!",
                "data" =>  $this->load->view('products/products_form',$data,TRUE)
            );
            echo json_encode($data_response);
        }
    }

    function valid_pic($value){
        if (empty($_FILES['prod_picture']['name'])) {
            if ($this->input->post('id_producto')) {
                return true;
            }else {
                $this->form_validation->set_message('valid_pic','The {field} is required');
                return false;
            }
        }
        else{
            return true;
        }
    }

}
