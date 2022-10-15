<?php

use SebastianBergmann\Type\NullType;

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {
	public function __construct(){
		###controlador para gestionar registro de insidencias y seguimiento
		parent::__construct();
		$this->load->library('session');
		$this->load->library('funciones');
		$this->load->helper(array(
			"form" => "url"
		));
	}

	public function set_border_row($id_status){
		/**
		 * Funcion para marcar bordes de una celda
		 * */
		$border_class = "";
		if($id_status == 1){
			$border_class = "border-left-warning";
		}else if($id_status == 2){
			$border_class = "border-left-danger";
		}else if($id_status == 3){
			$border_class = "border-left-success";
		}else if($id_status == 4){
			$border_class = "border-left-warning";
		}

		return $border_class;
	}

	public function set_btn_status($id_status){
		/**
		 * Funcion para crear un boton con el status de la insidencia.
		 * */
		$this->load->model("ticketsModel");
		$btn = "";
		if($id_status == 1){
			$btn = "<button class = 'shadow btn btn-sm rounded-pill btn-warning'>".$this->ticketsModel->get_name_status($id_status)."</button>";
		}else if($id_status == 2){
			$btn = "<button class = 'shadow btn btn-sm rounded-pill btn-danger'>".$this->ticketsModel->get_name_status($id_status)."</button>";
		}else if($id_status == 3){
			$btn = "<button class = 'shadow btn btn-sm rounded-pill btn-success'>".$this->ticketsModel->get_name_status($id_status)."</button>";
		}else if($id_status == 4){
			$btn = "<button class = 'shadow btn btn-sm rounded-pill btn-'warning>".$this->ticketsModel->get_name_status($id_status)."</button>";
		}

		return $btn;
	}

	public function index(){
		$this->load->model("ticketsModel");
		$this->load->model("Usuarios");
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		####Pasando datos a la vista para la tabla de tickets
		$i = 0;
		$resultSet = [];
		foreach ($this->ticketsModel->get_data_tickets()->result() as $x) {
			$tableString = "<tr>";
			$i++;
			$tableString .= "<td class = '".$this->set_border_row($x->id_status_fk)."'><b>".$i."</b></td>";
			$tableString .= "<td><b>".$x->codigo."</b></td>";
			$tableString .= "<td>".$x->titulo."</td>";
			$tableString .= "<td>".$this->ticketsModel->set_sql_label($x->fecha_ini)."</td>";
			$tableString .= "<td>".$this->Usuarios->get_name_user($x->id_usuario_solicitante)."</td>";
			$tableString .= "<td>".$this->Usuarios->get_name_user($x->id_usuario_soporte)."</td>";
			$tableString .= "<td>".$this->set_btn_status($x->id_status_fk)."</td>";
			$tableString .= "<td>".
				"<div class='btn-group rounded-pill'>".
					"<a href = '".base_url()."index.php/tickets/asig_ticket' class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-exchange-alt'></a>".
					"<a href = '".base_url()."index.php/tickets/rm_ticket/".$x->codigo."' class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-trash-alt'></a>".
					"<a href = '".base_url()."index.php/tickets/edit_ticket' class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-edit'></a>".
				"</div>"
			."</td>";
			$tableString .= "</tr>";
			$resultSet[] = $tableString;
		}
		####Cargando la vista 
		$this->load->view('tickets/list',[
			"pagina"  => "GESTION DE TICKETS",
			"tickets" => $resultSet,
		]);
	}

	public function rm_ticket($cod){
		/**
		 *  Funcion para desplegar vista de alerta para eliminar ticket
		 * */
		$cod_ticket = $this->input->get('cod');
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario,
			"codigo"   => $cod
		]);
		$this->load->view('tickets/remove_alert',["pagina"  => "ELIMINAR TICKET"]);
	}

	public function drop_ticket($cod){
		$this->load->model('ticketsModel');
		if($this->ticketsModel->drop($cod) == true){
			$this->index();
		}else{
			$this->alert_window('danger', 'Error al eliminar ticket', 'info-fill', 'Danger');
		}
	}

	
	public function save_ticket(){
		/**
		 * falta crear el enlace de la demas campos.
		 * */
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
		}else{
			if($this->ticketsModel->save($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client) == true){
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
		$this->load->model('ticketsModel');
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('tickets/new-ticket',[
			"pagina" => "REGISTRAR UN NUEVO TICKET",
			"status"  => $this->ticketsModel->getStatus(),
			"usuarios" => $this->ticketsModel->getUsers()
		]);	
	}
}