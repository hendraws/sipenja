@extends('layouts.app_master')
@section('title','Detail Jadwal')
@section('body', 'sidebar-collapse')
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
		<div class="row">
			<div class="col-3">Nomor : {{ $jadwal->nomor }}</div>
			<div class="col-3">Tahun ajaran : {{ $jadwal->tahun_ajaran }}</div>
			<div class="col-3">Tanggal Mulai : {{ date("d M Y", strtotime($jadwal->tanggal_mulai)) }}</div>
			<div class="col-3">Tanggal Selesai : {{  date("d M Y", strtotime($jadwal->tanggal_selesai)) }}</div>
		</div>	
	</div>
</div>
<div class="card card-success card-outline">
	<div class="card-body">
		<div class="row mb-2">
			<div class="col-6"><h5>Pengaturan Jadwal Tutorial</h5></div>
			<div class="col-6"><a href="{{ action('JadwalController@createJadwalTutorial', $jadwal->id) }}" class="btn btn-primary btn-sm float-right">Tambah Jadwal Tutorial</a></div>
		</div>
		<div class="table-responsive" style="height: 300px; font-size: 13px;">
			<table class="table table-bordered table-sm table-head-fixed">
				<thead>
					<tr>
						<th scope="col">Hari/Jam</th>
						<th scope="col">Kode MK</th>
						<th scope="col">Nama MK</th>
						<th scope="col">Kelas</th>
						<th scope="col">Kelas</th>
						<th scope="col">Jumlah Peserta</th>
						<th scope="col">ID Tutor</th>
						<th scope="col">Nama Tutor</th>
						<th scope="col">No.Hp</th>
						<th scope="col">Jurusan/Kelas</th>
						<th scope="col">Kelompok Tutorial</th>
						<th scope="col">Link Kelas Tuweb</th>
						<th scope="col">Keterangan Tambahan</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr>
					<tr><td colspan="13" class="bg-lightblue"></td></tr>
					<tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr><tr>
						<td>Sabtu/13.00-15.00</td>
						<td>MKDU4109</td>
						<td>Ilmu Sosial & Budaya Dasar</td>
						<td>MKDU4109.150001</td>
						<td>20</td>
						<td>15002042</td>
						<td>Pebri Yanasari, S.Pd.I., M.A</td>
						<td>0813 74313990</td>
						<td>Adm.Negara Smt.01.A</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>SMPN 3 Pk.Pinang</td>
						<td>ttps://sl.ut.ac.id/Kelas-AA</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection


