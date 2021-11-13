<!DOCTYPE html>
<html>
<head>
	<title>export</title>
	<style type="text/css">
	</style>
</head>
<body>
	<table>
        <tr>
            <td>Lampiran Surat Direktur UT Pangkalpinang</td>
        </tr>
        <tr>
            <td>Nomor : {{ $report->first()->nomor }}</td>
        </tr>
        <tr>
            <td>Tentang</td>
        </tr>
        <tr>
            <td></td>
        </tr>
		<tr>
			<td colspan="17"><h5>RENCANA TUTORIAL WEBINAR ATAS PERMINTAAN MAHASISWA (TUWEB ATPEM), WAJIB DAN PRAKTIK/PRAKTIKUM
            </h5></td>
		</tr>
		<tr>
			<td colspan="17"><h5>UT PANGKALPINANG MASA REGISTRASI {{  $report->first()->tahun_ajaran }}
            </h5></td>
		</tr>
		<tr>
			<td colspan="17"><h5>Tanggal pelaksaan : {{ date('d M Y', strtotime($report->first()->tanggal_mulai)) }} - {{ date('d M y', strtotime($report->first()->tanggal_selesai)) }}
            </h5></td>
		</tr>
		<tr>

		</tr>
		<tr></tr>
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

	</table>
</body>
</html>
