'use strict';

var url = '';

$(function () {

	if (!String.format) {
		String.format = function(format) {
			var args = Array.prototype.slice.call(arguments, 1);
			return format.replace(/{(\d+)}/g, function(match, number) { 
				return typeof args[number] != 'undefined'
				? args[number] 
				: match
				;
			});
		}
	}

	suscripciones.Listar();
});

var suscripciones = {
	Listar:function(){

		$.getJSON(url+'/GSYSTEM/api/listarSuscripcion')
		.done(function(data) {

			var tableMarcas = $("#tblSuscripciones").dataTable();
			tableMarcas.fnClearTable();
			tableMarcas.fnDestroy();
			
			$.each( data, function( i, item ) {
				$("#tbodySuscripciones").append(tmpl("tmpl-data-suscripcion", item));
			});

			tableMarcas = $('#tblSuscripciones').dataTable({
				"language": {
					"url": "dist/js/Spanish.json"
				},
				"dom": 'T<"clear">lfrtip',
		        "tableTools": {
		            "sSwfPath": "dist/js/DataTableTools/swf/copy_csv_xls_pdf.swf"
		        }
			});

		}).fail(function(response){
			console.log(response);
		});
	},
	
}