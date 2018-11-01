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
		$("#tanggal, #tglAwal, #tglAkhir, #TglDokumen, #tglPembatalan").inputmask(
			'yyyy-mm-dd',{'placeholder' : 'yyyy-mm-dd'}
			);

		$("#tanggal, #tglAwal, #tglAkhir, #TglDokumen, #tglPembatalan").datepicker({
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
				"url" : "<?php echo base_url().'dokumen/dokumen23/ajax_list'?>",
				"type" : "POST",
			},
		});

		// initialize another select2
		$("#NamaPerusahaan, #filterPerusahaan").select2({
			width : '100%',
			placeholder: 'Masukkan Nama Perushaan',
			minimumInputLength: 5,
			allowClear: true,
			ajax : {
				url : "<?php echo base_url().'perusahaan/tpb/getDropDownNPWP/';?>",
				dataType : "JSON",
				delay : 250,
				data : function(params){
					return{
						nama : params.term
					};
				},
				processResults: function(data){
					var results = [];

					$.each(data, function(index, item){
						results.push({
							id : item.username,
							text : item.name
						})
					});
					return{
						results : results
					};
				},
				cache : true
			}
		});

		$("#mainFormCeisa").validate({
			errorClass : "text-danger",
			rules : {
				NamaPerusahaan : "required",
				JnsDokumen : "required",
				NoDokumen : "required",
				TglDokumen : "required",
				dokPembatalan : "required",
				tglPembatalan : "required",
				Alasan : "required"
			},
			errorElement : "span",
			errorPlacement:function(error,element){
				offset = element.offset();
				error.insertAfter(element);
				$("#mainFormCeisa > .form-group").addClass('has-error');
			}
		});
	});

	function ajax_reload(){
		table.ajax.reload(null,null);
	}

	function view(id){
		$.ajax({
			url: "<?php echo base_url().'hanggar/monevceisa/ajax_edit';?>",
			type: "GET",
			dataType: "JSON",
			data: {id : id},
			success : function(data){
				$("#NamaPerusahaan").html('<option selected value="'+data.perusahaan.id_perusahaan+'">'+data.perusahaan.nama_perusahaan+'</option>');
				$('[name="JnsDokumen"]').val(data.pembatalan.JnsDok);
				$('[name="JnsDokumen"]').trigger("change");
				$("#NoDokumen").val(data.pembatalan.NmrDok);
				$("#TglDokumen").val(data.pembatalan.TglDok);
				$("#dokPembatalan").val(data.pembatalan.NoPembatalan);
				$("#tglPembatalan").val(data.pembatalan.TglPembatalan);
				$("#Alasan").val(data.pembatalan.Alasan);
				$("#simpan").addClass('sr-only');
				$("#modalFormCeisa").modal("show");
			}
		})		
	}

	$("#tutup, .close").on('click', function(event) {
		event.preventDefault();
		$("#simpan").removeClass('sr-only');
	});

	function edit(id){
		$.ajax({
			url: "<?php echo base_url().'hanggar/monevceisa/ajax_edit';?>",
			type: "GET",
			dataType: "JSON",
			data: {id : id},
			success : function(data){
				idEdit = id;
				save_method = "edit";
				$("#NamaPerusahaan").html('<option selected value="'+data.perusahaan.id_perusahaan+'">'+data.perusahaan.nama_perusahaan+'</option>');
				$('[name="JnsDokumen"]').val(data.pembatalan.JnsDok);
				$('[name="JnsDokumen"]').trigger("change");
				$("#NoDokumen").val(data.pembatalan.NmrDok);
				$("#TglDokumen").val(data.pembatalan.TglDok);
				$("#dokPembatalan").val(data.pembatalan.NoPembatalan);
				$("#tglPembatalan").val(data.pembatalan.TglPembatalan);
				$("#Alasan").val(data.pembatalan.Alasan);
				$("#modalFormCeisa").modal("show");
			}
		})	
	}

	$("#btnTambah").on('click', function(event) {
		save_method = "add";
		event.preventDefault();
		$(".modal-title").text('Tambah Data Laporan Kendala CEISA');
		$("#mainFormCeisa")[0].reset();
		$("#NamaPerusahaan > option").remove();
		$('[name="JnsDokumen"]').trigger('change');
		$("#mainFormCeisa").remove(".help-block");
		$("#mainFormCeisa > .form-group").removeClass('has-error');
		$("#modalFormCeisa").modal("show");

	});

	function save(){
		var url;
		var data;
		data = $("#mainFormCeisa").serializeArray();

		if(save_method == "add"){
			url = "<?php echo base_url().'hanggar/monevceisa/ajax_add'?>";
		} else {
			data[data.length] = {name: "id", value: idEdit};
			url = "<?php echo base_url().'hanggar/monevceisa/ajax_update'?>";
		}

		if($("#mainFormCeisa").valid()){
			$("#mainFormCeisa").remove(".help-block");
			$("#mainFormCeisa > .form-group").removeClass('has-error');
			$.ajax({
				url: url,
				type: "POST",
				dataType: "JSON",
				data: data,
				success : function(data){
					console.log(data);
					$("#modalFormCeisa").modal("hide");
					ajax_reload();
				}
			})
		}
	}

	$("#btnFilter").on('click', function(event) {
		var urlFilter;
		event.preventDefault();
		f1 = $("#filterPerusahaan").val();
		ft1 = $("#tglAwal").val();
		ft2 = $("#tglAkhir").val();
		if (ft2 < ft1){
			alert('Tanggal Akhir Harus Lebih Besar Dari Tanggal Awal');
		} else {
			if (ft1.length > 0 && ft2.length > 0) {
				if(f1 === null){
					urlFilter = "?id=0"+"&tglAwal="+ft1+"&tglAkhir="+ft2;
				} else {
					urlFilter = "?id="+f1+"&tglAwal="+ft1+"&tglAkhir="+ft2;
				}
				
			} else {
				if (f1 === null) {
					urlFilter= "?id=0";
				} else {
					urlFilter= "?id="+f1;
				}
			}
			ajax_load_table(urlFilter);
		}
		
		
		
	});

	$("#clearFilter").on('click', function(event) {
		event.preventDefault();
		$("#formFilter")[0].reset();
		$("#filterPerusahaan > option").remove();

	});

	function ajax_load_table(filter){
		table.ajax.url('<?php echo base_url()."dokumen/dokumen23/ajax_list/"?>'+filter).load();
	}
</script>