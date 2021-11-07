<form action="{{ action('LokasiTutorialController@update', $lokasi) }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit Jurusan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('put')
		<div class="form-group row">
			<label for="lokasi" class="col-sm-4 col-form-label">Lokasi</label>
			<div class="col-md-8">
				<input  required type="text" id="lokasi" class="form-control hitung" name="lokasi" value="{{ $lokasi->lokasi }}">
			</div>
		</div>		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>