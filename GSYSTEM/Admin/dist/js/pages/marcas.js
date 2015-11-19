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

	marcas.Init();
});

var marcas = {
	Init:function(){
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#frmMarcas" );
		form.validate({
			rules: {
				nombreMarca: {
					required: true,
					minlength: 2
				}
			},
			messages: {
				idMarca: "El Código de la marca es requerido.",
				nombreMarca: {
					required: "El nombre de la marca es requerido.",
					minlength: "Se requieren mínimo 2 caracteres."
				},
				urlMarca: "La imagen de la marca es requerida."
			}
		});

		$( "#btnGuardarMarca" ).click(function() {
			if (form.valid()) {
				marcas.Guardar();
			};
		});

		$( "#btnModificarMarca" ).click(function() {
			if (form.valid()) {
				marcas.Modificar();
			};
		});

		marcas.Listar();
	},
	Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteMarca',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente.");
        marcas.Listar();
      }else{
        alertify.error(response);
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
	Guardar:function(){

		$.ajax({
			url: url+'/GSYSTEM/api/createMarcas',
			type: 'POST',
			data: new FormData( document.getElementById("frmMarcas") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			marcas.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Modificar:function(){
		$.ajax({
			url: url+'/GSYSTEM/api/updateMarcas',
			type: 'POST',
			data: new FormData( document.getElementById("frmMarcas") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			marcas.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	ModificarEstado:function(id, estado){

		$.ajax({
			url: url+'/GSYSTEM/api/updateEstadoMarcas',
			type: 'POST',
			data: {'idMarca':id, 'estado':estado},
			dataType:'json'
		}).done(function(response){

			alertify.success(response.msj);
			marcas.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){

		$.getJSON(url+'/GSYSTEM/api/listarMarcas')
		.done(function(data) {

			var tableMarcas = $("#tblMarcas").dataTable();
			tableMarcas.fnClearTable();
			tableMarcas.fnDestroy();
			
			$.each( data, function( i, item ) {
				$("#tbodyMarcas").append(tmpl("tmpl-data-marcas", item));
			});

			tableMarcas = $('#tblMarcas').dataTable({
				"language": {
					"url": "dist/js/Spanish.json"
				}
			});

			marcas.Limpiar();
		}).fail(function(response){
			console.log(response);
		});
	},
	Edit:function(id, nombre, url){

		$("#idMarca").val(id);
		$("#nombreMarca").val(nombre);
		$("#title-form").text('Modificar Marca');

		var validator = $( "#frmMarcas" ).validate();
		validator.resetForm();

		var $requiredUrl = $('#urlMarca');
		$requiredUrl.removeAttr('required');
		$("#idMarca").attr("required", true);

		$("#btnGuardarMarca").css("display","none");
		$("#btnModificarMarca").css("display","block");
	},
	Limpiar:function(){

		$("#idMarca").val("");
		$("#nombreMarca").val("");
		$("#urlMarca").val("");
		$("#title-form").text("Crear Marca");
		$("#btnGuardarMarca").css("display","block");
		$("#btnModificarMarca").css("display","none");

		var validator = $( "#frmMarcas" ).validate();
		validator.resetForm();

		$("#urlMarca").attr("required", true);
		var $requiredId = $('#idMarca');
		$requiredId.removeAttr('required');
	}
}