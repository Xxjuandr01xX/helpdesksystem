<?php

use SebastianBergmann\Type\NullType;

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {
	public function __construct(){
		###controlador para gestionar registro de insidencias y seguimiento
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array(
			"form" => "url"
		));
	}

	public function index(){
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('tickets/list',[
			"pagina" => "GESTION DE TICKETS"
		]);
	}

	public function save_ticket(){
		$this->load->model('ticketsModel');
		$titulo  	  = $this->input->post('titulo');
		$fec_ini 	  = $this->input->post('fec_ini');
		$fec_fin 	  = $this->input->post('fec_fin');
		$descripcion  = $this->input->post('description');
		$user         = $this->input->post('user_select');
		$client       = $this->input->post('client_select');


		if($titulo == '' || $titulo == null){
			$this->alert_window('warning', 'Asegurece de llenar el titulo Correctamente !', 'info-fill', 'Warning');
		}else if($fec_ini == ''){
			$this->alert_window('warning', 'Asegurece colocar un a fecha de inicio !', 'info-fill', 'Warning');
		}else if($fec_fin == ''){
			$this->alert_window('warning', 'Asegurece colocar una fecha de fin !', 'info-fill', 'Warning');
		}else if($descripcion == ''){
			$this->alert_window('warning', 'Asegurece colocar una descripcion para el ticket !', 'info-fill', 'Warning');
		}else if($user == 0){
			$this->alert_window('warning', 'Asegurece asignar a un tecnico ', 'info-fill', 'Warning');
		}else if($client == 0){
			$this->alert_window('warning', 'Asegurece asignar a un tecnico ', 'info-fill', 'Warning');
		}else{
			if($this->Tickets->save($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client) == true){
				$this->index();
			}else{
				$this->alert_window('danger', 'Error al ingresar datos, por favor vuelva a intentar', 'exclamation-triangle-fill', 'Danger');
			}
		}
	}

	public function alert_window($type, $mensaje, $icon, $arial_label){
		/**
		 * Metodo para lanzar mensajes de alerta
		 * @var $type puede ser primary, success, danger, warning.
		 * @var $mensaje cualquier mensaje que se quiera decir.
		 * @var $icon son (info-fill, check-circle-fill, exclamation-triangle-fill, exclamation-triangle-fill).
		 * @var $arial_label son (Info, Success, Warning, Danger).
		 **/
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('dashboard/alertWindow', array(
			"type"    		=> $type,
			"mensaje" 		=> $mensaje,
			"arial_label" 	=> $arial_label,
			"icon"    		=> $icon 
		));
	}

	public function newTicket(){
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('tickets/new-ticket',[
			"pagina" => "REGISTRAR UN NUEVO TICKET"
		]);	
	}
}