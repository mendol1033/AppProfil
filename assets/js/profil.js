var base_url = "http://"+window.location.host+"/DashboardTPB/";

$(".select2").select2({
	width : '100%'
});

$("#CCTV").select2({
	width : '100%',
	placeholder: 'Pilih Alamat CCTV',
	minimumInputLength: 5,
	allowClear: true,
	ajax : {
		url : base_url + "pengawasan/cctv/getByName/",
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
					text : item.NmPerusahaan
				})
			});
			return{
				results : results
			};
		},
		cache : true
	}
});