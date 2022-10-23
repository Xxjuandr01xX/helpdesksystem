<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		/**
		 * funcion que hereda los metodos del CI_controller.
		**/
		parent::__construct();
		$helper_elements = array(
			"form" => "url"
		);
		$this->load->helper($helper_elements);
		$this->load->library('session');
	}

	public function index(){
		/**
		 * funcion para desplegar la pagina de de Login
		 * */
		$this->load->view('Login/login', array("titulo_pagina" => "SISTEMA HELPDESK - INICIAR SESSION"));
	}

	public function verificar(){
		/**
		 * funcion para verificar datos de usuario y redireccionar a la session.
		 **/
		$this->load->model('usuariosModel');
		$usuario   = $this->input->post('user_name');
		$password  = $this->input->post('user_pass');
		$resp      = "";
		$db_result_rows = $this->usuariosModel->get_data_user($usuario, $password)->num_rows();
		if($db_result_rows == 1){
			foreach($this->usuariosModel->get_data_user($usuario, $password)->result() as $data){
				$data_user = array(
					"id"		=> $data->id,
					"usuario"	=> $data->usuario,
					"rol"		=> $data->id_rol_fk
				);
				$this->session->set_userdata($data_user);
				redirect('tickets/index');
			}
		}else{
			$this->index();
		}
	}
}
