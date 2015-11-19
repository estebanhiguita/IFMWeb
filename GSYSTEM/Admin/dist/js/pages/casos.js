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

	casos.Init();
});

var casos = {
	Init:function(){
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#frmCasos" );
		form.validate({
			rules: {
				nombreCaso: {
					required: true,
					minlength: 2
				}
			},
			messages: {
				idCaso: "El código del caso de éxito es requerido.",
				nombreCaso: {
					required: "El nombre del caso de éxito es requerido.",
					minlength: "Se requieren mínimo 2 caracteres."
				},
				urlCaso: "La imagen del caso de éxito es requerida."
			}
		});

		$( "#btnGuardarCaso" ).click(function() {
			if (form.valid()) {
				casos.Guardar();
			};
		});

		$( "#btnModificarCaso" ).click(function() {
			if (form.valid()) {
				casos.Modificar();
			};
		});

		casos.Listar();
	},
		Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteCaso',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente.");
        casos.Listar();
      }else{
        alertify.error(response);
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
	Guardar:function(){

		$.ajax({
			url: url+'/GSYSTEM/api/createCasos',
			type: 'POST',
			data: new FormData( document.getElementById("frmCasos") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			casos.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Modificar:function(){
		$.ajax({
			url: url+'/GSYSTEM/api/updateCasos',
			type: 'POST',
			data: new FormData( document.getElementById("frmCasos") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			casos.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	ModificarEstado:function(id, estado){

		$.ajax({
			url: url+'/GSYSTEM/api/updateEstadoCasos',
			type: 'POST',
			data: {'idCaso':id, 'estado':estado},
			dataType:'json'
		}).done(function(response){

			alertify.success(response.msj);
			casos.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){

		$.getJSON(url+'/GSYSTEM/api/listarCasos')
		.done(function(data) {

			var tableCasos = $("#tblCasos").dataTable();
			tableCasos.fnClearTable();
			tableCasos.fnDestroy();
			
			$.each( data, function( i, item ) {
				$("#tbodyCasos").append(tmpl("tmpl-data-casos", item));
			});

			tableCasos = $('#tblCasos').dataTable({
				"language": {
					"url": "dist/js/Spanish.json"
				}
			});

			casos.Limpiar();
		}).fail(function(response){
			console.log(response);
		});
	},
	Edit:function(id, nombre, url){

		$("#idCaso").val(id);
		$("#nombreCaso").val(nombre);
		$("#title-form").text('Modificar Caso de Éxito');

		var validator = $( "#frmCasos" ).validate();
		validator.resetForm();

		var $requiredUrl = $('#urlCaso');
		$requiredUrl.removeAttr('required');
		$("#idCaso").attr("required", true);

		$("#btnGuardarCaso").css("display","none");
		$("#btnModificarCaso").css("display","block");
	},
	Limpiar:function(){

		$("#idCaso").val("");
		$("#nombreCaso").val("");
		$("#urlCaso").val("");
		$("#title-form").text("Crear Caso de Éxito");
		$("#btnGuardarCaso").css("display","block");
		$("#btnModificarCaso").css("display","none");

		var validator = $( "#frmCasos" ).validate();
		validator.resetForm();

		$("#urlCaso").attr("required", true);
		var $requiredId = $('#idCaso');
		$requiredId.removeAttr('required');
	}
}