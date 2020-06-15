<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->_isLoggin();
		$this->load->view('login_page');
	}

	public function auth(){
		$this->_isLoggin();
		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pEmail','Email','required');
			$this->form_validation->set_rules('pPassword','Password','required');
			if ($this->form_validation->run() == FALSE) {
				$error_msg = "Usuario y/o Contraseña no enviados";
				$this->session->set_flashdata('error_msg',$error_msg);
				redirect('');
			}else {
				//Metio los datos correctamente
				$this->load->model('DAO');
				$user_exists = $this->DAO->login($this->input->post('pEmail'),$this->input->post('pPassword'));
				//Si se introduce user y pass correctos
				if ($user_exists['status'] == 'success') {
					$this->session->set_userdata('store_sess',$user_exists['data']);
					redirect('home');
				}else{
					//Regresar el error
					$this->session->set_flashdata('error_msg',$user_exists['message']);
					redirect('');
				}
			}
		}else{
			$error_msg = "Usuario y/o Contraseña no enviados";
			$this->session->set_flashdata('error_msg',$error_msg);
			redirect('');
		}
	}

	public function logout(){
		$this->session->unset_userdata('store_sess');
		redirect('','refresh');
	}

	function _isLoggin(){
		$session = $this->session->userdata('store_sess');
		if (@$session->user_email) {
			redirect('home');
		}
	}
}
