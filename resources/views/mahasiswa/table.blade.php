<div class="container">
	<table class="table table-sm">
		<thead class="thead-dark">
			<tr>
				<th class="text-center" scope="col">idbill</th>
				<th class="text-center" scope="col">NIM</th>
				<th class="text-center" scope="col">Nama Mahasiswa</th>
				<th class="text-center" scope="col">Status</th>
				<th class="text-center" scope="col" width="20%">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mahasiswaJadwal as $key => $val)
			<tr class="text-center">
				<td>{{ $val->kode_order }}</td>
				<td>{{ $val->nim }}</td>
				<td>{{ optional($val->getMahasiswa)->nama }}</td>
				<td>{{ $val->status }}</td>
				@if($val->status == 'aktif')
				<td>
					<a class="btn btn-xs btn-success modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('MahasiswaController@showJadwal',$val) }}"  data-toggle="tooltip" data-placement="top" title="Detail" style="width:32%">Detail</a>
					<a class="btn btn-xs btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('MahasiswaController@editJadwal',$val) }}"  data-mode="lg" data-toggle="tooltip" data-placement="top" title="Edit" style="width:32%">Edit</a>
					<button type="button" class="btn btn-danger btn-xs hapus" data-id="{{ $val->id }}" style="width:32%">Hapus</button>
				</td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
</div>