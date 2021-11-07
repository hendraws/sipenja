@extends('layouts.app_master')
@section('title','Tutor')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function () {

		function reloadData() {
			$('.table').DataTable().ajax.reload();
		}

		let table = $('.table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ url()->full() }}",
			pageLength: 25,
			columnDefs: [
			{targets: [0,1,2,7], className: "text-center",},
			{targets: 0, width: "15px"},
			],
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', title: '#',orderable: false, searchable: false},
			{data: 'nim', name: 'nim', title: 'NIM',},
			{data: 'nama', name: 'nama', title: 'Nama'},
			{data: 'jenis_kelamin', name: 'jenis_kelamin', title: 'Jenis Kelamin'},
			{data: 'ttl', name: 'ttl', title: 'Tempat, Tanggal Lahir'},
			{data: 'jurusan', name: 'jurusan', title: 'Jurusan'},
			{data: 'telepon', name: 'telepon', title: 'Telepon'},
			{data: 'email', name: 'email', title: 'Email'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).on('click','.hapus',function(e){
			e.preventDefault();
			var tag = $(this);
			var id = $(this).data('id');
			var url = '{{ action('MahasiswaController@destroy',':id') }}';
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
							if (data.code == '200'){
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
									);
								$('.table').DataTable().ajax.reload();
							}
						}
					});
					
				}
			})
		}) //tutup
	});
</script>
@endsection

@section('button-title')
<a class="btn btn-sm btn-primary ml-2 float-right" href="{{ action('MahasiswaController@create') }}"   data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah Mahasiswa</a>
@endsection
@section('content')
<div class="card card-primary card-outline">
	<div class="card-header">
	</div>
	<div class="card-body">
		<table id="data-table" class="table table-bordered table-striped">
		</table>
	</div>
</div>
@endsection


