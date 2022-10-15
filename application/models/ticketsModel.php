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

        public function getStatus(){
            /**
             * Funcion para devolver estatus de la insidencias.
             * */
            return $this->db->get('hlp_ticket_status')->result();
        } 

        public function getUsers(){
            /**
             * Funcion para devolver usuarios de la base de datos.
             * */
            return $this->db->get('hlp_usuarios')->result();
        }       

        public function drop($cod){
            /**
             * funcion para eliminar un ticket de la base de datos
             * */
            //$sql_ticket = "SELECT * FROM hlp_ticket WHERE codigo = ".$cod;
            return $this->db->delete('hlp_ticket', [
                "codigo" => $cod
            ]);
        }

        public function set_date_sql($date){
            ##metodo para convertir el formato de fecha a sql.
            $sql = explode("/", $date);
            return $sql[2]."-".$sql[1]."-".$sql[0];
        }
        public function set_sql_label($date){
            $label = explode("-", $date);
            return $label[2]."/".$label[1]."/".$label[0];
        }

        public function get_name_status($id){
            $name = "";
            foreach($this->db->get_where('hlp_ticket_status', ["id" => $id])->result() as $nam){
                $name = $nam->denominacion;
            }
            return $name;
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

        public function get_data_tickets(){
            ##Funcion para devolver datos de la tabla hlp_tickets
            return $this->db->get('hlp_ticket');
        }

        public function save($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client){
            ##Funcion para registrar ticket en la base de datos.
            ##EDITAR PARA AGREGAR HISTORICO Y LISTADO DE USUARIOS
            return $insert_ticket = $this->db->insert('hlp_ticket',[
               "id"                     =>      NULL,
               "codigo"                 =>      $this->set_ticket_code(),
               "titulo"                 =>      $titulo,
               "descripcion"            =>      $descripcion,
               "id_usuario_solicitante" =>      1,
               "id_usuario_soporte"     =>      1,
               "fecha_ini"              =>      $this->set_date_sql($fec_ini),
               "fecha_fin"              =>      $this->set_date_sql($fec_fin),
               "id_status_fk"           =>      1
            ]);
        }

	}
?>