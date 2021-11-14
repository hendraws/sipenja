<form action="{{ action('MahasiswaController@updateJadwal', $mahasiswa) }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit Jadwal Mahasiswa</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		@method('put')
		<div class="row">
			<div class="col-md-2">NIM</div>
			<div class="col-md-10">: {{ $mahasiswa->nim }}</div>
			<div class="col-md-2">Nama</div>
			<div class="col-md-10">: {{ optional($mahasiswa->getMahasiswa)->nama }}</div>
			<div class="col-md-2">IDBILL</div>
			<div class="col-md-10">: {{ $mahasiswa->kode_order }}</div>
			<div class="col-md-2">Lokasi</div>
			<div class="col-md-10">
				<select class="form-control" name="jadwal_tutorial_id" id="lokasi_edit" required>
					<option disabled selected value="">Pilih Lokasi</option>
					@foreach($lokasi as $key => $val)
					<option value="{{ $key }}" {{ $mahasiswa->jadwal_tutorial_id == $key ? 'selected' : '' }}>{{ $val }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<hr>
		<div id="paketMkEdit">

			<table class="table table-sm">
				<thead class="thead-dark">
					<tr>
						<th scope="col" width="40%" class="text-center">Pilih Jadwal Tutorial</th>
						<th scope="col" width="50%" class="text-center">Matakuliah Tawar</th>
						<th scope="col" width="30%" class="text-center">Pilih</th>
					</tr>
				</thead>
				<tbody>
					@foreach($paket->getTutorialDetail as $ket => $val)
					<tr>
						<td><input type="text"  class="form-control" readonly disabled  name="waktu[{{ $val->number }}]" value="{{ $val->waktu }}"></td>
						<td><input type="text"  class="form-control" readonly disabled  name="matakuliah[{{ $val->number }}]" value="{{ optional($val->getMatakuliah)->nama_mk }}"></td>
						<td class="align-middle text-center justify-content-center">
							<input type="checkbox" class="form-check m-auto" name="jadwal_tutorial_detail_id[{{ $val->number }}]" value="{{ $val->id }}" {{ empty($val->matakuliah_id) ? 'readonly disabled' : '' }} {{ in_array($val->number, $cek) ? 'checked' : '' }} {{ in_array($val->number, $cekAll) ? 'checked readonly disabled' : '' }} >
						</td>
					</tr>
					@endforeach

					@foreach($cek as $k => $v)
					<input type="hidden" name="jadwal_sekarang[{{ $k }}]" value="{{ $k }}">
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('change', '#lokasi_edit', function(){
			var url = "{{ url()->current() }}?jadwal_tutorial_id="+$(this).val();
			getDataTable(url, '#paketMkEdit');
		});
	});
</script>
