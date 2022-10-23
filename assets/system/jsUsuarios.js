$(document).ready(function(){
	/**
	 *  Funciones para manipular interacciones de la aplicacion
	 ***/
	$("#dni_user").inputmask("A.-9{1,12}");
	$("#telf").inputmask("9999-9999999");
	$("#user").inputmask("A{1,25}");
	$("#mail").inputmask({
    	mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
    	greedy: false,
	    onBeforePaste: function (pastedValue, opts) {
	      pastedValue = pastedValue.toLowerCase();
	      return pastedValue.replace("mailto:", "");
	    },
	    definitions: {
	      '*': {
	        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
	        casing: "lower"
	      }
	    }
  });
});