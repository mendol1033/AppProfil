<script type="text/javascript">

	var chart = null;
	var dataPoints = [];

	$(document).ready(function() {
		$.ajax({
			url: "<?php echo base_url().'dashboard/summary/getData';?>",
			type: "POST",
			dataType: "JSON",
			success: function (data) {
				$('#BC23').text(data.jumlahDokumen.BC23);
				$('#BC25').text(data.jumlahDokumen.BC25);
				$('#BC26').html(data.jumlahDokumen.BC261 + "<br>" + data.jumlahDokumen.BC262);
				$('#BC27').text(data.jumlahDokumen.BC27);
				$('#BC30').text(data.BC30);
				$('#BC4').html(data.jumlahDokumen.BC40 + "<br>" + data.jumlahDokumen.BC41);
				console.log(data.dokPerBulan23.length);
			}
		})
	});

	window.onload = function() {
		chart = new CanvasJS.chart("chartDokumen",{
			animationEnabled : true,
			theme: "light2",
			title: {
				text : "DOKUMEN BC 23"
			},
			axisY: {
				title: "Dokumen",
				titleFontSize: 20
			},
			data:[{
				type: "column",
				yValueFormatString: "# Dokumen",
				dataPoints:dataPoints
			}]
		})
	}

	$.ajax({
		url: "<?php echo base_url().'dashboard/summary/getData';?>",
		type: "GET",
		dataType: 'JSON',
		success: function(data){

		}
	});
	
</script>