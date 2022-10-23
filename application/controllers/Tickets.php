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

	public function setMenuRol($rol){
		/**
		 * Funcion para aplicar roles de usuario en menus
		 * */
		if($rol == 1){
			//rol para usuario administrador
			return "dashboard/menuAdministrador";
		}else if($rol == 3){
			// rol para usuario soporte tecnico
			return "dashboard/menuSoporte";
		}else if($rol == 2){
			// rol para usuario cliente
			return "dashboard/menuCliente";
		}else{
			return "NULL";
		}
	}

	public function setTicketsOptions($rol, $ticket){
		/**
		 * Funcion para aplicar roles de usuarios a opciones de tickets
		 * */
		if($rol == 1){
			//rol para usuario administrador
			return "<div class='btn-group rounded-pill'>".
						"<a href = '".base_url()."index.php/tickets/hist_ticket/".$ticket."' class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-bahai'></a>".
						"<a href = '".base_url()."index.php/tickets/rm_ticket/".$ticket."' class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-trash-alt'></a>".
						"<a href = '".base_url()."index.php/tickets/edit_ticket/".$ticket."'class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-edit'></a>".
					"</div>";
		}else if($rol == 2 || $rol == 3){
			// rol para usuario soporte tecnico y clientes
			return "<div class='btn-group rounded-pill'>".
					"<a href = '".base_url()."index.php/tickets/hist_ticket/".$ticket."' class = 'btn btn-sm btn-secondary'><span class='fas fa-fw fa-bahai'></a>".
					"</div>";
		}else{
			return "NULL";
		}
	}

	public function index(){
		$this->load->model("ticketsModel");
		$this->load->model("usuariosModel");
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
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
			$tableString .= "<td>".$this->usuariosModel->get_name_user($x->id_usuario_solicitante)."</td>";
			$tableString .= "<td>".$this->usuariosModel->get_name_user($x->id_usuario_soporte)."</td>";
			$tableString .= "<td>".$this->set_btn_status($x->id_status_fk)."</td>";
			$tableString .= "<td>".$this->setTicketsOptions($this->session->rol, $x->codigo)."</td>";
			$tableString .= "</tr>";
			$resultSet[] = $tableString;
		}
		####Cargando la vista 
		$this->load->view('tickets/list',[
			"pagina"  => "GESTION DE TICKETS",
			"tickets" => $resultSet,
		]);
	}

	public function hist_ticket($cod){
		/**
		 * Funcion para ver detalles del ticket y ver formulario de insercion de observaciones
		 * */
		$this->load->model('ticketsModel');
		$this->load->model('usuariosModel');
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario,
		]);
		$this->load->view('tickets/observation-ticket',[
			"cod"        =>  $cod,
			"pagina"     =>  "OBSERVACIONES E HISTORICO DE TICKET",
			"ticket"     =>  $this->ticketsModel->getTicketById($cod),
			"estatus"    =>  $this->ticketsModel->getStatus(),
			"historico"  =>  $this->ticketsModel->ticketHist($cod),
			"usuarios"   =>  $this->usuariosModel->getAll(),
			"rol"        =>  $this->session->rol, // Rol de usuario.
			"id_user"    =>  $this->session->id,  // id del usuario.
			"nm_user"    =>  $this->session->usuario // nombre de usuario.
		]);
	}

	public function insert_observation($cod){
		/**
		 * Funcion en construccion para insertar en la base de datos 
		 * la observacion en la tabla de historico.
		 * */
		$observacion = $this->input->post('observation-ticket');
		$fecha_modi  = $this->input->post('fec_obs');
		$estatus     = $this->input->post('select-estatus');
		$username    = $this->input->post('user_name');
		######################################
		$this->load->model('ticketsModel');
		######################################
		if($observacion == '' || $observacion == NULL){
			$this->alert_window('warning', 'Asegurece de agregar observaciones', 'info-fill', 'Warning');
		}else if($fecha_modi == '' || $fecha_modi == NULL){
			$this->alert_window('warning', 'Asegurece de agregar fecha de observacion', 'info-fill', 'Warning');
		}else if($estatus == 0){
			$this->alert_window('warning', 'Asegurece seleccionar un estatus', 'info-fill', 'Warning');
		}else if($username == 0){
			$this->alert_window('warning', 'Asegurece seleccionar un usuario', 'info-fill', 'Warning');
		}else{
			if($this->ticketsModel->add_observation($cod, $observacion, $fecha_modi, $estatus, $username) == true){
				$this->index();
			}else{
				$this->alert_window('danger', 'Error al agregar observacion', 'info-fill', 'Danger');
			}
		}
	}

	public function edit_ticket($cod){
		$this->load->model('ticketsModel');
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view('dashboard/menuAdministrador');
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario,
			"codigo"   => $cod
		]);
		$this->load->view('tickets/edit-ticket',[
			"cod"      => $cod,
			"pagina"   => "ACTUALIZAR INFORMACION DE TICKET",
			"ticket"   => $this->ticketsModel->getTicketById($cod),
			"status"   => $this->ticketsModel->getStatus(),
			"usuarios" => $this->ticketsModel->getUsers()
		]);
	}

	public function update_ticket($cod){
		/**
		 * Funcion para editar el registro de un ticket en la base de datos.
		 * */
		$this->load->model('ticketsModel');
		$titulo  	  = $this->input->post('titulo');
		$fec_ini 	  = $this->input->post('fec_ini');
		$fec_fin 	  = $this->input->post('fec_fin');
		$descripcion  = $this->input->post('description');
		$user         = $this->input->post('user_select');
		$client       = $this->input->post('client_select');
		$sts          = $this->input->post('estatus_select');

		if($titulo == '' || $titulo == null){
			$this->alert_window('warning', 'Asegurece de llenar el titulo Correctamente !', 'info-fill', 'Warning');
		}else if($fec_ini == ''){
			$this->alert_window('warning', 'Asegurece colocar un a fecha de inicio !', 'info-fill', 'Warning');
		}else if($fec_fin == ''){
			$this->alert_window('warning', 'Asegurece colocar una fecha de fin !', 'info-fill', 'Warning');
		}else if($descripcion == ''){
			$this->alert_window('warning', 'Asegurece colocar una descripcion para el ticket !', 'info-fill', 'Warning');
		}else if($user == 0){
			$this->alert_window('warning', 'Debe de elegir un usuario para atender el caso !', 'info-fill', 'Warning');
		}else if($client == 0){
			$this->alert_window('warning', 'Debe de elegir un cliente que solicite el soporte !', 'info-fill', 'Warning');
		}else if($sts == 0){
			$this->alert_window('warning', 'Eliga un estatus para el soporte !', 'info-fill', 'Warning');
		}else{
			if($this->ticketsModel->ticket_update($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client, $sts, $cod) == true){
				$this->index();
			}else{
				$this->alert_window('danger', 'Error al ingresar datos, por favor vuelva a intentar', 'exclamation-triangle-fill', 'Danger');
			}
		}

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
		/**
		 * Funcion para eliminar el registro de un ticket de la base de datos.
		 * */
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
		$sts          = $this->input->post('estatus_select');


		if($titulo == '' || $titulo == null){
			$this->alert_window('warning', 'Asegurece de llenar el titulo Correctamente !', 'info-fill', 'Warning');
		}else if($fec_ini == ''){
			$this->alert_window('warning', 'Asegurece colocar un a fecha de inicio !', 'info-fill', 'Warning');
		}else if($fec_fin == ''){
			$this->alert_window('warning', 'Asegurece colocar una fecha de fin !', 'info-fill', 'Warning');
		}else if($descripcion == ''){
			$this->alert_window('warning', 'Asegurece colocar una descripcion para el ticket !', 'info-fill', 'Warning');
		}else if($user == 0){
			$this->alert_window('warning', 'Debe de elegir un usuario para atender el caso !', 'info-fill', 'Warning');
		}else if($client == 0){
			$this->alert_window('warning', 'Debe de elegir un cliente que solicite el soporte !', 'info-fill', 'Warning');
		}else if($sts == 0){
			$this->alert_window('warning', 'Eliga un estatus para el soporte !', 'info-fill', 'Warning');
		}else{
			if($this->ticketsModel->save($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client, $sts) == true){
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
		/**
		 * Funcion para mostrar el formulario de registro de nuevo ticket
		 * */
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