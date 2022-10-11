<?php 
	class Usuarios extends CI_Model {
		public function __construct(){
			/**
			 * funcion para heredaar metodos de ci_model
			 **/
			$this->load->database();
		}

        public function get_data_user($username, $password){
        	return $this->db->query("SELECT * FROM hlp_usuarios WHERE usuario = '$username' AND passwd = '$password'");
        }

	}
?>