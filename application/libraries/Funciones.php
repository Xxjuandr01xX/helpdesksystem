<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Funciones {
		##clase para gestionar funciones de php
	    public function set_date_sql($date){
	    	##metodo para convertir el formato de fecha a sql.
	    	$sql = explode("/", $date);
	    	return $sql[2]."-".$sql[1]."-".$sql[0];
	    }

	    public function set_sql_label($date){
	    	$label = explode("-", $date);
	    	return $label[2]."/".$label[1]."/".$label[0];
	    }
	}

?>