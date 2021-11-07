@extends('layouts.app_master')
@section('title','Detail Mahasiswa')

@section('css')
<link href="{{ asset('vendors/bootstrap/datepicker.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('vendors/bootstrap/datepicker.js') }}"></script>
<script type="text/javascript">
	$('#mahasiswa').find(':input:not(:disabled)').prop('disabled',true);

	$(document).on('click','.hapus',function(e){
			e.preventDefault();
			var tag = $(this);
			var id = $(this).data('id');
			var url = '{{ action('MahasiswaController@destroy',':id') }}';
			url = url.replace(':id',id);
			console.log(url);
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Data akan terhapus tidak dapat dikembalikan lagi !",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value == true) {
					$.ajax({
						type:'DELETE',
						url:url,
						data:{
							"_token": "{{ csrf_token() }}",
						},
						success:function(data) {
							if (data.code == '200'){
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
									);

								window.location.href = '{{ action('MahasiswaController@index') }}';
							}
						}
					});
					
				}
			})
		}) //tutup
</script>
@endsection

@section('content')
<div class="card card-primary card-outline">

	<div class="card-body">
		<form action="{{ action('MahasiswaController@update', $mahasiswa) }}" method="POST" id="mahasiswa">
			@csrf
			@method('put')
			<div class="form-group row">
				<label for="nim" class="col-sm-2 col-form-label">NIM</label>
				<div class="col-md-4">
					<input  required type="number" id="nim" class="form-control hitung" name="nim" value="{{ $mahasiswa->nim }}" >
				</div>
				<label for="nama" class="col-sm-2 col-form-label">Nama</label>
				<div class="col-md-4">
					<input  required type="text" id="nama" class="form-control" name="nama" value="{{ $mahasiswa->nama }}">
				</div>
			</div>		
			<div class="form-group row">
				<label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
				<div class="col-md-4">
					<input  required type="text" id="tempat_lahir" class="form-control" name="tempat_lahir" autocomplete="off" value="{{ $mahasiswa->tempat_lahir }}">
				</div>
				<label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
				<div class="col-md-4">
					<input  required type="text" id="tanggal_lahir" class="form-control bg-light tanggal" name="tanggal_lahir" autocomplete="off" readonly value="{{ date('d-m-Y', strtotime($mahasiswa->tanggal_lahir)) }}">
				</div>
			</div>
			<div class="form-group row">
				<label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-md-4">
					<select class="form-control" name="jenis_kelamin" required>

						<option disabled selected>Pilih Jenis Kelamin</option>
						<option value="laki-laki" {{ $mahasiswa->jenis_kelamin == 'laki-laki' ? 'selected' : '' }} >Laki Laki</option>
						<option value="perempuan" {{ $mahasiswa->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
					</select>
				</div>	
				<label for="agama" class="col-sm-2 col-form-label">Agama</label>
				<div class="col-md-4">
					<select class="form-control" name="agama" required>
						<?php  $agama = ['Budha','Hindu','Islam','Katolik','Khonghucu','Kristen Protestan'] ?>
						<option disabled selected>Pilih Agama</option>
						@foreach($agama as $key => $val)
						<option value="{{ $val }}" {{ $mahasiswa->agama == $val ? 'selected' : '' }}>{{ $val }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-md-10">
					<textarea class="form-control" id="alamat" rows="3" name="alamat">{{ $mahasiswa->alamat }} </textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
				<div class="col-md-4">
					<select class="form-control" name="kewarganegaraan" required>
						<option disabled selected>Pilih Kewarganegaraan</option>
						@foreach($kewarganegaraan as $key => $val)
						<option value="{{ $val }}" {{ $mahasiswa->kewarganegaraan == $val ? 'selected' : '' }} >{{ $val }}</option>
						@endforeach
					</select>
				</div>
				<label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
				<div class="col-md-4">
					<input  required type="number" id="telepon" class="form-control" name="telepon" value="{{ $mahasiswa->telepon }}">
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-md-4">
					<input  required type="email" id="email" class="form-control" name="email" value="{{ $mahasiswa->email }}">
				</div>
				<label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
				<div class="col-md-4">
					<select class="form-control" name="jurusan_id" required>
						<option disabled selected>Pilih Jurusan</option>
						@foreach($jurusan as $key => $val)
						<option value="{{ $key }}" {{ $mahasiswa->jurusan_id == $key ? 'selected' : '' }}>{{ $val }}</option>
						@endforeach
					</select>
				</div>
			</div>			
			<div class="form-group row">
				<label for="semester" class="col-sm-2 col-form-label">Semester</label>
				<div class="col-md-4">
					<select class="form-control" name="semester" required>
						<option disabled selected>Pilih Semester</option>
						@for ($i = 1; $i <= 8; $i++)
						<option value="{{ $i }}" {{ $mahasiswa->semester == $i ? 'selected' : '' }} >{{ $i }}</option>
						@endfor
					</select>
				</div>	
				<label for="keterangan_layanan" class="col-sm-2 col-form-label">Keterangan Layanan</label>
				<div class="col-md-4">
					<select class="form-control" name="keterangan_layanan" required>
						<option disabled selected>Pilih Keterangan Layanan</option>
						@foreach($keterangan as $key => $val)
						<option value="{{ $key }}" {{ $mahasiswa->keterangan_layanan == $key ? 'selected' : '' }}>{{ $val }}</option>
						@endforeach
					</select>
				</div>
			</div>	
		</form>
		<div class="modal-footer">
			<a href="{{ action('MahasiswaController@index') }}" class="btn btn-secondary">Kembali</a>
			<a href="{{ action('MahasiswaController@edit', $mahasiswa) }}" class="btn btn-warning">Edit</a>
			<button class="btn btn-brand btn-square btn-danger hapus" type="button" data-id=" {{ $mahasiswa->id }}">Hapus</button>
		</div>
	</div>
</div>
@endsection


