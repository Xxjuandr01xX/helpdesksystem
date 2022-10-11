//////////////////////////////////////////////////////////////////
//          fichero para definir funciones javascript           //
//////////////////////////////////////////////////////////////////

//funcion para devolver la url de un action con javascript
//parametro id del formulario @var id_form
const url_form_action = (id_form) => $("#"+id_form).attr('action');

// funcion para desplegar mensajes de alerta con javascript
/// parametros 
// @var id_container: id del html donde se desplegara, 
// @var type: tipo de color (success, danger, warning, dark, info, primary).
// @var msd: mensaje que se muestra en la alerta.
let setSystemAlert = (id_container, type, msg) => $("#"+id_container).html('<div class="rounded-0 shadow alert alert-'+type+'" role="alert">'+msg+'</div>');


