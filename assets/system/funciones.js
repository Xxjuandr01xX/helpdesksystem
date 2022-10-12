//////////////////////////////////////////////////////////////////
//          fichero para definir funciones javascript           //
//////////////////////////////////////////////////////////////////

//funcion para devolver la url de un action con javascript
//parametro id del formulario @var id_form
const url_form_action = (id_form) => $("#"+id_form).attr('action');

//Funcion para convertir  de formato de fecha sql a formato de fecha normal
let set_sql_to_label = (date) => {
	let label = date.split("-");
	return label[2]+"/"+label[1]+"/"+label[0];
}
