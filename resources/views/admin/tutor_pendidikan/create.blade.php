@extends('layouts.app_master')
@section('title','Tambah Pendidikan Tutor')
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
		<form action="{{ action('TutorPendidikanController@store') }}" method="POST">
			@csrf
			<div class="form-group row">
				<label for="nip" class="col-sm-3 col-form-label">NIP</label>
				<div class="col-md-9">
					<input  required type="number" id="nip" class="form-control hitung" name="nip" readonly disabled value="{{ $tutor->nip }}">
					<input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
				</div>
			</div>
			<div class="form-group row">
				<label for="nama" class="col-sm-3 col-form-label">Nama</label>
				<div class="col-md-9">
					<input  required type="text" id="nama" class="form-control" name="nama" disabled readonly value="{{ $tutor->nama }}">
				</div>
			</div>			
			<div class="form-group row">
				<label for="bidang_studi" class="col-sm-3 col-form-label">Bidang Studi</label>
				<div class="col-md-9">
					<input  required type="text" id="bidang_studi" class="form-control" name="bidang_studi" autocomplete="off">
				</div>
			</div>				
			<div class="form-group row">
				<label for="kode_pt" class="col-sm-3 col-form-label">Kode Pergururan Tinggi</label>
				<div class="col-md-9">
					<input  required type="text" id="kode_pt" class="form-control" name="kode_pt" autocomplete="off">
				</div>
			</div>	
			<div class="form-group row">
				<label for="nama_pt" class="col-sm-3 col-form-label">Pergururan Tinggi</label>
				<div class="col-md-9">
					<input  required type="text" id="nama_pt" class="form-control" name="nama_pt" autocomplete="off">
				</div>
			</div>	
			<div class="form-group row">
				<label for="akreditasi" class="col-sm-3 col-form-label">Akreditasi</label>
				<div class="col-md-9">
					<select class="form-control" name="akreditasi" required>
						<option disabled selected>Pilih Akreditasi</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					</select>
				</div>
			</div>					
			<div class="form-group row">
				<label for="nama_pendidikan_akhir" class="col-sm-3 col-form-label">Jenjang Pendidikan</label>
				<div class="col-md-9">
					<select class="form-control" name="nama_pendidikan_akhir" required>
						<option disabled selected>Pilih Jenjang Pendidikan</option>
						<option value="S1">S1</option>
						<option value="S2">S2</option>
						<option value="S3">S3</option>
					</select>
				</div>
			</div>			
			<div class="form-group row">
				<label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
				<div class="col-md-9">
					<input  required type="number" id="tahun_lulus" class="form-control" name="tahun_lulus" autocomplete="off">
				</div>
			</div>	
			<div class="form-group row">
				<label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
				<div class="col-md-9">
					<input  required type="text" id="gelar" class="form-control" name="gelar" autocomplete="off">
				</div>
			</div>	
			<div class="modal-footer">
				<a href="{{ action('TutorController@show', $tutor->id) }}" class="btn btn-secondary">Kembali</a>
				<button class="btn btn-brand btn-square btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
@endsection


