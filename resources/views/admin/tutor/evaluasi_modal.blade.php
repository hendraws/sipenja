<form action="{{ action('TutorController@updateEvaluasi', $tutor->id) }}" method="POST" enctype="multipart/form-data">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi Tutorial</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('patch')
		<div class="form-group row">
			<label for="nilai" class="col-sm-4 col-form-label">Kriteria Penilaian</label>
			<div class="col-md-8">
				<select class="form-control select" name="nilai" required>
					<option disabled selected>Pilih Kriteria</option>
					<option value="5" >Sangat Baik</option>
					<option value="4" >Baik</option>
					<option value="3" >Cukup</option>
					<option value="2" >Kurang</option>
					<option value="1" >Sangat Kurang</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="file" class="col-sm-4 col-form-label">File</label>
			<div class="col-md-8">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFile" accept="text/plain, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" name="file">
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
			</div>
		</div>		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>

<script type="text/javascript">
	$('.custom-file-input').on('change', function() { 
		let fileName = $(this).val().split('\\').pop(); 
		$(this).next('.custom-file-label').addClass("selected").html(fileName); 
	});
</script>