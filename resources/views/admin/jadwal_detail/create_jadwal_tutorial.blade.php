@extends('layouts.app_master')
@section('title','Pembuatan Jadwal Baru')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function () {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('.select').select2({
			theme: 'bootstrap4',
			allowClear: true,
			placeholder: ""
		});

		$('.tutor').on("select2:select", function(e) {
			var tutor_id = $(this).val();
			var number = $(this).data('jam');
			$.ajax({
				url: "{{ url()->current() }}",
				type: "GET",
				data: {
					cek:'true',
					number:number,
					tutor_id:tutor_id,
				},
				success: function (response) {
					console.log(response.code);
					if(response.code == 200){
						Swal.fire({title: 'Jadwal Tutor Sudah Ada, Silahkan Pilih Tutor Lain !', icon: 'warning', toast: true, position: 'top-end', showConfirmButton: false, timer: 5000, timerProgressBar: true,});	

						$('#tutor-'+response.number).val('').trigger("change");	
					}
		           // You will get response from your PHP page (what you echo or print)
		       },
		       error: function(jqXHR, textStatus, errorThrown) {
		       	console.log(textStatus, errorThrown);
		       }
		   });
			// Swal.fire({title: 'Tidak Bisa ', icon: 'warning', toast: true, position: 'top-end', showConfirmButton: false, timer: 5000, timerProgressBar: true,});

		}) 


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
		<form action="{{ action('JadwalTutorialDetailController@store') }}" method="POST">
			@csrf
			<div class="form-group row">
				<label for="jurusan_id" class="col-sm-2 col-form-label">Jurusan</label>
				<div class="col-md-10">
					<select class="form-control select" name="jurusan_id" required id="jurusan_id">
						<option disabled selected>Pilih Jurusan</option>
						@foreach($jurusan as $val)
						<option value="{{ $val->id }}" >{{ $val->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
				<div class="col-md-10">
					<select class="form-control select" name="kelas_id" required>
						<option disabled selected>Pilih Kelas</option>
						@foreach($kelas as $val)
						<option value="{{ $val->id }}">{{ $val->nama }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="kelompok_id" class="col-sm-2 col-form-label">Kelompok Tutorial</label>
				<div class="col-md-10">
					<select class="form-control select" name="kelompok_id" required>
						<option disabled selected>Pilih Kelompok Tutorial</option>
						@foreach($lokasi as $val)
						<option value="{{ $val->id }}" >{{ $val->lokasi }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="link" class="col-sm-2 col-form-label">Link Kelas Tuweb</label>
				<div class="col-md-10">
					<input  required type="text" id="link" class="form-control" name="link">
				</div>
			</div>
			<div class="form-group row">
				<label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
				<div class="col-md-10">
					<input  required type="text" id="keterangan" class="form-control hitung" name="keterangan">
				</div>
			</div>
			<table class="table table-bordered table-sm table-head-fixed">
				<thead>
					<tr>
						<th scope="col" width="20%">Hari/Jam</th>
						<th scope="col" width="30%">MataKuliah</th>
						<th scope="col" width="8%">Jumlah Peserta</th>
						<th scope="col">Tutor</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="text"  class="form-control" readonly  name="waktu[1]" value="Sabtu/10.00-12.00"></td>	
						<td>
							<select class="form-control select" name="matakuliah[1]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control " name="jumlah_peserta[1]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[1]" data-jam="1" id="tutor-1">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[2]" value="Sabtu/13.00-15.00"></td>	
						<td>
							<select class="form-control select" name="matakuliah[2]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control " name="jumlah_peserta[2]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[2]" data-jam="2" id="tutor-2">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[3]" value="Sabtu/15.10-17.10"></td>	
						<td>
							<select class="form-control select" name="matakuliah[3]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control" name="jumlah_peserta[3]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[3]" data-jam="3" id="tutor-3">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[4]" value="Minggu/08.00-10.00"></td>	
						<td>
							<select class="form-control select" name="matakuliah[4]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control " name="jumlah_peserta[4]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[4]" data-jam="4" id="tutor-4">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[5]" value="Minggu/10.00-12.00"></td>	
						<td>
							<select class="form-control select" name="matakuliah[5]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control " name="jumlah_peserta[5]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[5]" data-jam="5" id="tutor-5">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[6]" value="Minggu/13.00-15.00"></td>	
						<td>
							<select class="form-control select" name="matakuliah[6]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control " name="jumlah_peserta[6]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[6]" data-jam="6" id="tutor-6">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
					<tr>
						<td><input   type="text"  class="form-control" readonly  name="waktu[7]" value="Minggu/15.10-17.10"></td>	
						<td>
							<select class="form-control select" name="matakuliah[7]" >
								<option readonly selected value="">Pilih MataKuliah</option>
								@foreach($matakuliah as $val)
								<option value="{{ $val->id }}" >{{ $val->nama_mk }}</option>
								@endforeach
							</select>
						</td>	
						<td>
							<input   type="number"  class="form-control " name="jumlah_peserta[7]" placeholder="Jumlah Peserta">
						</td>	
						<td>
							<select class="form-control select tutor" name="tutor[7]" data-jam="7" id="tutor-7">
								<option readonly selected value="">Pilih Tutor</option>
								@foreach($tutor as $val)
								<option value="{{ $val->id }}" >
									{{ $val->nip }} - {{ $val->nama }}
									@foreach($val->Pendidikan as $v)
									{{ $loop->index == 0 ? ' | Mk : ' : ' - ' }} {{ $v->bidang_studi}} 
									@endforeach
								</option>
								@endforeach
							</select>
						</td>	
					</tr>
				</tbody>
			</table>
			<div class="modal-footer">
				<input type="hidden" name="jadwal_id" value="{{ $jadwalId }}">
				<a href="{{ action('JadwalController@index') }}" class="btn btn-secondary">Kembali</a>
				<button class="btn btn-brand btn-square btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>
@endsection


