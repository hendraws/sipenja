@extends('layouts.app_master')
@section('title','Tutor')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>


@endsection

@section('button-title')
<a class="btn btn-sm btn-primary ml-2 float-right" href="{{ action('TutorPendidikanController@create') }}?data={{ $tutor->id }}"   data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah Pendidikan Tutor</a>
@endsection
@section('content')
<div class="card card-primary card-outline">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="col-4">NIP</div>
					<div class="col-8">: {{ $tutor->nip }}</div>
				</div>
			</div>		
			<div class="col-6">
				<div class="row">
					<div class="col-4">Jenis Kelamin</div>
					<div class="col-8">: {{ $tutor->gender }}</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-4">Nama</div>
					<div class="col-8">: {{ $tutor->nama }}</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-4">Tanggal Lahir</div>
					<div class="col-8">: {{ date('d-m-Y', strtotime($tutor->tanggal_lahir)) }}</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-4">Telepon</div>
					<div class="col-8">: {{ $tutor->telepon }}</div>
				</div>
			</div>			
			<div class="col-6">
				<div class="row">
					<div class="col-4">Email</div>
					<div class="col-8">: {{ $tutor->email }}</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row">
					<div class="col-2">Alamat</div>
					<div class="col-10">: {{ $tutor->alamat }}</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Bidang Studi</th>
						<th scope="col">Kode PT</th>
						<th scope="col">Perguruan Tinggi</th>
						<th scope="col">Akreditasi</th>
						<th scope="col">Jenjang</th>
						<th scope="col">Tahun Lulus</th>
						<th scope="col">Gelar</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					@forelse($tutor->Pendidikan as $val)
					<tr>
						<th scope="row">{{ $loop->index + 1 }}</th>
						<td>{{ $val->bidang_studi }}</td>
						<td>{{ $val->kode_pt }}</td>
						<td>{{ $val->nama_pt }}</td>
						<td>{{ $val->akreditasi }}</td>
						<td>{{ $val->nama_pendidikan_akhir }}</td>
						<td>{{ $val->tahun_lulus }}</td>
						<td>{{ $val->gelar }}</td>
						<td>
							<a href="{{ action('TutorPendidikanController@edit',$val) }}" class="btn btn-warning btn-xs">Edit</a>
							<a class="btn btn-xs btn-danger modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('TutorPendidikanController@delete',$val) }}"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="9" class="text-center">Tidak Ada Data Yang Ditampilkan</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection


