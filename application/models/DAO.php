<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DAO extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function login($email,$password){
        /*
        1.- Consultar que el usuaio exista por email,
        2(3) Validar la constraseña
        3(2) Validar el estatus
        */
        $this->db->where('user_email',$email);
        $query = $this->db->get('users');
        $user_exists = $query->row();
        if ($user_exists) {
            //bcrypt par encriptar
            if ($user_exists->user_status == 'Inactive') {
                return array(
                    "status" => "error",
                    "message" => "La cuenta actualmente se encuentra inactiva, contacta al administrador para más información"
                );
            }
            if ($user_exists->user_password == $password) {
                $this->db->where('user_id',$user_exists->user_id);
                $query = $this->db->get('session_vw');
                return array(
                    'status' => 'success',
                    'message' => 'Usuario cargado correctamente',
                    'data' => $query->row()
                );
            }else {
                return array(
                    'status' => 'error',
                    'message' => 'La contraseña ingresada es incorrecta'
                );
            }
        }else{
            return array(
                'status' => 'error',
                'message' => 'correo no encontrado'
            );
        }
    }

    function saveOrUpdateEntity($entityName,$data,$whereClause = array()){
        //validar que el arreglo contenga info
        if ($whereClause) {
            $this->db->where($whereClause);
            $this->db->update($entityName,$data);
        }else{
            $this->db->insert($entityName,$data);
        }
        if ($this->db->error()['message'] != '') {
            return array(
                "status" => "error",
                "message" => $this->db->error()['message']
            );
        }else{
            return array(
                "status" => "success",
                "message" => $whereClause ? 'Datos Actualizados correctamente' : 'Datos Registrados correctamente'
            );
        }

    }

    function selectEntity($entityName,$whereClause= array(),$isUnique = FALSE){
        if($whereClause){
            $this->db->where($whereClause);
        }
        $query = $this->db->get($entityName);
        if($this->db->error()['message'] != ''){
            return $isUnique ? null : array();
        }else{
            return $isUnique ? $query->row(): $query->result();
        }
    }
}
