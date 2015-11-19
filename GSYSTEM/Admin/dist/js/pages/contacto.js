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

	contacto.Listar();
});

var contacto = {
	ModificarEstado:function(id, estado){

		$.ajax({
			url: url+'/GSYSTEM/api/updateContacto',
			type: 'POST',
			data: {'id':id, 'estado':estado},
			dataType:'json'
		}).done(function(response){

			alertify.success(response.msj);
			contacto.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){

		$.getJSON(url+'/GSYSTEM/api/listarContacto')
		.done(function(data) {

			var tableMarcas = $("#tblContacto").dataTable();
			tableMarcas.fnClearTable();
			tableMarcas.fnDestroy();
			
			$.each( data, function( i, item ) {
				$("#tbodyContacto").append(tmpl("tmpl-data-contacto", item));
			});

			tableMarcas = $('#tblContacto').dataTable({
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