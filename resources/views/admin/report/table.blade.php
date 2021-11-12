{{-- <div class="row">
	<div class="col-md-12">
		Masa : 2021 <br>
		Priode Ujian : 12 -16
	</div>
</div> --}}
<table class="table">
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
    @foreach ($report as $item)

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
    @endforeach
  </tbody>
</table>
