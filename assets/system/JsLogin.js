$(document).ready(function(){
	/**
	 *  archivo para definir interacciones en la parte de login.
	 ***/
	//$("#user_login_btn").on('click', function(e){
		/**
		 * evento para validar los campos de texto del formulario de
		 * inicio de sasseion.
		 **/
		//e.preventDefault();
		//login_validation();
	//});
});



let login_validation = () => {
	let user_name = $("#user_name").val();
	let pass_user = $("#user_pass").val(); 
	if(user_name == null || user_name.length == 0 || /^\s+$/.test(user_name)){
		$("#user_name").val('');
		$("#user_name").focus();
		setSystemAlert('alert', 'warning', 'Debe llenar el campo nombre de usuario correctamente !');
	}else if(pass_user == null || pass_user.length == 0 || /^\s+$/.test(pass_user)){
		$("#user_pass").val('');
		$("#user_pass").focus();
		setSystemAlert('alert', 'warning', 'Debe llenar el campo contraseña correctamente !');
	}else{
		$.post(url_form_action('user_form'), {"user_name" : user_name, "user_pass": pass_user}, (resp)=>{
			setSystemAlert('alert', 'primary', resp);
			if(resp == "1"){

			}else{

			}
			console.log(resp);
		});
	}
}