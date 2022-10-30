<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	/**
	 * Controlador para gestionar peticiones del modulos de usuarios
	 * */
	public function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->helper(array(
			"form" => "url"
		));
		if(!isset($this->session->id)){
			redirect('/login/index/');
		}
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

	public function nac_form(){
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->model('usuariosModel');
		$this->load->view('usuarios/nac_form',[
			"pagina" 	      => "LISTADO DE USUARIOS REGISTRADOS EN EL SISTEMA",
			"nacionalidades"  => $this->usuariosModel->getNacionalidades()
		]);
	}

	public function save_nac(){
		/**
		 *  funcion para insertar informacion en la tabla de nacionalidades.
		 * */
		$des	= $this->input->post('des');
		$cod	= $this->input->post('cod');
		$phone	= $this->input->post('phone');
		$doc	= $this->input->post('doc');
		if($des == '' || $des == NULL){
			$this->warning_alert("Asefurece de llenar el compo de correctamente ! ");
		}else if($cod == '' || $cod == NULL){
			$this->warning_alert("Asefurece de llenar el compo de correctamente ! ");
		}else if($phone == '' || $phone == NULL){
			$this->warning_alert("Asefurece de llenar el compo de correctamente ! ");
		}else if($doc == '' || $doc == NULL){
			$this->warning_alert("Asefurece de llenar el compo de correctamente ! ");
		}else{
			$this->load->model('usuariosModel');
			if($this->usuariosModel->nac_save($des, $cod, $phone, $doc) == true){
				$this->nac_form();
			}else{
				$this->warning_alert("Error al registrar nacionalidad !");
			}
		}
	}

	public function index(){

		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->model('usuariosModel');
		$this->load->view('usuarios/list',[
			"pagina" 	=> "LISTADO DE USUARIOS REGISTRADOS EN EL SISTEMA",
			"usuarios"  => $this->usuariosModel->getDataTableUsuarios()
		]);
	}

	public function editar($cod){
		/**
		 * Funcion para despegar formulario para editar usuarios.
		 * */
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->model('usuariosModel');
		$this->load->view('usuarios/edit-user',[
			"pagina" 		 => "ACTUALIZACION DE DATOS DEL USUARIO",
			"data"   		 => $this->usuariosModel->getDataUsuarioById($cod),
			"cod"    	     => $cod,
			"nacionalidades" => $this->usuariosModel->getNacionalidades()
		]);

	}

	public function update($cod){

		/**
		 * Funcion para insertar un nuevo usuario en la base de datos.
		 * */
		$nacionalidad 	= $this->input->post('select-nac');
		$nombre 		= $this->input->post('nom');
		$apellido 		= $this->input->post('ape');
		$correo 		= $this->input->post('mail');
		$telefono 		= $this->input->post('telf');
		$direccion 		= $this->input->post('dir');
		$fec_nac 		= $this->input->post('fec_nac');
		$user 			= $this->input->post('user');
		$pass 			= $this->input->post('pass');
		$rol 			= $this->input->post('rol-select');
		$dni            = $this->input->post('dni');

		if($nacionalidad == 0){
			$this->warning_alert("Debe de Seleccionar una nacionalidad !");
		}else if($dni == '' || $dni == NULL){
			$this->warning_alert("Debe escribir el dni ! ");
		}else if($nombre == '' || $nombre == NULL){
			$this->warning_alert("Debe de escribir su nombre ! ");
		}else if($apellido == '' || $apellido == NULL){
			$this->warning_alert("Debe de escribir su apellido ! ");	
		}else if($correo == '' || $correo == NULL){
			$this->warning_alert("Debe de escribir su correo ! ");
		}else if($telefono == '' || $telefono == NULL){
			$this->warning_alert("Debe de escribir su telefono ! ");
		}else if($direccion == '' || $direccion == NULL){
			$this->warning_alert("Debe de escribir su direccion ! ");
		}else if($fec_nac == '' || $fec_nac == NULL){
			$this->warning_alert("Debe de indicar su fecha de nacimiento ! ");
		}else if($user == '' || $user == NULL){
			$this->warning_alert("Debe de escribir su nombre de usuario !");
		}else if($pass == '' || $pass == NULL){
			$this->warning_alert("Debe de escribir su clave de usuario ! ");
		}else if($rol == 0){
			$this->warning_alert("Debe de indicar la permisologia del usuario ! ");
		}else{
			$this->load->model('usuariosModel');
			if($this->usuariosModel->user_update($cod, $dni, $nacionalidad, $nombre, $apellido, $correo, $telefono, $direccion, $fec_nac, $user, $pass, $rol) == true){
				$this->index();
			}else{
				$this->warning_alert("Error al Actualizar usuario en el sistema");
			}
		}
	}

	public function eliminar($id){
		/**
		 * Funcion para gestionar peticion para eliminar un usuario
		 * del sistema
		 * */
		$this->load->model('usuariosModel');
		if($this->usuariosModel->drop($id) == true){
			$this->index();
		}else{
			$this->warning_alert("Error al eliminar usuario verifique e intente nuevamente !");
		}
	}

	public function new(){
		$this->load->model("usuariosModel");
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('usuarios/new-user',[
			"pagina" => "REGISTRO DE USUARIOS",
			"nacionalidades" => $this->usuariosModel->getNacionalidades()
		]);
	}

	public function warning_alert($mensaje){
		$this->load->model("usuariosModel");
		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('usuarios/warning_alert',[
			"mensaje" => $mensaje
		]);
	}


	public function insert_user(){
		/**
		 * Funcion para insertar un nuevo usuario en la base de datos.
		 * */
		$nacionalidad 	= $this->input->post('select-nac');
		$nombre 		= $this->input->post('nom');
		$apellido 		= $this->input->post('ape');
		$correo 		= $this->input->post('mail');
		$telefono 		= $this->input->post('telf');
		$direccion 		= $this->input->post('dir');
		$fec_nac 		= $this->input->post('fec_nac');
		$user 			= $this->input->post('user');
		$pass 			= $this->input->post('pass');
		$rol 			= $this->input->post('rol-select');
		$dni            = $this->input->post('dni');

		if($nacionalidad == 0){
			$this->warning_alert("Debe de Seleccionar una nacionalidad !");
		}else if($dni == '' || $dni == NULL){
			$this->warning_alert("Debe escribir su dni");
		}else if($nombre == '' || $nombre == NULL){
			$this->warning_alert("Debe de escribir su nombre ! ");
		}else if($apellido == '' || $apellido == NULL){
			$this->warning_alert("Debe de escribir su apellido ! ");	
		}else if($correo == '' || $correo == NULL){
			$this->warning_alert("Debe de escribir su correo ! ");
		}else if($telefono == '' || $telefono == NULL){
			$this->warning_alert("Debe de escribir su telefono ! ");
		}else if($direccion == '' || $direccion == NULL){
			$this->warning_alert("Debe de escribir su direccion ! ");
		}else if($fec_nac == '' || $fec_nac == NULL){
			$this->warning_alert("Debe de indicar su fecha de nacimiento ! ");
		}else if($user == '' || $user == NULL){
			$this->warning_alert("Debe de escribir su nombre de usuario !");
		}else if($pass == '' || $pass == NULL){
			$this->warning_alert("Debe de escribir su clave de usuario ! ");
		}else if($rol == 0){
			$this->warning_alert("Debe de indicar la permisologia del usuario ! ");
		}else{
			$this->load->model('usuariosModel');
			if($this->usuariosModel->save($nacionalidad, $dni, $nombre, $apellido, $correo, $telefono, $direccion, $fec_nac, $user, $pass, $rol) == true){
				$this->index();
			}else{
				$this->warning_alert("Error al registrar usuario al sistema ");
			}
		}
	}



}

?>