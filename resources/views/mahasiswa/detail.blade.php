	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Detail Jadwal Mahasiswa</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-2">NIM</div>
			<div class="col-md-10">: {{ $mahasiswa->nim }}</div>
			<div class="col-md-2">Nama</div>
			<div class="col-md-10">: {{ optional($mahasiswa->getMahasiswa)->nama }}</div>	
			<div class="col-md-2">IDBILL</div>
			<div class="col-md-10">: {{ $mahasiswa->kode_order }}</div>	
			<div class="col-md-2">Lokasi</div>
			<div class="col-md-10">: {{ optional($mahasiswa->getLokasi)->lokasi }}</div>
		</div>
		<hr>
		<table class="table table-sm">
			<thead class="thead-dark">
				<tr>
					<th class="text-center" scope="col">Waktu</th>
					<th class="text-center" scope="col">Matakuliah</th>
				</tr>
			</thead>
			<tbody>
				@foreach($mahasiswa->getMahasiswaJadwalDetail as $key => $val)
				<td>{{ optional($val->getJadwalDetail)->waktu }}</td>
				<td>{{ optional(optional($val->getJadwalDetail)->getMatakuliah)->nama_mk }}</td>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</div>