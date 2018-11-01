<script type="text/javascript">
	var table;
	var save_method;
	var idEdit;
	$(document).ready(function() {
		// initialize class select2
		$(".select2").select2({
			width : '100%'
		});

		// iCheck
		$('input[type="checkbox"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
		})

		// dateMasking and datePicker
		$("#tanggal, #TglSkepPendirian, #TglSkepAkhir, #TglDokumen, #tglPembatalan, #TglJatuhTempo").inputmask(
			'yyyy-mm-dd',{'placeholder' : 'yyyy-mm-dd'}
			);

		$("#tanggal, #TglSkepPendirian, #TglSkepAkhir, #TglDokumen, #tglPembatalan, #TglJatuhTempo").datepicker({
			autoclose : true,
			format : 'yyyy-mm-dd'
		});

		//Timepicker
		$("#wktMulai, #wktSelesai").daterangepicker({
			autoUpdateInput:false,
			singleDatePicker: true,
			showDropdowns: true,
			timePicker:true,
			timePicker24Hour:true,
		});

		$('#wktMulai, #wktSelesai').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD H:m'));
		});

		$('#wktMulai, #wktSelesai').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});

		// initialize dataTable
		table = $('#dataTable').DataTable({
			initComplete : function(){
				var api = this.api();
				$("#dataTable_filter input")
				.off('.DT')
				.on('keyup.DT', function(e){
					if(e.keyCode == 13){
						api.search(this.value).draw();
					}
				});
			},
			"processing" : true,
			"serverSide" : true,
			"responsive" : true,
			"autoWidth"	 : false,
			"bFilter" 	 : false,
			"order" : [],
			"ajax" : {
				"url" : "<?php echo base_url().'pengawasan/tpb/ajax_list'?>",
				"type" : "POST",
			},
		});

		// initialize another select2
		// $("#filterPerusahaan").select2({
		// 	width : '100%',
		// 	placeholder: 'Masukkan Nama Perushaan',
		// 	minimumInputLength: 5,
		// 	allowClear: true,
		// 	ajax : {
		// 		url : "<?php echo base_url().'perusahaan/tpb/getDropDownNPWP/';?>",
		// 		dataType : "JSON",
		// 		delay : 250,
		// 		data : function(params){
		// 			return{
		// 				nama : params.term
		// 			};
		// 		},
		// 		processResults: function(data){
		// 			var results = [];

		// 			$.each(data, function(index, item){
		// 				results.push({
		// 					id : item.username,
		// 					text : item.name
		// 				})
		// 			});
		// 			return{
		// 				results : results
		// 			};
		// 		},
		// 		cache : true
		// 	}
		// });

		$("#form").validate({
			errorClass : "text-danger",
			rules : {
				NPWP : "required",
				NamaPerusahaan : "required",
				Fasilitas : "required",
				Jenis : "required",
				AlamatPabrik : "required",
				AlamatKantor : "required",
				ProfilResiko : "required",
				NoSkepPendirian : "required",
				TglSkepPendirian : "required",
				NoSkepAkhir : "required",
				TglSkepAkhir : "required",
				KategoriUsaha : "required",
				TglJatuhTempo : "required",
				NamaPenanggungJawab : "required",
				WNPenanggungJawab : "required",
				Luas : "required",
				Status : "required",
				Lokasi : "required",
			},
			messages : {
				NPWP : "Kolom NPWP Tidak Boleh Kosong",
				NamaPerusahaan : "Kolom Nama Perusahaan Tidak Boleh Kosong",
				Fasilitas : "Kolom Fasilitas Tidak Boleh Kosong",
				Jenis : "Kolom Jenis TPB Tidak Boleh Kosong",
				AlamatPabrik : "Kolom Alamat Pabrik Tidak Boleh Kosong",
				AlamatKantor : "Kolom Alamat Kantor Tidak Boleh Kosong",
				ProfilResiko : "Kolom Profil Resiko Tidak Boleh Kosong",
				NoSkepPendirian : "Kolom No Skep Pendirian Tidak Boleh Kosong",
				TglSkepPendirian : "Kolom Tanggal Skep Pendirian Tidak Boleh Kosong",
				NoSkepAkhir : "Kolom No Skep Terbaru Tidak Boleh Kosong",
				TglSkepAkhir : "Kolom Tanggal Skep Terbaru Tidak Boleh Kosong",
				KategoriUsaha : "Kolom Kategori Usaha Tidak Boleh Kosong",
				TglJatuhTempo : "Kolom Tanggal Jatuh Tempo Skep Tidak Boleh Kosong",
				NamaPenanggungJawab : "Kolom Nama Penanggung Jawab Tidak Boleh Kosong",
				WNPenanggungJawab : "Kolom Warga Negara Tidak Boleh Kosong",
				Luas : "Kolom Luas Tidak Boleh Kosong",
				Status : "Kolom Status Tidak Boleh Kosong",
				Lokasi : "Kolom Lokasi Tidak Boleh Kosong",
			},
			errorElement : "span",
			errorPlacement:function(error,element){
				offset = element.offset();
				error.insertAfter(element);
				$("#mainFormCeisa > .form-group").addClass('has-error');
			}
		});
	})

	$("#btnTambah").click(function(e) {
		e.preventDefault();
		save_method = "add";
		$("#form")[0].reset();
		$(".modal-title").text("Tambah Data Perusahaan");
		$("#simpan").removeClass('sr-only');
		$("#modal").modal('show');
	});

	function edit(id){
		$.ajax({
			url: "<?php echo base_url().'pengawasan/tpb/getById/';?>"+id,
			type: 'GET',
			dataType: 'JSON',
			data: {id: id},
			success:function(data){
				idEdit = id;
				save_method = "edit";
				$("#NPWP").val(data.NPWP);
				$("#NamaPerusahaan").val(data.NmPerusahaan);
				$("#Fasilitas").val(data.Fasilitas);
				$("#Fasilitas").trigger('change');
				$("#Jenis").val(data.Jenis);
				$("#Jenis").trigger('change');
				$("#AlamatPabrik").val(data.AlamatPabrik);
				$("#AlamatKantor").val(data.AlamatKantor);
				$("#ProfilResiko").val(data.ProfilResiko);
				$("#ProfilResiko").trigger('change');
				$("#NoSkepPendirian").val(data.NoSkepPendirian);
				$("#TglSkepPendirian").val(data.TglSkepPendirian);
				$("#NoSkepAkhir").val(data.NoSkepAkhir);
				$("#TglSkepAkhir").val(data.TglSkepAkhir);
				$("#TglJatuhTempo").val(data.TglJatuhTempo);
				$("#KategoriUsaha").val(data.KategoriUsaha);
				$("#NamaPenanggungJawab").val(data.NamaPenanggungJawab);
				$("#WNPenanggungJawab").val(data.WNPenanggungJawab);
				$("#Luas").val(data.Luas);
				$("#Status").val(data.Status);
				$("#Status").trigger('change');
				$("#Lokasi").val(data.Lokasi);
				$("#Lokasi").trigger('change');
				$(".modal-title").text("Detail Perushaan");
				$("#simpan").removeClass('sr-only');
				$("#modal").modal('show');
			}
		})		
	}

	function view(id){
		$.ajax({
			url: "<?php echo base_url().'pengawasan/tpb/getById/';?>"+id,
			type: 'GET',
			dataType: 'JSON',
			data: {id: id},
			success:function(data){
				$("#NPWP").val(data.NPWP);
				$("#NamaPerusahaan").val(data.NmPerusahaan);
				$("#Fasilitas").val(data.Fasilitas);
				$("#Fasilitas").trigger('change');
				$("#Jenis").val(data.Jenis);
				$("#Jenis").trigger('change');
				$("#AlamatPabrik").val(data.AlamatPabrik);
				$("#AlamatKantor").val(data.AlamatKantor);
				$("#ProfilResiko").val(data.ProfilResiko);
				$("#ProfilResiko").trigger('change');
				$("#NoSkepPendirian").val(data.NoSkepPendirian);
				$("#TglSkepPendirian").val(data.TglSkepPendirian);
				$("#NoSkepAkhir").val(data.NoSkepAkhir);
				$("#TglSkepAkhir").val(data.TglSkepAkhir);
				$("#TglJatuhTempo").val(data.TglJatuhTempo);
				$("#KategoriUsaha").val(data.KategoriUsaha);
				$("#NamaPenanggungJawab").val(data.NamaPenanggungJawab);
				$("#WNPenanggungJawab").val(data.WNPenanggungJawab);
				$("#Luas").val(data.Luas);
				$("#Status").val(data.Status);
				$("#Status").trigger('change');
				$("#Lokasi").val(data.Lokasi);
				$("#Lokasi").trigger('change');
				$(".modal-title").text("Detail Perushaan");
				$("#simpan").addClass('sr-only');
				$("#modal").modal('show');
			}
		})
	}

	function save(){
		var url;
		var data;
		data = $("#form").serializeArray();

		if (save_method == "add"){
			url = "<?php echo base_url().'pengawasan/tpb/ajax_add';?>";
		} else {
			data[data.length] = {name: "id", value: idEdit};
			url = "<?php echo base_url().'pengawasan/tpb/ajax_update'?>";
		}

		if($("#form").valid()){
			$("#form").remove(".help-block");
			$("#form > .form-group").removeClass('has-error');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: data,
				success : function(data){
					$("#modal").modal("hide");
					ajax_reload();
					alert(data);
				}
			})			
		}
	}

	function ajax_reload(){
		table.ajax.reload(null,null);
	}

	$("#filterPerusahaan").on('input', function(event) {
		var urlFilter;
		event.preventDefault();
		f1 = $("#filterPerusahaan").val();

		if(f1.length > 4){
			urlFilter = "?nama=" + f1;
		}
		ajax_load_table(urlFilter);
		/* Act on the event */
	});

	function ajax_load_table(filter){
		table.ajax.url("<?php echo base_url().'pengawasan/tpb/ajax_list/'?>"+filter).load();
	}
</script>