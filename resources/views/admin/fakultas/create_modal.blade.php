<form action="{{ action('RefFakultasController@store') }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tambah Fakultas</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		<div class="form-group row">
			<label for="kode_fakultas" class="col-sm-4 col-form-label">Kode Fakultas</label>
			<div class="col-md-8">
				<input  required type="text" id="kode_fakultas" class="form-control hitung" name="kode_fakultas">
			</div>
		</div>		
		<div class="form-group row">
			<label for="name" class="col-sm-4 col-form-label">Nama Fakultas</label>
			<div class="col-md-8">
				<input  required type="text" id="name" class="form-control hitung" name="name">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>