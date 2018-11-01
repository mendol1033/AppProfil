<script type="text/javascript">
	$(document).ready(function() {
		$('#form_uploadDokumen').on('submit', function(e){
			e.preventDefault();
			if($('#dataExcel').val() == ''){
				alert("Pilih File Excel Yang Akan Di Upoad");
			} else {
				$.ajax({
					url: "<?php echo base_url().'admin/uploaddata/uploadDokumen'?>",
					method : "POST",
					data : new FormData(this),
					contentType : false,
					cache : false,
					processData : false,
					dataType : "JSON",
					beforeSend: function(jqXHR, exception){
						$("#Dokumen > #loadingState").removeClass('sr-only');
					},
					success : function(data){
						$("#Dokumen > #loadingState").addClass('sr-only');
						$("#DokumenBody > #feedbackArea").removeClass('sr-only');
						$("#DokumenBody > #feedbackArea > div > p > #feedbackApp").text(data.pesan);
					},
					error : function(jqXHR, exception){
						$("#Dokumen > #loadingState").addClass('sr-only');
						$("#DokumenBody > #feedbackArea").removeClass('sr-only');
						$("#DokumenBody > #feedbackArea > div > p > #feedbackApp").html(jqXHR.responseText);
						console.log(jqXHR);
					}
				})				
			}
		});

		$('#form_uploadNopen').on('submit', function(e){
			e.preventDefault();
			if($('#dataNopen').val() == ''){
				alert("Pilih File Excel Yang Akan Di Upoad");
			} else {
				$.ajax({
					url: "<?php echo base_url().'admin/uploaddata/uploadNopen'?>",
					method : "POST",
					data : new FormData(this),
					contentType : false,
					cache : false,
					processData : false,
					dataType : "JSON",
					beforeSend: function(jqXHR, exception){
						$("#Nopen > #loadingState").removeClass('sr-only');
					},
					success : function(data){
						$("#Nopen > #loadingState").addClass('sr-only');
						$("#NopenBody > #feedbackArea").removeClass('sr-only');
						$("#NopenBody > #feedbackArea > div > p > #feedbackApp").text(data.pesan);
						console.log(data);
					},
					error : function(jqXHR, exception){
						$("#Nopen > #loadingState").addClass('sr-only');
						$("#NopenBody > #feedbackArea").removeClass('sr-only');
						$("#NopenBody > #feedbackArea > div > p > #feedbackApp").html(jqXHR.responseText);
						console.log(jqXHR);
					}
				})				
			}
		});
	});

	function removeFeedback(){
		$("#NopenBody > #feedbackArea > div > p > #feedbackApp, #DokumenBody > #feedbackArea > div > p > #feedbackApp").empty();
		$("#DokumenBody > #feedbackArea, #NopenBody > #feedbackArea").addClass("sr-only");
		$("#form_uploadDokumen")[0].reset();
		$("#form_uploadNopen")[0].reset();
	}
</script>