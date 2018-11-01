var table;
var tableData;
var save_method;

$(".select2").select2({
	width: "100%"
});

$(".tanggal").inputmask(
	'yyyy-mm-dd',{'placeholder' : 'yyyy-mm-dd'}
	);

$(".tanggal").datepicker({
	autoclose: true,
	format: "yyyy-mm-dd"
});

$(document).ready(function() {
	table = $('#dataTable').DataTable({
		initComplete : function(){
			var api = this.api();
			$('#dataTable_filter input').off('.DT').on('keyup.DT'), function(e){
				if(e.keyCode == 13){
					api.search(this.value).draw();
				}
			}
		},
		"processing" : true,
		"serverSide" : true,
		"responsive" : true,
		"autoWidth"	 : false,
		"searching" : false,
		"ajax" : {
			"url" : base_url+"dokumen/ajax_list",
			"type" : "POST",
			"data" : function(d){
				d.id = id;
				d.idSkep = getIdSkep();
			}
		},
		"columnDefs" : [
		{ 
			className : "tableButton", 
			"targets" : [6,7,8]
		}
		]
	})

});

function getIdSkep(){
	var filter = document.getElementById("filter");
	var filterValue = filter.options[filter.selectedIndex].value;
	return filterValue;
}

$("#filter").on("change",function(){
	table.ajax.reload();
})

// Form Validation
$("#form").validate({
	errorClass : "help-block",
	validClass : "has-success",
	rules : {
		no : "required",
		NmDokumen : "required",
		NoDokumen : "required",
		TglDokumen : "required",
		TglDokumenAkhir : "required",
		DokumenSkep : "required"
	},
	messages : {
		no : "Pilih Jenis Dokumen Terlebih Dahulu",
		NmDokumen : "Perihal Dokumen Tidak Boleh Kosong",
		NoDokumen : "No Dokumen Tidak Boleh Kosong",
		TglDokumen : "Tanggal Dokumen Tidak Boleh Kosong",
		TglDokumenAkhir : "Tanggal Jatuh Tempo Tidak Boleh Kosong",
		DokumenSkep : "Pilih File Yang Akan Diupload Terlebih Dahulu"
	},
	errorElement : "span",
	errorPlacement : function(error, element){
		// var parent = element.parent(".col-sm-9");
		error.appendTo(element.parents(".col-sm-9"));
	},
	highlight : function(element, errorClass, validClass){
		$(element).parentsUntil(".form-horizontal").addClass("has-error").removeClass(validClass);
	},
	unhighlight : function(element, errorClass, validClass){
		$(element).parentsUntil(".form-horizontal").addClass(validClass).removeClass("has-error");
	}

})

$("#tambah_Dokumen").on("click", function(e){
	e.preventDefault();
	save_method = 'add';
	$("#form")[0].reset();
	$("#jnsDokumen").trigger('change');
	$(".modal-title").text("TAMBAH DOKUMEN");
	$('#btnDisable').addClass('sr-only');
	$("#DokumenSkep").attr('disabled',false);
	$("#TambahDokumen").modal("show");
})

function view(idSkep){
	$.ajax({
		url: base_url+"dokumen/getSkepById",
		type: "GET",
		dataType: "JSON",
		data: {id: id, idSkep: idSkep},
		success : function(data){
			$(".modal-title").text(data.file_dok);
			$("#iframePDF").attr({
				src: base_url+"assets/upload/"+data.folder+"/"+data.file_dok
			});
			$("#viewDokumen").modal("show");
		}
	})	
}

function edit(IdSkep) {
	save_method="edit";
	$.ajax({
		url: base_url+"dokumen/getSkepById",
		type: "GET",
		dataType: "JSON",
		data:{id: id, idSkep: IdSkep},
		success: function(data) {
			$("#TambahDokumen").modal("show");
			$('[name="no"]').val(data.no);
			$('[name="no"]').trigger("change");
			$('[name="NmDokumen"]').val(data.nama_dokumen);
			$('[name="NoDokumen"]').val(data.no_dokumen);
			$('[name="TglDokumen"]').val(data.tgl_dok);
			$('[name="TglDokumenAkhir"]').val(data.tgl_berakhir_dok);
			$('[name="idSkep"]').val(data.id_skep);
			$(".modal-title").text("EDIT DOKUMEN");
			$('#btnDisable').removeClass('sr-only');
			$('#btnDisable').text('TIDAK UPLOAD FILE BARU');
		}
	})
}

$("#Simpan").on("click", function(e){
	var url;
	var formData = document.getElementById('form');
	var post = new FormData(formData);
	post.append('id',id);

	if (save_method === "add") {
		url = base_url+"dokumen/TambahDokumen";
	} else {
		url = base_url+'dokumen/EditDokumen';
	}

	e.preventDefault();
	$("Simpan").button('loading');

	if ($("#form").valid()){
		$.ajax({
			url: url,
			type: "POST",
			data: post,
			dataType: "JSON",
			contentType : false,
			processData : false,
			cahce : false,
			success : function(data){
				if(data.status === true){
					$("#pesanError").empty();
					$(".col-sm-9").children('.help-block').remove();
					$(".col-sm-9").removeClass('has-success');
					$(".form-group").removeClass('has-success');
					$("#Simpan").attr('disabled',false);
					table.ajax.reload(null,false);
					alert(data.pesan);
					$("#TambahDokumen").modal("hide");
					console.log(data);
				} else {
					$("#pesanError").html("<strong>"+data.pesan+"</strong>");
					$("#pesanError").addClass("text-danger");
				}
			}
		})
		.always(function(){
			console.log(post);
			$("#Simpan").button('reset');
		});	
	}
})

$("#btnDisable").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	if ($("#DokumenSkep").attr('disabled')) {
		$("#DokumenSkep").attr('disabled',false);
		$("#btnDisable").text('TIDAK UPLOAD FILE BARU');
	} else {
		$("#DokumenSkep").attr('disabled',true);
		$("#btnDisable").text('UPLOAD FILE BARU');
	}
});

$("#TambahDokumen").on("hidden.bs.modal",function(){
	$("#form")[0].reset();
	$("#jnsDokumen").trigger('change');
	$("#pesanError").empty();
	$(".col-sm-9").children('.help-block').remove();
	$(".col-sm-9").removeClass('has-success');
	$(".form-group").removeClass('has-success');
	$(".col-sm-9").removeClass('has-error');
	$(".form-group").removeClass('has-error');
})

function hapusDokumen(IdSkep){
	if(confirm("Dokumen Akan Dihapus")){
		$.ajax({
			url: base_url+"dokumen/HapusDokumen",
			type: "POST",
			dataType: 'JSON',
			data: {id: id, idSkep: IdSkep},
			success : function(data){
				table.ajax.reload(null, false);
				alert(data.pesan)
			}
		})
	}
}

function test(){
	alert(id);
}
