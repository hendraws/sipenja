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
		<form action="{{ action('TutorPendidikanController@update', $tutor_pendidikan) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group row">
				<label for="nip" class="col-sm-3 col-form-label">NIP</label>
				<div class="col-md-9">
					<input  required type="number" id="nip" class="form-control hitung" name="nip" readonly disabled value="{{ $tutor->nip }}">
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
					<input  required type="text" id="bidang_studi" class="form-control" name="bidang_studi" autocomplete="off" value="{{ $tutor_pendidikan->bidang_studi }}">
				</div>
			</div>				
			<div class="form-group row">
				<label for="kode_pt" class="col-sm-3 col-form-label">Kode Pergururan Tinggi</label>
				<div class="col-md-9">
					<input  required type="text" id="kode_pt" class="form-control" name="kode_pt" autocomplete="off" value="{{ $tutor_pendidikan->kode_pt }}">
				</div>
			</div>	
			<div class="form-group row">
				<label for="nama_pt" class="col-sm-3 col-form-label">Pergururan Tinggi</label>
				<div class="col-md-9">
					<input  required type="text" id="nama_pt" class="form-control" name="nama_pt" autocomplete="off" value="{{ $tutor_pendidikan->nama_pt }}">
				</div>
			</div>	
			<div class="form-group row">
				<label for="akreditasi" class="col-sm-3 col-form-label">Akreditasi</label>
				<div class="col-md-9">
					<select class="form-control" name="akreditasi" required>
						<option disabled selected>Pilih Akreditasi</option>
						<?php 
						$akreditasi = ['A'=>'A','B'=>'B','C'=>'C', ];
						?>
						@foreach($akreditasi as $k => $v)
						<option value="{{ $k }}" {{ $tutor_pendidikan->akreditasi == $k ? 'selected' : '' }}>{{ $v }}</option>
						@endforeach
					</select>
				</div>
			</div>					
			<div class="form-group row">
				<label for="nama_pendidikan_akhir" class="col-sm-3 col-form-label">Jenjang Pendidikan</label>
				<div class="col-md-9">
					<select class="form-control" name="nama_pendidikan_akhir" required>
						<option disabled selected>Pilih Jenjang Pendidikan</option>
						<?php 
						$jenjang = ['S1','S2','S3' ];
						?>
						@foreach($jenjang as $k => $v)
						<option value="{{ $v }}" {{ $tutor_pendidikan->nama_pendidikan_akhir == $v ? 'selected' : '' }}>{{ $v }}</option>
						@endforeach

					</select>
				</div>
			</div>			
			<div class="form-group row">
				<label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
				<div class="col-md-9">
					<input  required type="number" id="tahun_lulus" class="form-control" name="tahun_lulus" autocomplete="off" value="{{ $tutor_pendidikan->tahun_lulus }}">
				</div>
			</div>	
			<div class="form-group row">
				<label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
				<div class="col-md-9">
					<input  required type="text" id="gelar" class="form-control" name="gelar" autocomplete="off" value="{{ $tutor_pendidikan->gelar }}">
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


