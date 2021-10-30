@extends('layouts.app_master')
@section('title','Pembuatan Jadwal Baru')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function () {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	});
</script>
@endsection

{{-- @section('button-title')
<a href="{{ action('JadwalController@create') }}" class="btn btn-primary btn-sm float-right">Jadwal Baru</a>
@endsection --}}
@section('content')
<div class="card card-primary card-outline">
	<div class="card-header">
	</div>
	<div class="card-body">
		<form action="{{ action('JadwalController@store') }}" method="POST">
			@csrf
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Nomor</label>
				<div class="col-md-10">
					<input  required type="text" id="nomor" class="form-control hitung" name="nomor">
				</div>
			</div>
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-md-10">
					<select class="form-control" name="tahun_ajaran" required>
						<option disabled selected>Pilih Tahun Ajaran</option>
						<option value="2021/2022" >2021/2022</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a href="{{ action('JadwalController@index') }}" class="btn btn-secondary">Kembali</a>
				<button class="btn btn-brand btn-square btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
@endsection


