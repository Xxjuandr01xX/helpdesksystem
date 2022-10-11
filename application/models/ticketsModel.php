<?php 
	class ticketsModel extends CI_Model {
		public function __construct(){
			/**
			 * funcion para heredaar metodos de ci_model
			 **/
			$this->load->database();
		}

        public function set_ticket_code(){
            ##Funcion para generar codigos automaticamente desde la base de datos.
            $formato       =  "0000000000";
            $sqlI          =  "SELECT codigo FROM hlp_ticket ORDER BY codigo DESC";
            $query         =  $this->db->query($sqlI);
            $row           =  $query->row();
              //return strlen($row->codigo);
            if(strlen($row->codigo+1) == 1){
                ##mientras la longitud de caracteres no sea mayor a 1.
                $sumetoria = $row->codigo+1;
                $final = substr($formato, 1).$sumetoria;
                return $final;
            }else if(strlen($row->codigo+1) > 1){
                ## cuando se continua de 10 en adelante.
                $sumetoria = $row->codigo+1;
                $final = substr($formato, strlen($row->codigo+1)).$sumetoria;
                return $final;
            }
        }

        public function examine_code_ticket($code){
            ##Funcion para verificar codigos de los tickets ingresados
            $verify = $this->db->query("SELECT * FROM hlp_ticket WHERE codigo = '$code'");
            if($verify->num_rows >= 1){
                return 0;
            }else{
                return 1;
            }
        }

        public function save($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client){
            ##Funcion para registrar ticket en la base de datos.
            return $insert_ticket = $this->db->insert('hlp_ticket',[
               "id" => NULL,
               "codigo" => $this->set_ticket_code(),
               "titulo" => $titulo,
               "descripcion" => $descripcion,
               "id_usuario_solicitante" => $client,
               "id_usuario_soporte" => $user,
               "fec_ini" => $fec_ini,
               "fec_fin" => $fec_fin,
               "id_status_fk" => 1
            ]);
        }

	}
?>