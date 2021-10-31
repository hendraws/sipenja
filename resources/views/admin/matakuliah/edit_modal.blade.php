
<form action="{{ action('MataKuliahController@update', $matakuliah->id) }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit Matakuliah</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('put')
		<div class="form-group row">
			<label for="kode_mk" class="col-sm-4 col-form-label">Kode MataKuliah</label>
			<div class="col-md-8">
				<input  required type="text" id="kode_mk" class="form-control" name="kode_mk" value="{{ $matakuliah->kode_mk }}">
			</div>
		</div>
		<div class="form-group row">
			<label for="nama_mk" class="col-sm-4 col-form-label">Nama MataKuliah</label>
			<div class="col-md-8">
				<input  required type="text" id="nama_mk" class="form-control" name="nama_mk" value="{{ $matakuliah->nama_mk }}">
			</div>
		</div>
		<div class="form-group row">
			<label for="semester" class="col-sm-4 col-form-label">Semester</label>
			<div class="col-md-8">
				<input  required type="text" id="semester" class="form-control" name="semester" value="{{ $matakuliah->semester }}">
			</div>
		</div>
		<div class="form-group row">
			<label for="nomor" class="col-sm-4 col-form-label">Jurusan</label>
			<div class="col-md-8">
				<select class="form-control" name="jurusan_id" required>
					<option disabled selected>Pilih Jurusan</option>
					@foreach($jurusan as $v)
					<option value="{{ $v->id }}" {{ $matakuliah->jurusan_id == $v->id ? 'selected' : '' }} >{{ $v->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>