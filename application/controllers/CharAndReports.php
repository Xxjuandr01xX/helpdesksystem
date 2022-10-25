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
			"pagina" => "REPORTES DE INSIDENCIAS"
		]);
	}
}