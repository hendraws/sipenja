@extends('layouts.app_master')
@section('title','Pembuatan Jadwal Baru')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function () {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	});
</script>
@endsection

{{-- @section('button-title')
<a href="{{ action('JadwalController@create') }}" class="btn btn-primary btn-sm float-right">Jadwal Baru</a>
@endsection --}}
@section('content')
<div class="card card-primary card-outline">
	<div class="card-header">
	</div>
	<div class="card-body">
		<form action="{{ action('JadwalController@storeJadwalTutorial') }}" method="POST">
			@csrf
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Jurusan</label>
				<div class="col-md-10">
					<select class="form-control" name="tahun_ajaran" required>
						<option disabled selected>Pilih Jurusan</option>
						<option value="1" >PAI</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Kelas</label>
				<div class="col-md-10">
					<select class="form-control" name="tahun_ajaran" required>
						<option disabled selected>Pilih Kelas</option>
						<option value="2021/2022">2021/2022</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Kelompok Tutorial</label>
				<div class="col-md-10">
					<select class="form-control" name="tahun_ajaran" required>
						<option disabled selected>Pilih Kelompok Tutorial</option>
						<option value="2021/2022" >2021/2022</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Link Kelas Tuweb</label>
				<div class="col-md-10">
					<input  required type="text" id="nomor" class="form-control hitung" name="nomor">
				</div>
			</div>
			<div class="form-group row">
				<label for="nomor" class="col-sm-2 col-form-label">Keterangan</label>
				<div class="col-md-10">
					<input  required type="text" id="nomor" class="form-control hitung" name="nomor">
				</div>
			</div>
			<table class="table table-bordered table-sm table-head-fixed">
				<thead>
					<tr>
						<th scope="col" width="20%">Hari/Jam</th>
						<th scope="col">MataKuliah</th>
{{-- 						<th scope="col" >Master Kelas</th> --}}
						<th scope="col" width="5%">Jumlah Peserta</th>
						<th scope="col">Tutor</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="text"  class="form-control" readonly  name="waktu[1]" value="Sabtu/10.00-12.00"></td>	
						<td>
							<select class="form-control" name="matakuliah[1]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
						{{-- <td>
							<select class="form-control" name="master_kelas[1]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[1]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[1]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[2]" value="Sabtu/13.00-15.00"></td>	
						<td>
							<select class="form-control" name="matakuliah[2]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
						{{-- <td>
							<select class="form-control" name="master_kelas[2]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[2]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[2]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[3]" value="Sabtu/15.10-17.10"></td>	
						<td>
							<select class="form-control" name="matakuliah[3]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
						{{-- <td>
							<select class="form-control" name="master_kelas[3]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[3]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[3]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[4]" value="Minggu/08.00-10.00"></td>	
						<td>
							<select class="form-control" name="matakuliah[4]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
						{{-- <td>
							<select class="form-control" name="master_kelas[4]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[4]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[4]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[5]" value="Minggu/10.00-12.00"></td>	
						<td>
							<select class="form-control" name="matakuliah[5]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
{{-- 						<td>
							<select class="form-control" name="master_kelas[5]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[5]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[5]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[6]" value="Minggu/13.00-15.00"></td>	
						<td>
							<select class="form-control" name="matakuliah[6]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
{{-- 						<td>
							<select class="form-control" name="master_kelas[6]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[6]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[6]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[7]" value="Minggu/15.10-17.10"></td>	
						<td>
							<select class="form-control" name="matakuliah[7]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
{{-- 						<td>
							<select class="form-control" name="master_kelas[7]" >
								<option readonly selected value="">Pilih Master Kelas</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	 --}}
						<td>
							<input   type="text"  class="form-control " name="jumlah_peserta[7]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control" name="tutor[7]" >
								<option readonly selected value="">Pilih Tutor</option>
								<option value="2021/2022" >2021/2022</option>
							</select>
						</td>	
					</tr>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="{{ action('JadwalController@index') }}" class="btn btn-secondary">Kembali</a>
				<button class="btn btn-brand btn-square btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
@endsection


