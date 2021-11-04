@extends('layouts.app_master')
@section('title','Detail Jadwal')
@section('body', 'sidebar-collapse')
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

		$(document).on('click','.hapus',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var url = '{{ action('JadwalTutorialDetailController@destroy',':id') }}';
			url = url.replace(':id',id);
			console.log(url);
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Data akan terhapus tidak dapat dikembalikan lagi !",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value == true) {
					$.ajax({
						type:'DELETE',
						url:url,
						data:{
							"_token": "{{ csrf_token() }}",
						},
						success:function(data) {
							console.log(data, id);
							if (data.code == '200'){
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
									);
								$("."+id+"").remove(); 
							}
						}
					});
					
				}
			})
		})
	});
</script>
@endsection

{{-- @section('button-title')
<a href="{{ action('JadwalController@create') }}" class="btn btn-primary btn-sm float-right">Jadwal Baru</a>
@endsection --}}
@section('content')
<div class="card card-primary card-outline">
	<div class="card-header">
		<div class="row">
			<div class="col-3">Nomor : {{ $jadwal->nomor }}</div>
			<div class="col-3">Tahun ajaran : {{ $jadwal->tahun_ajaran }}</div>
			<div class="col-3">Tanggal Mulai : {{ date("d M Y", strtotime($jadwal->tanggal_mulai)) }}</div>
			<div class="col-3">Tanggal Selesai : {{  date("d M Y", strtotime($jadwal->tanggal_selesai)) }}</div>
		</div>	
	</div>
</div>
<div class="card card-success card-outline">
	<div class="card-body">
		<div class="row mb-2">
			<div class="col-6"><h5>Pengaturan Jadwal Tutorial</h5></div>
			<div class="col-6"><a href="{{ action('JadwalTutorialDetailController@create', $jadwal->id) }}" class="btn btn-primary btn-sm float-right">Tambah Jadwal Tutorial</a></div>
		</div>
		<div class="table-responsive" style="height: 350px; font-size: 13px;">
			<table class="table table-bordered table-sm table-head-fixed">
				<thead>
					<tr>
						<th scope="col">Hari/Jam</th>
						<th scope="col">Kode MK</th>
						<th scope="col">Nama MK</th>
						<th scope="col">Kelas</th>
						<th scope="col">Jumlah Peserta</th>
						<th scope="col">ID Tutor</th>
						<th scope="col">Nama Tutor</th>
						<th scope="col">No.Hp</th>
						<th scope="col">Jurusan/Kelas</th>
						<th scope="col">Kelompok Tutorial</th>
						<th scope="col">Link Kelas Tuweb</th>
						<th scope="col">Keterangan</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($jadwal->getJadwalTutorial as $key => $value)

					@foreach($value->getTutorialDetail as $k => $v)
					@if($loop->index == 0)
					<tr class="{{ $value->id }}">
						<td>{{ $v->waktu }}</td>
						<td>{{ optional($v->getMatakuliah)->kode_mk }}</td>
						<td>{{ optional($v->getMatakuliah)->nama_mk }}</td>
						<td>{{ !empty(optional($v->getMatakuliah)->kode_mk) ? optional($v->getMatakuliah)->kode_mk .'.'.$value->kelas_id : '' }}</td>
						<td>{{ $v->jumlah_peserta }}</td>
						<td>{{ $v->tutor_id }}</td>
						<td>{{ optional($v->getTutor)->nama }}</td>
						<td>{{ optional($v->getTutor)->telepon }}</td>
						<td rowspan="7" class="align-middle">{{ optional($value->getJurusan)->name }} / {{ optional($value->getKelas)->nama }}</td>
						<td rowspan="7" class="align-middle">{{ optional($value->getKelompok)->lokasi }}</td>
						<td rowspan="7" class="align-middle"><a href="{{ $value->link }}">{{ $value->link }}</a></td>
						<td rowspan="7" class="align-middle">{{ $value->keterangan }}</td>
						<td rowspan="7" class="align-middle">
							<a href="{{ action('JadwalTutorialDetailController@edit', [$jadwal->id, $value->id]) }}" class="btn btn-warning btn-xs mb-1">Edit</a>
							<button type="button" class="btn btn-danger btn-xs hapus" data-id="{{ $value->id }}">Hapus</button>
						</td>
					</tr>
					@else
					<tr class="{{ $value->id }}">
						<td>{{ $v->waktu }}</td>
						<td>{{ optional($v->getMatakuliah)->kode_mk }}</td>
						<td>{{ optional($v->getMatakuliah)->nama_mk }}</td>
						<td>{{ !empty(optional($v->getMatakuliah)->kode_mk) ? optional($v->getMatakuliah)->kode_mk .'.'.$value->kelas_id : '' }}</td>
						<td>{{ $v->jumlah_peserta }}</td>
						<td>{{ $v->tutor_id }}</td>
						<td>{{ optional($v->getTutor)->nama }}</td>
						<td>{{ optional($v->getTutor)->telepon }}</td>
					</tr>
					@endif
					
					@endforeach
					<tr class="{{ $value->id }}"><td colspan="13" class="bg-lightblue"></td></tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection


