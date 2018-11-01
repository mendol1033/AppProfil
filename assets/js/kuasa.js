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
			"url" : base_url+"kuasa/ajax_list",
			"type" : "POST",
			"data" : function(d){
				d.id = id;
				d.menu_id = menu_id;
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

// Form Validation
$("#form").validate({
	errorClass : "help-block",
	validClass : "has-success",
	rules : {
		NmPIC : "required",
		JenisID : "required",
		NoIdentitas : "required",
		Jabatan : "required",
		Alamat : "required",
		NoHp1 : "required",
		NoHp2 : "required",
		Email : "required",
		MasaKerja : "required",
		WargaNegara : "required",
		Foto : "required"
	},
	messages : {
		NmPIC : "Field Nama Penanggung Jawab Tidak Boleh Kosong",
		JenisID : "Pilih Jenis Identitas Yang Dimiliki Penanggung Jawab",
		NoIdentitas : "Field Nomor Identitas Tidak Boleh Kosong",
		Jabatan : "Field Jabatan Tidak Boleh Kosong",
		Alamat : "Field Alamat Tidak Boleh Kosong",
		NoHp1 : "Field Nomor Handphone 1 Tidak Boleh Kosong",
		NoHp2 : "Field Nomor Handphone 2 Tidak Boleh Kosong",
		Email : "Field Email Tidak Boleh Kosong",
		MasaKerja : "Field Masa Kerja Tidak Boleh Kosong",
		WargaNegara : "Field Kewarganegaraan Tidak Boleh Kosong",
		Foto : "Pilih File Yang Akan Diupload Terlebih Dahulu"
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

$("#Simpan").on("click", function(e){
	var url;
	var formData = document.getElementById('form');
	var post = new FormData(formData);
	post.append('id',id);

	if (save_method === "add") {
		url = base_url+"kuasa/add";
	} else {
		url = base_url+'kuasa/edit';
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

$("#tambah_Dokumen").on("click", function(e){
	e.preventDefault();
	save_method = 'add';
	$("#form")[0].reset();
	$('[name="group"]').val(menu_id);
	$("#JenisID").trigger('change');
	$('[name="Foto"]').attr('disabled',false);
	$(".modal-title").text("TAMBAH DATA PENANGGUNG JAWAB");
	$("#modalForm").modal("show");
})

function edit(idKuasa) {
	save_method="edit";
	$.ajax({
		url: base_url+"kuasa/getKuasaById",
		type: "GET",
		dataType: "JSON",
		data:{id: id, idKuasa: idKuasa},
		success: function(data) {
			$("#modalForm").modal("show");
			$('[name="NmPIC"]').val(data.nama_pj);
			$('[name="JenisID"]').val(data.jenis_id);
			$('[name="JenisID"]').trigger("change");
			$('[name="NoIdentitas"]').val(data.nomor_identitas);
			$('[name="Jabatan"]').val(data.jabatan);
			$('[name="Alamat"]').val(data.alamat);
			$('[name="NoHp1"]').val(data.no_hp);
			$('[name="NoHp2"]').val(data.no_hp2);
			$('[name="Email"]').val(data.email);
			$('[name="MasaKerja"]').val(data.masa_kerja);
			$('[name="WargaNegara"]').val(data.warga_negara);
			$(".modal-title").text("EDIT DOKUMEN");
			$('#btnDisable').removeClass('sr-only');
			$('#btnDisable').text('TIDAK UPLOAD FOTO BARU');
		}
	})
}

function view(idKuasa){
	$("#formView")[0].reset();

	$.ajax({
		url: base_url+"kuasa/getKuasaById",
		type: 'GET',
		dataType: 'JSON',
		data : {id: id, idKuasa: idKuasa},
		success : function(data){
			$("select#IdPerusahaan").val(data.id_perusahaan);
			$("input#NmPIC").val(data.nama_pj);
			$("input#JenisID").val(data.jenis_id);
			$("input#NoIdentitas").val(data.nomor_identitas);
			$("input#Jabatan").val(data.jabatan);
			$("textarea#Alamat").val(data.alamat);
			$("input#NoHp1").val(data.no_hp);
			$("input#NoHp2").val(data.no_hp2);
			$("input#Email").val(data.email);
			$("input#MasaKerja").val(data.masa_kerja);
			$("input#WargaNegara").val(data.warga_negara);
			if(!data.foto_pj){
				$("#fotoKaryawan").attr("src",base_url+"assets/img/profile/default.png");
			} else {
				$("#fotoKaryawan").attr("src",base_url+"assets/img/profile_importir/"+data.foto_pj);
			}

			$("#viewDetail").modal("show");
		}
	})

}

$("#btnDisable").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	if ($('[name="Foto"]').attr('disabled')) {
		$('[name="Foto"]').attr('disabled',false);
		$("#btnDisable").text('TIDAK UPLOAD FOTO BARU');
	} else {
		$('[name="Foto"]').attr('disabled',true);
		$("#btnDisable").text('UPLOAD FOTO BARU');
	}
});

$("#modalForm").on("hidden.bs.modal",function(){
	$("#form")[0].reset();
	$("#jnsDokumen").trigger('change');
	$("#pesanError").empty();
	$(".col-sm-9").children('.help-block').remove();
	$(".col-sm-9").removeClass('has-success');
	$(".form-group").removeClass('has-success');
	$(".col-sm-9").removeClass('has-error');
	$(".form-group").removeClass('has-error');
	$('#btnDisable').addClass('sr-only');
})