{{-- <div class="row">
	<div class="col-md-12">
		Masa : 2021 <br>
		Priode Ujian : 12 -16
	</div>
</div> --}}
<div class="table-responsive">

	<table class="table" style="font-size: 13px;">
		<thead class="thead-dark">
			<tr class="text-center">
				<th scope="col">Masa</th>
				<th scope="col">Kode MTK</th>
				<th scope="col">Nama MTK</th>
				<th scope="col">NIM</th>
				<th scope="col">NAMA</th>
				<th scope="col">Id Tutorial</th>
				<th scope="col">Id Tutor</th>
				<th scope="col">Nama Tutor</th>
				<th scope="col">Kelas</th>
				<th scope="col">Tangal Mulai</th>
				<th scope="col">Tangal Selesai</th>
				<th scope="col">Id Jadwal</th>
				<th scope="col">Prediksi</th>
				<th scope="col">idstatus</th>
				<th scope="col">idLokasi</th>
				<th scope="col">link</th>
				<th scope="col">Keterngan layanan</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($report as $item)

			<tr>
				<td>{{ $item->tahun_ajaran }}</td>
				<td>{{ $item->kode_mk }}</td>
				<td>{{ $item->nama_mk }}</td>
				<td>{{ $item->nim_mahasiswa  }}</td>
				<td>{{ $item->nama_mahasiswa  }}</td>
				<td>{{ $item->id_tutorial }}</td>
				<td>{{ $item->id_tutor }}</td>
				<td>{{ $item->nama_tutor }}</td>
				<td>{{ $item->nama_kelas }}</td>
				<td>{{ $item->tanggal_mulai }}</td>
				<td>{{ $item->tanggal_selesai }}</td>
				<td>{{ $item->id_jadwal }}</td>
				<td></td>
				<td>{{ $item->status_jadwal }}</td>
				<td>{{ $item->lokasi }}</td>
				<td><a href="https://{{ $item->link }}">{{ $item->link }}</a></td>
				<td>{{ $item->keterangan }}</td>
			</tr>
			@empty
			<tr>
				<td class="text-center text-bold bg-secondary" colspan="17"><h5>TIDAK ADA DATA</h5></td>
			</tr>
			@endforelse
		</tbody>
	</table>

</div>
<div class="card-body p-2 border-top">
	<div class="row justify-content-between align-items-center">
		<div class="col-auto ml-auto">
			{!! $report->appends(request()->except('_token'))->links() !!}
		</div>
	</div>
</div>