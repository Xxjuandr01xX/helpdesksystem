<?php 
	class usuariosModel extends CI_Model {
		public function __construct(){
			/**
			 * funcion para heredaar metodos de ci_model
			 **/
			$this->load->database();
		}

        public function get_data_user($username, $password){
        	/**
        	 * Funcion para validar usuario y contrasenia.
        	 * */
        	return $this->db->query("SELECT * FROM hlp_usuarios WHERE usuario = '$username' AND passwd = '$password'");
        }

        public function get_name_user($id_usuario){
        	/**
        	 * Funcion para devolver nombre de usuarios.
        	 * */
        	$nombre = "";
        	$query = $this->db->get_where('hlp_usuarios',["id" => $id_usuario])->result();
        	foreach ($query as $key) {
        		$nombre = $key->usuario;
        	}
        	return $nombre;
        }

        public function getDataTableUsuarios(){
            return $this->db->query("SELECT a.id, b.nombre, b.apellido, a.usuario,c.descripcion FROM hlp_usuarios a INNER JOIN hlp_personas b ON a.id_persona_fk=b.id INNER JOIN hlp_roles c ON a.id_rol_fk=c.id; ")->result();
        }

        public function getAll(){
        	/**
        	 * Funcion para devolver todos los usuarios de la table de usuarios.
        	 * */
        	return $this->db->get('hlp_usuarios')->result();
        }

        public function getNacionalidades(){
        	/**
        	 * Funcion para devolver nacionalidades de la base de datos
        	 * */
        	return $this->db->get("hlp_nacionalidades")->result();
        }

        public function set_date_sql($sql){
        	$date = explode("/", $sql);
        	return $date[2]."-".$date[1]."-".$date[0];
        }

        public function drop($id){
            /**
            * Funcion para eliminar datos de usurio de la persona.
            **/
            $id_persona_fk = "";
            foreach($this->db->get_where("hlp_usuarios", ["id" => $id])->result() as $usr){
                $id_persona_fk = $usr->id_persona_fk;
            }
            $drop_persona = $this->db->delete('hlp_personas', ["id" => $id_persona_fk]);
            $drop_usuario = $this->db->delete('hlp_usuarios', ["id" => $id]);
            if($drop_persona == true && $drop_usuario == true){
                return true;
            }else{
                return false; 
            }
        }

        public function getDataUsuarioById($id){
            /**
             * Funcion para devolder datos de usuario y persona conel id del usuario.
             * */
            return $this->db->query("SELECT * FROM hlp_usuarios a LEFT JOIN hlp_personas b  ON a.id_persona_fk=b.id INNER JOIN hlp_roles c ON a.id_rol_fk=c.id WHERE a.id = '$id'")->result();
        }

        public function save($nacionalidad, $nombre, $apellido, $correo, $telefono, $direccion, $fec_nac, $user, $pass, $rol){
        	/**
        	 * Funcion para agregar datos a tablas hlp_personas y hlp_usuarios
        	 * */
        	$insert_personas = $this->db->insert('hlp_personas',[
        		"id" 				 => NULL,
        		"id_nacionalidad_fk" => $nacionalidad,
        		"nombre" 			 => $nombre,
        		"apellido" 			 => $apellido,
        		"correo" 			 => $correo,
        		"telefono" 			 => $telefono,
        		"direccion" 		 => $direccion,
        		"fec_nac" 			 => set_date_sql($fec_nac)
        	]);

        	$insert_usuarios = $this->db->insert('hlp_usuarios', [
        		"id" 				=> NULL,
        		"usuario" 			=> $user,
        		"passwd" 			=> $pass,
        		"id_rol_fk" 		=> $rol,
        		"id_persona_fk" 	=> $this->db->insert_id() 
        	]);

        	if($insert_personas == true && $insert_usuarios == true){
        		return true;
        	}else{
        		return false;
        	}
        }

	}
?>