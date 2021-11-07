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
				<select class="form-control" name="lokasi" id="lokasi_edit" required>
					<option disabled selected value="">Pilih Lokasi</option>
					@foreach($lokasi as $key => $val)
					<option value="{{ $key }}" {{ $mahasiswa->lokasi_id == $key ? 'selected' : '' }}>{{ $val }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<hr>
		<table class="table table-sm">
			<thead class="thead-dark">
				<tr>
					<th class="text-center" scope="col">Waktu</th>
					<th class="text-center" scope="col" width="70%">Matakuliah</th>
				</tr>
			</thead>
			<tbody>
				@foreach($mahasiswa->getMahasiswaJadwalDetail as $key => $val)
				<tr>
					
				<td>{{ optional($val->getJadwalDetail)->waktu }}</td>
				<td>
					<select class="form-control select" name="jadwal_tutorial_detail_id[{{ $val->id }}]" data-number="{{ $val->number }}" required>
						<option disabled selected value="">Pilih MataKuliah</option>
						<option value="{{ optional($val->getJadwalDetail)->id }}" selected>{{optional(optional($val->getJadwalDetail)->getMatakuliah)->kode_mk .' - '. optional(optional($val->getJadwalDetail)->getMatakuliah)->nama_mk ." || ". optional(optional($val->getJadwalDetail)->getTutor)->nama }}</option>
					</select>
				</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function () {
		$('.select').select2({
			placeholder: 'MataKuliah',
			theme: 'bootstrap4',
			ajax: {
				url: "{{ url()->full() }}",
				data: function (params) {
					var query = {
						lokasi_id: $('#lokasi_edit').val(),
						jadwal_id: $('#jadwal').val(),
						jurusan_id: $('#jurusan').val(),
						number: $(this).data('number'),
					}
					return query;
				},
				dataType: 'json',
				delay: 250,

				processResults: function (data) {
					console.log(data);
					return {
						results:  $.map(data, function (item) {
							return {
								text: item.get_matakuliah.kode_mk + ' - ' + item.get_matakuliah.nama_mk + ' || '+item.get_tutor.nama ,
								id: item.id
							}
						})
					};
				},
				cache: true
			}
		});
	});
</script>