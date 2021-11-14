@extends('layouts.app_master')
@section('title','Tambah Tutor')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/jquery.datetimepicker/jquery.datetimepicker.css')}}">
<link href="{{ asset('vendors/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('plugins/jquery.datetimepicker/jquery.datetimepicker.full.js')}}"></script>
<script src="{{ asset('vendors/bootstrap/datepicker.js') }}"></script>
<script type="text/javascript">
	$(".tanggal").datepicker( {
		format: "yyyy-mm-dd",
	})
</script>
@endsection

@section('content')
<div class="card card-primary card-outline">

	<div class="card-body">
		<form action="{{ action('TutorController@store') }}" method="POST">
			@csrf
			<div class="form-group row">
				<label for="id_tutor" class="col-sm-2 col-form-label">ID TUTOR</label>
				<div class="col-md-10">
					<input  required type="number" id="id_tutor" class="form-control" name="id_tutor">
				</div>
			</div>
			<div class="form-group row">
				<label for="nip" class="col-sm-2 col-form-label">NIP</label>
				<div class="col-md-10">
					<input  required type="number" id="nip" class="form-control hitung" name="nip">
				</div>
			</div>
			<div class="form-group row">
				<label for="nama" class="col-sm-2 col-form-label">Nama</label>
				<div class="col-md-10">
					<input  required type="text" id="nama" class="form-control" name="nama">
				</div>
			</div>			
			<div class="form-group row">
				<label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
				<div class="col-md-10">
					<input  required type="text" id="tanggal_lahir" class="form-control bg-light tanggal" name="tanggal_lahir" autocomplete="off" readonly>
				</div>
			</div>	
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-md-10">
					<select class="form-control" name="gender" required>
						<option disabled selected>Pilih Jenis Kelamin</option>
						<option value="laki-laki">Laki Laki</option>
						<option value="perempuan">Perempuan</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-md-10">
					<textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
				<div class="col-md-10">
					<input  required type="number" id="telepon" class="form-control" name="telepon">
				</div>
			</div>	
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-md-10">
					<input  required type="email" id="email" class="form-control" name="email">
				</div>
			</div>		
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Status</label>
				<div class="col-md-10">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
						<label class="form-check-label" for="status1">Aktif</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="status" id="status2" value="2">
						<label class="form-check-label" for="status2">Tidak Aktif</label>
					</div>
				</div>
			</div>	
			<div class="modal-footer">
				<a href="{{ action('TutorController@index') }}" class="btn btn-secondary">Kembali</a>
				<button class="btn btn-brand btn-square btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
@endsection


