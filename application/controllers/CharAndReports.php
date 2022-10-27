<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CharAndReports extends CI_Controller {
	/**
	 * En este controlador se generan las graficas y 
	 * reportes que genera el sistema.
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array(
			"form" => "url"
		));
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
	
	public function index(){
		/**
		 *  filtros de busqueda para generar reportes
		 * */
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
		$this->load->view('reports/filter', [
			"pagina" => "REPORTES DE INSIDENCIAS",
			"table"  => ""
		]);
	}

	public function ticketsDetalle(){
		$this->load->model("ticketsModel");
		$this->load->model("usuariosModel");

		$fecha_inicio = $this->input->post('ini');
		$fecha_fin    = $this->input->post('fin');

		####metodo para desplegar la pagina principal
		$this->load->view('dashboard/head', ["titulo"=>"DEPARTAMENTO TI "]);
		$this->load->view('dashboard/sidebar');
		//$this->validate_session_menu($this->session->rol);
		$this->load->view($this->setMenuRol($this->session->rol));
		$this->load->view('dashboard/topbar',[
			"username" => $this->session->usuario
		]);
		$this->load->view('reports/filter', [
			"pagina" => "REPORTES DE INSIDENCIAS",
			"table"  => $this->ticketsModel->getTableTickets($fecha_inicio, $fecha_fin)
		]);
	}

	public function pdfTickets($cod){
		/**
		 * Aqui se imprime el reporte
		 * */
		//Se agrega la clase desde thirdparty para usar FPDF
	     require_once APPPATH.'third_party/fpdf/fpdf.php';
	        
	     $pdf = new FPDF();
	     $pdf->AddPage('P','A4',0);
	     $pdf->SetFont('Arial','B',16);
	     $pdf->Cell(0,0,'Hola mundo FPDF desde Codeigniter',0,1,'C');
	     $pdf->Output('paginaEnBlanco.pdf' , 'I' );
	}
}