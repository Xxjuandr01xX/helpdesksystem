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

	public function reporteGeneral(){
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
		$this->load->view('reports/reporteGeneralForm', [
			"pagina" => "REPORTE GENERAL DE INSIDENCIAS"
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
			"table"  => $this->ticketsModel->getTableTickets($fecha_inicio, $fecha_fin, $this->session->rol, $this->session->id)
		]);
	}

	public function pdfGeneralTickets(){
		/**
		 * Aqui genero el reporte general de insidencias
		 * */

		##Definiciones
		$ini = $this->input->post('ini');
		$fin = $this->input->post('fin');
		$this->load->model('ticketsModel');
		$this->load->model('usuariosModel');
		require_once APPPATH.'third_party/fpdf/fpdf.php';
		require_once APPPATH.'third_party/diag/sector.php';
		require_once APPPATH.'third_party/diag/diag.php';

		//echo $ini.'------'.$fin;

		$diag = new PDF_Diag();
	    $diag->AddPage('P','Letter',0);
	    $diag->SetFont('Arial','B',10);
	    $cht = $this->ticketsModel->getArrayChartReport($this->session->id, $this->session->rol, $ini, $fin);
	    $data = array('ABIERTO' => $cht[0], 'CERRADO' => $cht[1], 'RESUELTO' => $cht[2]);
	    

	    $diag->Cell(0, 5, 'SOPORTE REALIZADOS DESDE '.$ini.' HASTA '.$fin, 0, 1);
		$diag->Ln(8);
		$valX = $diag->GetX();
		$valY = $diag->GetY();
		$diag->BarDiagram(190, 70, $data, '%l : %v (%p)', array(255,175,100,100));
		$diag->SetXY($valX, $valY + 80);
		$diag->Ln(3);
		$diag->Cell(7,5,'#',1,0,'C');
		$diag->Cell(30,5,'NRO TICKET',1,0,'C');
		$diag->Cell(115,5,'TITULO',1,0,'C');
		$diag->Cell(18,5,'CLIENTE',1,0,'C');
		$diag->Cell(18,5,'ESTATUS',1,1,'C');
	
		$x=0;
		foreach($this->ticketsModel->getTicketsTable($this->session->id, $this->session->rol, $ini, $fin)->result() as $tk){
			$x++;
			$diag->Cell(7,5,$x,0,0,'C');
			$diag->Cell(30,5,$tk->codigo,0,0,'C');
			$diag->Cell(115,5,$tk->titulo,0,0,'C');
			$diag->Cell(18,5,$this->usuariosModel->get_name_user($tk->id_usuario_solicitante),0,0,'C');
			$diag->Cell(18,5,$this->ticketsModel->get_name_status($tk->id_status_fk),0,1,'C');
		}
		
		$diag->output();

	}

	public function pdfTickets($cod){
		/**
		 * Aqui se imprime el reporte
		 * */
		//Se agrega la clase desde thirdparty para usar FPDF
	     require_once APPPATH.'third_party/fpdf/fpdf.php';
	     $this->load->model('ticketsModel');
	     $this->load->model('usuariosModel');
	        
	     $pdf = new FPDF();
	     $pdf->AddPage('P','Letter',0);
	     $pdf->SetFont('Arial','B',10);
	     foreach($this->ticketsModel->getTicketReporte($cod) as $tk){
		     $pdf->Cell(50,5,'NRO DE TICKET: ',0,0,'C');
		     $pdf->Cell(25,5,$tk->codigo,0,1,'L');
		     ############################################
		     $pdf->Cell(50,5,'FECHA DE INICIO: ',1,0,'C');
		     $pdf->Cell(50,5,date('d/m/Y', strtotime($tk->fecha_ini)),1,0,'C');
		     $pdf->Cell(50,5,'FECHA DE CULMINACION:',1,0,'C');
		     $pdf->Cell(48,5,date('d/m/Y', strtotime($tk->fecha_fin)),1,1,'C');
		     #################################################
		     foreach($this->usuariosModel->getDataPersonaById($tk->id_usuario_soporte) as $sop){
		     	$pdf->Cell(198,5,'DATOS DEL ENCARGADO',1,1,'C');
		     	$pdf->Cell(25,10,'NOMBRE',1,0,'C');
		     	$pdf->Cell(75,10,$sop->nombre.' '.$sop->apellido,1,0,'C');
		     	$pdf->Cell(98,10,'TELEFONO: '.$sop->telefono,1,1,'L');
		     	$pdf->Cell(100,10,'FIRMA DE RECIBIDO: ___________________________',1,1,'L');
		 	}
		 	foreach($this->usuariosModel->getDataPersonaById($tk->id_usuario_solicitante) as $cli){
		     	$pdf->Cell(198,5,'DATOS DEL CLIENTE',1,1,'C');
		     	$pdf->Cell(25,10,'NOMBRE',1,0,'C');
		     	$pdf->Cell(75,10,$cli->nombre.' '.$cli->apellido,1,0,'C');
		     	$pdf->Cell(98,10,'TELEFONO: '.$cli->telefono,1,1,'L');
		     	$pdf->Cell(100,10,'FIRMA DE RECIBIDO: ___________________________',1,1,'L');
		 	}

		 	 $time = time();

		     $pdf->Cell(198,5,'DESCRIPCION DE LA INSIDENCIA',1,1,'C');
		     $pdf->Cell(198,30,trim($tk->descripcion),1,1,'C');
		     $pdf->Cell(198,5,'OBSERVACIONES',1,1,'C');
		     //print_r($this->ticketsModel->ticketHistReporte($tk->id));
		     foreach($this->ticketsModel->ticketHistReporte($tk->id) as $hist){
		     	$pdf->Cell(198,10,date('d/m/Y', strtotime($hist->fech_modi)).' '.date('h:i:s', strtotime($hist->hora_modi)).'  '.$hist->username.'  '.$hist->observacion,1,1,'L');
		     }
		     $pdf->Cell(100,5,'ESTATUS: ',1,0,'C');
		     $pdf->Cell(98,5,$this->ticketsModel->get_name_status($tk->id_status_fk),1,0,'C');
		     $pdf->Output('reporteIncidencia-'.$tk->codigo.'.pdf' , 'I' );
		}
	     
	}

}