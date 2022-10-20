<?php 
	class Usuarios extends CI_Model {
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

        public function getAll(){
        	/**
        	 * Funcion para devolver todos los usuarios de la table de usuarios.
        	 * */
        	return $this->db->get('hlp_usuarios')->result();
        }

	}
?>