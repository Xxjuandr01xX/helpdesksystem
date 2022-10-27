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

        public function getTicketById($cod){
            return $this->db->get_where('hlp_ticket',[
                "codigo" => $cod
            ])->result();
        }

        public function ticketHist($cod){
            $id_ticket_fk = '';
            foreach($this->getTicketById($cod) as $tk){
                $id_ticket_fk = $tk->id;
            }
            return $this->db->get_where('hlp_ticket_historico', [
                "id_ticket_fk" => $id_ticket_fk
            ])->result();
        }

        public function getNombreUsuarioSoporte($cod){
            $id_usuario_fk = '';
            $nombre_usuario = '';
            foreach($this->getTicketById($cod) as $tk){
                $id_usuario_fk = $tk->id_usuario_soporte;
            }
            foreach($this->db->get_where('hlp_usuarios', ["id" =>$id_usuario_fk] )->result() as $usr){
                $nombre_usuario = $usr->usuario;
            }
            return $nombre_usuario;
        }

        public function add_observation($cod, $observation, $fecha_modi, $estatus, $username){
            $id_ticket_fk  = '';
            $id_estatus_fk = '';
            foreach($this->getTicketById($cod) as $tick){
                $id_ticket_fk  = $tick->id;
                $id_estatus_fk = $tick->id_status_fk; 
            }
            if($estatus == $id_estatus_fk){
                return $this->db->insert('hlp_ticket_historico', [
                    "id"            => NULL,
                    "username"      => $username,
                    "id_ticket_fk"  => $id_ticket_fk,
                    "fech_modi"     => $this->set_date_sql($fecha_modi),
                    "hora_modi"     => time(),
                    "id_status_fk"  => $estatus,
                    "observacion"   => $observation
                ]);
            }else{
                $insert = $this->db->insert('hlp_ticket_historico', [
                    "id"            => NULL,
                    "username"      => $username,
                    "id_ticket_fk"  => $id_ticket_fk,
                    "fech_modi"     => $this->set_date_sql($fecha_modi),
                    "hora_modi"     => time('H:i:s'),
                    "id_status_fk"  => $estatus,
                    "observacion"   => $observation
                ]);

                if($insert == true){
                    return $this->db->update('hlp_ticket', [
                        "id_status_fk" => $estatus
                    ],[
                        "id" => $id_ticket_fk 
                    ]);
                }else{
                    return false;
                }
            }
        }

        public function save($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client,$sts){
            ##Funcion para registrar ticket en la base de datos.
            $insert_ticket = $this->db->insert('hlp_ticket',[
               "id"                     =>      NULL,
               "codigo"                 =>      $this->set_ticket_code(),
               "titulo"                 =>      $titulo,
               "descripcion"            =>      $descripcion,
               "id_usuario_solicitante" =>      $client,
               "id_usuario_soporte"     =>      $user,
               "fecha_ini"              =>      $this->set_date_sql($fec_ini),
               "fecha_fin"              =>      $this->set_date_sql($fec_fin),
               "id_status_fk"           =>      $sts
            ]);

            $insert_ticket_history = $this->db->insert('hlp_ticket_historico', [
                "id"                   =>       NULL,
                "id_ticket_fk"         =>       $this->db->insert_id,
                "fech_modi"            =>       date('d/m/Y'),
                'hora_modi'            =>       time(),
                "id_status_fk"         =>       $sts,
                "observacion"          =>       "----------" 
            ]);

            if($insert_ticket == true && $insert_ticket_history == true){
                return true;
            }else{
                return false;
            }
        }

        public function ticket_update($titulo, $fec_ini, $fec_fin, $descripcion, $user, $client,$sts, $cod){
            $id_ticket = '';
            foreach($this->db->get_where('hlp_ticket', ["codigo" => $cod])->result() as $ticket){
                $id_ticket = $ticket->id;
            }

            $update_ticket = $this->db->update('hlp_ticket',[
               "titulo"                 =>      $titulo,
               "descripcion"            =>      $descripcion,
               "id_usuario_solicitante" =>      $client,
               "id_usuario_soporte"     =>      $user,
               "fecha_ini"              =>      $this->set_date_sql($fec_ini),
               "fecha_fin"              =>      $this->set_date_sql($fec_fin),
               "id_status_fk"           =>      $sts
            ], ["codigo" => $cod]);

            $insert_ticket_history = $this->db->insert('hlp_ticket_historico', [
                "id"                    =>      NULL,
                "id_ticket_fk"          =>      $id_ticket,
                "fech_modi"            =>       set_date_sql(date('d/m/Y')),
                'hora_modi'            =>       time(),
                "id_status_fk"         =>       $sts,
                "observacion"          =>       "ACTUALIZACION DE INFORMACION"
            ]);

            if($update_ticket == true && $insert_ticket_history == true){
                return true;
            }else{
                return false;
            }
        }

        public function getTableTickets($fecha_inicio, $fecha_fin){
            $ini = $this->set_date_sql($fecha_inicio);
            $fin = $this->set_date_sql($fecha_fin);
            return $this->db->query("select a.id       as 'id_ticket',
                                           a.codigo    as 'code',
                                           c.nombre    as 'nom',
                                           c.apellido  as 'ape',
                                           a.titulo    as 'tit',
                                           a.fecha_ini as 'ini',
                                           a.fecha_fin as 'fim'
                                    from hlp_ticket a left join hlp_usuarios b on a.id_usuario_solicitante=b.id left join hlp_personas c on b.id_persona_fk=c.id where a.fecha_ini BETWEEN '".$ini."' AND '".$fin."'")->result();
        }

        public function getArrayTicket($usuario, $rol_usuario){
            /**
             * Funcion para devolver array con cantidad de tickets.
             * */
            $resultSet = array();

            if($rol_usuario == 1){
                $abiertos = "SELECT COUNT(*) as 'abr' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE b.id = 1";
                $cerrado  = "SELECT COUNT(*) as 'cer' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE b.id = 2";
                $resuelto = "SELECT COUNT(*) as 'res' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE b.id = 3";
                $asignado = "SELECT COUNT(*) as 'asg' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE b.id = 4";
                $rs1 = $this->db->query($abiertos)->result();
                $rs2 = $this->db->query($cerrado)->result();
                $rs3 = $this->db->query($resuelto)->result();
                $rs4 = $this->db->query($asignado)->result();

                return [$rs1[0]->abr,$rs2[0]->cer,$rs3[0]->res,$rs4[0]->asg];
            }else{
                $abiertos = "SELECT COUNT(*) as 'abr' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE a.id_usuario_soporte = '$usuario' AND b.id=1;";
                $cerrado  = "SELECT COUNT(*) as 'cer' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE a.id_usuario_soporte = '$usuario' AND b.id=2;";
                $resuelto = "SELECT COUNT(*) as 'res' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE a.id_usuario_soporte = '$usuario' AND b.id=3;";
                $asignado = "SELECT COUNT(*) as 'asg' FROM hlp_ticket a INNER JOIN hlp_ticket_status b ON a.id_status_fk=b.id WHERE a.id_usuario_soporte = '$usuario' AND b.id=4;";

                $rs1 = $this->db->query($abiertos)->result();
                $rs2 = $this->db->query($cerrado)->result();
                $rs3 = $this->db->query($resuelto)->result();
                $rs4 = $this->db->query($asignado)->result();

                return [$rs1[0]->abr,$rs2[0]->cer,$rs3[0]->res,$rs4[0]->asg];
            }
        }

	}
?>