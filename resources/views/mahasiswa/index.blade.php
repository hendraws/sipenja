<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Sistem Informasi Pengelola Jadwal Tutorial </title>

	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
	<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
	<link rel="stylesheet" href="{{ asset('vendors/toastr/toastr.min.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style type="text/css">

		input[type=checkbox]
		{
			-ms-transform: scale(2); /* IE */
			-moz-transform: scale(2); /* FF */
			-webkit-transform: scale(2); /* Safari and Chrome */
			-o-transform: scale(2); /* Opera */
			padding: 10px;
		}
	</style>
	@yield('css')
	@toastr_css
	<!-- REQUIRED SCRIPTS -->
	<!-- jQuery -->
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
	<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('vendors/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/print-this.js')}}"></script>
	<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.select').select2({
				placeholder: 'MataKuliah',
				theme: 'bootstrap4',
				ajax: {
					url: "{{ url()->full() }}",
					data: function (params) {
						var query = {
							lokasi_id: $('#lokasi').val(),
							jadwal_id: $('#jadwal').val(),
							jurusan_id: $('#jurusan').val(),
							number: $(this).data('number'),
						}
						return query;
					},
					dataType: 'json',
					delay: 250,

					processResults: function (data) {
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

			$(document).on('click','.hapus',function(e){
				e.preventDefault();
				var tag = $(this);
				var id = $(this).data('id');
				var url = '{{ action('MahasiswaController@destroyJadwal',':id') }}';
				url = url.replace(':id',id);
				console.log(url);
				Swal.fire({
					title: 'Apakah Anda Yakin ?',
					text: "Data akan dinonaktifkan dan data tidak dapat dikembalikan lagi !",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.value == true) {
						$.ajax({
							type:'post',
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
									$(location).prop('href', '/')
								}
							}
						});

					}
				})
			});

			$(document).on('change', '#lokasi', function(){
				var url = "{{ url()->current() }}?jadwal_tutorial_id="+$(this).val();
				getDataTable(url, '#paketMk');
			});

		});
	</script>
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
			<div class="container">
				<a href="/" class="navbar-brand">
					<img src="{{ asset('dist/img/logo-ut.png') }}" alt="AdminLTE Logo" class="brand-image " style="opacity: .8; height: 40px">
				</a>

				<!-- Right navbar links -->
				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

					<!-- Notifications Dropdown Menu -->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-link" data-toggle="dropdown" href="{{ route('logout') }}"  onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</li>
				</ul>
			</div>
		</nav>
		<!-- /.navbar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" >
			<!-- Content Header (Page header) -->
			<div class="content-header text-center">
				<h3>FORMULIR REGISTRASI MATAKULIAH TUTORIAL / TTM</h3>
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="card card-primary card-outline">
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<h5>Data Mahasiswa</h5>
											<div class="form-group row">
												<label for="tempat_lahir" class="col-sm-4 col-form-label">NIM</label>
												<div class="col-md-6">
													<input class="form-control form-control-sm" disabled="" readonly="" value="{{ $mahasiswa->nim }}">
												</div>
												<label for="tempat_lahir" class="col-sm-4 col-form-label">Nama</label>
												<div class="col-md-6">
													<input class="form-control form-control-sm" disabled="" readonly="" value="{{ ucwords($mahasiswa->nama) }}">
												</div>
												<label for="tempat_lahir" class="col-sm-4 col-form-label">Program Studi</label>
												<div class="col-md-6">
													<input class="form-control form-control-sm" disabled="" readonly="" value="{{ ucwords(optional($mahasiswa->getJurusan)->name) }}">
												</div>
											</div>
										</div>
										<div class="col-6">
											<h5>Informasi</h5>
											<div class="form-group row">
												<div class="col-md-12 pl-4">
													<textarea class="form-control" id="exampleFormControlTextarea1" rows="4" readonly="" disabled=""></textarea>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<form action="{{ action('MahasiswaController@storeJadwalMhs') }}" method="POST">
										@csrf
										<div class="row justify-content-center form-group">
											<label for="tempat_lahir" class="col-sm-2 col-form-label">Pilih Lokasi Tutorial</label>
											<div class="col-md-6">
												<select class="form-control" name="jadwal_tutorial_id" id="lokasi" required>
													<option disabled selected value="">Pilih Lokasi</option>
													@foreach($lokasi as $key => $val)
													<option value="{{ $key }}">{{ $val }}</option>
													@endforeach
												</select>
											</div>
											<input type="hidden" name="jadwal_id" id="jadwal" value="{{ $jadwal->id }}">
											<input type="hidden" name="jurusan_id" id="jurusan" value="{{ $mahasiswa->jurusan_id }}">
										</div>
										<div class="row justify-content-center ">

											<div class="col-md-10 border" id="paketMk">
												<table class="table table-borderless table-sm">
													<thead>
														<tr>
															<th scope="col" width="40%" class="text-center">Pilih Jadwal Tutorial</th>
															<th scope="col" width="50%" class="text-center">Matakuliah Tawar</th>
															<th scope="col" width="30%" class="text-center">Pilih</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input type="text"  class="form-control" readonly  name="waktu[1]" value="Sabtu/10.00-12.00"></td>
															<td><input type="text"  class="form-control" readonly  value=""></td>
															<td class="align-middle text-center justify-content-center"><input type="checkbox" class="form-check m-auto"></td>
														</tr>
														<tr>
															<td><input   type="text"  class="form-control" readonly  name="waktu[2]" value="Sabtu/13.00-15.00"></td>
															<td>
																<input type="text"  class="form-control" readonly  value="">
															</td>
															<td class="align-middle text-center"><input type="checkbox" class="form-check m-auto"  ></td>
														</tr>
														<tr>
															<td><input   type="text"  class="form-control" readonly  name="waktu[3]" value="Sabtu/15.10-17.10"></td>
															<td><input type="text"  class="form-control" readonly  value=""></td>
															<td class="align-middle text-center"><input type="checkbox" class="form-check m-auto"  ></td>
														</tr>
														<tr>
															<td><input   type="text"  class="form-control" readonly  name="waktu[4]" value="Minggu/08.00-10.00"></td>
															<td>
																<input type="text"  class="form-control" readonly  value="">
															</td>
															<td class="align-middle text-center"><input type="checkbox" class="form-check m-auto"  ></td>
														</tr>
														<tr>
															<td><input   type="text"  class="form-control" readonly  name="waktu[5]" value="Minggu/10.00-12.00"></td>
															<td>
																<input type="text"  class="form-control" readonly  value="">
															</td>
															<td class="align-middle text-center"><input type="checkbox" class="form-check m-auto"  ></td>
														</tr>
														<tr>
															<td><input   type="text"  class="form-control" readonly  name="waktu[6]" value="Minggu/13.00-15.00"></td>
															<td>
																<input type="text"  class="form-control" readonly  value="">
															</td>
															<td class="align-middle text-center"><input type="checkbox" class="form-check m-auto"  ></td>
														</tr>
														<tr>
															<td><input   type="text"  class="form-control" readonly  name="waktu[7]" value="Minggu/15.10-17.10"></td>
															<td>
																<input type="text"  class="form-control" readonly  value="">
															</td>
															<td class="align-middle text-center"><input type="checkbox" class="form-check m-auto"  ></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-md-11 text-center">
												<div class="form-check form-check-inline">
													<label class="form-check-label text-bold" for="inlineCheckbox1 mr-2">Saya setuju untuk registrasi matakuliah tutorial </label>
													<input class="form-check-input m-2" type="checkbox" id="inlineCheckbox1 " value="y" required="">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-brand btn-square btn-primary">Simpan</button>
										</div>
									</form>
								</div>
								<div class="card-footer">
									@includeIf('mahasiswa.table')
								</div>
							</div><!-- /.card -->
						</div>
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
			<div class="p-3">
				<h5>Title</h5>
				<p>Sidebar content</p>
			</div>
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				Sistem Informasi Pengelola Jadwal Tutorial
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; {{ date('Y') }}</strong>
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<div class="modal fade" id="ModalForm" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-content-form"></div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ModalFormLg" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-content-form"></div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ModalFormXl" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-content-form"></div>
			</div>
		</div>
	</div>
	@yield('js')
	@toastr_js
	@toastr_render
	<script>
		@if(count($errors) > 0)
		@foreach($errors->all() as $error)
		toastr.error("{{ $error }}");
		@endforeach
		@endif
	</script>
</body>
</html>
