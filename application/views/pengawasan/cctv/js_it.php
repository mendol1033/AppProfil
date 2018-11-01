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
				"url" : "<?php echo base_url().'pengawasan/it/ajax_list'?>",
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

		$("#NamaPerusahaan").select2({
			width : '100%',
			placeholder: 'Masukkan Nama Perusahaan',
			minimumInputLength: 5,
			allowClear: true,
			ajax : {
				url : "<?php echo base_url().'pengawasan/it/getDropDownNPWP/';?>",
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
							id : item.IdPerusahaan,
							text : item.NmPerusahaan + " | " + item.Fasilitas + " | " + item.NoSkepAkhir
						})
					});
					return{
						results : results
					};
				},
				cache : true
			}
		});

		$("#formCCTV").validate({
			errorClass : "text-danger",
			rules : {
				NamaPerusahaan : "required",
				Browser : "required",
				IpAddress : "required",
				Username : "required",
				Password : "required",
				Status : "required",
				Realtime : "required"
			},
			messages : {
				NamaPerusahaan : "Kolom Nama Perusahaan Tidak Boleh Kosong",
				Browser : "Kolom Browser Tidak Boleh Kosong",
				IpAddress : "Kolom Ip Address Tidak Boleh Kosong",
				Username : "Kolom Username Tidak Boleh Kosong",
				Password : "Kolom Password Tidak Boleh Kosong",
				Status : "Kolom Status Tidak Boleh Kosong",
				Realtime : "Kolom Playback Tidak Boleh Kosong",
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
		$("#formCCTV")[0].reset();
		$("#Browser").trigger('change');
		$("#Status").trigger('change');
		$("#Realtime").trigger('change');
		$(".modal-title").text("Tambah Data CCTV");
		$("#modal").modal('show');
	});

	function edit(id){
		$.ajax({
			url: "<?php echo base_url().'pengawasan/it/getById/';?>"+id,
			type: 'GET',
			dataType: 'JSON',
			data: {id: id},
			success:function(data){
				idEdit = id;
				save_method = "edit";
				$(".modal-title").text("Detail CCTV");
				selectedValue(data.IdPerusahaan,data.NmPerusahaan);
				$("#Browser").val(data.Browser);
				$("#Browser").trigger('change');
				$("#IpAddress").val(data.IpAddress);
				$("#Username").val(data.Username);
				$("#Password").val(data.Password);
				$("#Status").val(data.Status);
				$("#Status").trigger('change');
				$("#Realtime").val(data.Realtime);
				$("#Realtime").trigger('change');
				$("#Keterangan").val(data.Keterangan);
				$("#modal").modal('show');
			}
		})		
	}

	function selectedValue(a,b){
		var data = [{id:a,text:b}];
		var selectedVal = $("#NamaPerusahaan");
		var option = new Option(b,a,true,true);
		selectedVal.append(option).trigger('change');

		selectedVal.trigger({
			type: "select2:select",
			params: {
				data: data
			}
		})
	}

	function save(){
		var url;
		var data;
		data = $("#formCCTV").serializeArray();

		if(save_method == "add"){
			url = "<?php echo base_url().'pengawasan/it/ajax_add'?>";
		} else {
			data[data.length] = {name: "id", value: idEdit};
			url = "<?php echo base_url().'pengawasan/it/ajax_update'?>";
		}

		if($("#formCCTV").valid()){
			$("#formCCTV").remove(".help-block");
			$("#formCCTV > .form-group").removeClass('has-error');
			$.ajax({
				url: url,
				type: "POST",
				dataType: "JSON",
				data: data,
				success : function(data){
					$("#modal").modal("hide");
					ajax_reload();
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

		if (f1.length > 4){
			urlFilter = "?nama=" + f1;
		}

		ajax_load_table(urlFilter);
		/* Act on the event */
	});

	function ajax_load_table(filter){
		table.ajax.url("<?php echo base_url().'pengawasan/it/ajax_list/'?>" + filter).load();
	}
</script>