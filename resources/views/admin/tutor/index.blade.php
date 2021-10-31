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
			autoWidth: false,
			scrollX: "100%",
			scrollCollapse:false,
			columnDefs: [
			{targets: [0,1,2,7], className: "text-center",},
			{targets: 0, width: "15px"},
			],
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', title: '#',orderable: false, searchable: false},
			{data: 'nip', name: 'nip', title: 'NIP'},
			{data: 'nama', name: 'nama', title: 'Nama'},
			{data: 'gender', name: 'gender', title: 'Jenis Kelamin'},
			{data: 'telepon', name: 'telepon', title: 'Telepon'},
			{data: 'email', name: 'email', title: 'Email'},
			{data: 'status', name: 'status', title: 'Status'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	});
</script>
@endsection

@section('button-title')
	<a class="btn btn-sm btn-primary ml-2 float-right" href="{{ action('TutorController@create') }}"   data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah Tutor</a>
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


