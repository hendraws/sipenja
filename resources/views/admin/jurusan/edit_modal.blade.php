<form action="{{ action('RefJurusanController@update', $jurusan->id) }}" method="POST">
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
			<label for="nomor" class="col-sm-4 col-form-label">Fakultas</label>
			<div class="col-md-8">
				<select class="form-control" name="fakultas_id">
					<option disabled selected>Pilih Fakultas</option>
					@foreach($fakultas as $v)
					<option value="{{ $v->id }}" {{ $v->id == $jurusan->fakultas_id ? 'selected' : '' }} >{{ $v->name }}</option>
					@endforeach()
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="kode_Jurusan" class="col-sm-4 col-form-label">Kode Jurusan</label>
			<div class="col-md-8">
				<input  required type="text" id="kode_jurusan" class="form-control hitung" name="kode_jurusan" value="{{ $jurusan->kode_jurusan }}">
			</div>
		</div>		
		<div class="form-group row">
			<label for="name" class="col-sm-4 col-form-label">Nama Jurusan</label>
			<div class="col-md-8">
				<input  required type="text" id="name" class="form-control hitung" name="name" value="{{ $jurusan->name }}">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>