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

	unidades.Init();
});

var unidades = {
	Init:function(){
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#frmUnidades" );
		form.validate({
			rules: {
				urlVideo: {
					required: true,
					minlength: 2
				}
			},
			messages: {
				idUnidad: "El código de la unidad de negocio es requerido.",
				urlUnidad: "La imagen de la unidad de negocio es requerida.",
				urlVideo: {
					required: "El vídeo para la unidad de negocio es requerido (YouTube).",
					minlength: "Se requieren mínimo 2 caracteres."
				}
			}
		});

		$( "#btnGuardarUnidad" ).click(function() {
			if (form.valid()) {
				unidades.Guardar();
			};
		});

		$( "#btnModificarUnidad" ).click(function() {
			if (form.valid()) {
				unidades.Modificar();
			};
		});

		unidades.Listar();
	},
	Guardar:function(){

		$.ajax({
			url: url+'/GSYSTEM/api/createUnidades',
			type: 'POST',
			data: new FormData( document.getElementById("frmUnidades") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			unidades.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Modificar:function(){
		$.ajax({
			url: url+'/GSYSTEM/api/updateUnidades',
			type: 'POST',
			data: new FormData( document.getElementById("frmUnidades") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			unidades.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){

		$.getJSON(url+'/GSYSTEM/api/listarUnidades')
		.done(function(data) {

			var tableUnidades = $("#tblUnidades").dataTable();
			tableUnidades.fnClearTable();
			tableUnidades.fnDestroy();
			
			$.each( data, function( i, item ) {
				$("#tbodyUnidades").append(tmpl("tmpl-data-unidades", item));
			});

			tableUnidades = $('#tblUnidades').dataTable({
				"language": {
					"url": "dist/js/Spanish.json"
				}
			});

			unidades.Limpiar();
		}).fail(function(response){
			console.log(response);
		});
	},
	openModalVideo: function(urlVideo, unidadNegocio){
		$('#videoYoutube').attr('src', urlVideo);
		$('#unidadNegocio').text(unidadNegocio);
		$('#myModal').modal('show');
	},
	Edit:function(id, nombre, url, urlVideo){

		$("#idUnidad").val(id);
		$("#nombreUnidad").val(nombre);
		$("#urlVideo").val(urlVideo);
		$("#title-form").text('Modificar Unidades de Negocio');

		var validator = $( "#frmUnidades" ).validate();
		validator.resetForm();

		var $requiredUrl = $('#urlUnidad');
		$requiredUrl.removeAttr('required');
		$("#idUnidad").attr("required", true);

		$("#btnGuardarUnidad").css("display","none");
		$("#btnModificarUnidad").css("display","block");
	},
	Limpiar:function(){

		$("#idUnidad").val("");
		$("#nombreUnidad").val("");
		$("#urlUnidad").val("");
		$("#urlVideo").val("");

		$("#title-form").text("Crear Unidades de Negocio");
		$("#btnGuardarUnidad").css("display","block");
		$("#btnModificarUnidad").css("display","none");

		var validator = $( "#frmUnidades" ).validate();
		validator.resetForm();

		$("#urlUnidad").attr("required", true);
		var $requiredId = $('#idUnidad');
		$requiredId.removeAttr('required');
	}
}