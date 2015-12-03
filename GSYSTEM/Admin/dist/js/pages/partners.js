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

	partners.Init();
});

var partners = {
	Init:function(){
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#frmPartners" );
		form.validate({
			rules: {
				nombrePartner: {
					required: true,
					minlength: 2
				}
			},
			messages: {
				idPartner: "El código del partner es requerido.",
				nombrePartner: {
					required: "El nombre del partner es requerido.",
					minlength: "Se requieren mínimo 2 caracteres."
				},
				urlPartner: "La imagen del partner es requerida."
			}
		});

		$( "#btnGuardarPartner" ).click(function() {
			if (form.valid()) {
				partners.Guardar();
			};
		});

		$( "#btnModificarPartner" ).click(function() {
			if (form.valid()) {
				partners.Modificar();
			};
		});

		partners.Listar();
	},
		Eliminar:function(id){
    $.ajax({
      url: url+'/IFMWeb/GSYSTEM/api/deletePartner',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente.");
        partners.Listar();
      }else{
        alertify.error(response);
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
	Guardar:function(){

		$.ajax({
			url: url+'/IFMWeb/GSYSTEM/api/createPartners',
			type: 'POST',
			data: new FormData( document.getElementById("frmPartners") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			partners.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Modificar:function(){
		$.ajax({
			url: url+'/IFMWeb/GSYSTEM/api/updatePartners',
			type: 'POST',
			data: new FormData( document.getElementById("frmPartners") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			partners.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	ModificarEstado:function(id, estado){

		$.ajax({
			url: url+'/IFMWeb/GSYSTEM/api/updateEstadoPartners',
			type: 'POST',
			data: {'idPartner':id, 'estado':estado},
			dataType:'json'
		}).done(function(response){

			alertify.success(response.msj);
			partners.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){

		$.getJSON(url+'/IFMWeb/GSYSTEM/api/listarPartners')
		.done(function(data) {

			var tablePartners = $("#tblPartners").dataTable();
			tablePartners.fnClearTable();
			tablePartners.fnDestroy();
			
			$.each( data, function( i, item ) {
				$("#tbodyPartners").append(tmpl("tmpl-data-partners", item));
			});

			tablePartners = $('#tblPartners').dataTable({
				"language": {
					"url": "dist/js/Spanish.json"
				}
			});

			partners.Limpiar();
		}).fail(function(response){
			console.log(response);
		});
	},
	Edit:function(id, nombre, url){

		$("#idPartner").val(id);
		$("#nombrePartner").val(nombre);
		$("#title-form").text('Modificar Partner');

		var validator = $( "#frmPartners" ).validate();
		validator.resetForm();

		var $requiredUrl = $('#urlPartner');
		$requiredUrl.removeAttr('required');
		$("#idPartner").attr("required", true);

		$("#btnGuardarPartner").css("display","none");
		$("#btnModificarPartner").css("display","block");
	},
	Limpiar:function(){

		$("#idPartner").val("");
		$("#nombrePartner").val("");
		$("#urlPartner").val("");
		$("#title-form").text("Crear Partner");
		$("#btnGuardarPartner").css("display","block");
		$("#btnModificarPartner").css("display","none");

		var validator = $( "#frmPartners" ).validate();
		validator.resetForm();

		$("#urlPartner").attr("required", true);
		var $requiredId = $('#idPartner');
		$requiredId.removeAttr('required');
	}
}