@extends('layouts.app_master')
@section('title','Tambah MataKuliah')

@section('js')
@endsection

@section('content')
<div class="card card-primary card-outline">

	<div class="card-body">
		<form action="{{ action('MataKuliahController@store') }}" method="POST">
			@csrf
			<div class="form-group row">
				<label for="kode_mk" class="col-sm-2 col-form-label">Kode MataKuliah</label>
				<div class="col-md-10">
					<input  required type="text" id="kode_mk" class="form-control hitung" name="kode_mk">
				</div>
			</div>
			<div class="form-group row">
				<label for="nama_mk" class="col-sm-2 col-form-label">Nama MataKuliah</label>
				<div class="col-md-10">
					<input  required type="text" id="nama_mk" class="form-control hitung" name="nama_mk">
				</div>
			</div>
			<div class="form-group row">
				<label for="semester" class="col-sm-2 col-form-label">Semester</label>
				<div class="col-md-10">
					<input  required type="text" id="semester" class="form-control hitung" name="semester">
				</div>
			</div>
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Jurusan</label>
				<div class="col-md-10">
					<select class="form-control" name="jurusan_id" required>
						<option disabled selected>Pilih Jurusan</option>
						@foreach($jurusan as $v)
						<option value="{{ $v->id }}" >{{ $v->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a href="{{ action('MataKuliahController@index') }}" class="btn btn-secondary">Kembali</a>
				<button class="btn btn-brand btn-square btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
@endsection


