<table class="table table-borderless table-sm">
	<thead>
		<tr>
			<th scope="col" width="40%" class="text-center">Pilih Jadwal Tutorial</th>
			<th scope="col" width="50%" class="text-center">Matakuliah Tawar</th>
			<th scope="col" width="30%" class="text-center">Pilih</th>
		</tr>
	</thead>
	<tbody>
		@foreach($jadwal->getTutorialDetail as $ket => $val)

		<tr>
			<td><input type="text"  class="form-control" readonly disabled  name="waktu[{{ $val->number }}]" value="{{ $val->waktu }}"></td>
			<td><input type="text"  class="form-control" readonly disabled  name="matakuliah[{{ $val->number }}]" value="{{ optional($val->getMatakuliah)->nama_mk }}"></td>
			<td class="align-middle text-center justify-content-center"><input type="checkbox" class="form-check m-auto" name="jadwal_tutorial_detail_id[{{ $val->number }}]" value="{{ $val->id }}" {{ empty($val->matakuliah_id) ? 'readonly disabled' : '' }} {{ in_array($val->number, $cek) ? 'checked readonly disabled' : '' }}  ></td>
		</tr>
		@endforeach
	</tbody>
</table>
