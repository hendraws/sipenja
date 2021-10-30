<form action="{{ action('JadwalController@store') }}" method="POST">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Jadwal Baru</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
		<div class="form-group row">
			<label for="nomor" class="col-sm-4 col-form-label">Nomor</label>
			<div class="col-md-8">
				<input  required type="text" id="nomor" class="form-control hitung" name="nomor">
			</div>
		</div>
		<div class="form-group row">
			<label for="nomor" class="col-sm-4 col-form-label">Tahun Ajaran</label>
			<div class="col-md-8">
				<select class="form-control" name="tahun_ajaran" required>
					<option disabled selected>Pilih Tahun Ajaran</option>
					<option value="2021/2022" >2021/2022</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="nama" class="col-sm-4 col-form-label">Tanggal Mulai</label>
			<div class="col-sm-8">
				<input required type="text" class="form-control tanggal" value="" name="tanggal_mulai" autocomplete="off">
			</div>
		</div>
		<div class="form-group row">
			<label for="nama" class="col-sm-4 col-form-label">Tanggal Selesai</label>
			<div class="col-sm-8">
				<input required type="text" class="form-control tanggal" value="" name="tanggal_selesai" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
<link rel="stylesheet" href="{{ asset('plugins/jquery.datetimepicker/jquery.datetimepicker.css')}}">
<link href="{{ asset('vendors/bootstrap/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('plugins/jquery.datetimepicker/jquery.datetimepicker.full.js')}}"></script>
<script src="{{ asset('vendors/bootstrap/datepicker.js') }}"></script>
<script type="text/javascript">
	$(".tanggal").datepicker( {
		format: "yyyy-mm-dd",
	})
</script>