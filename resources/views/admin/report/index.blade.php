@extends('layouts.app_master')
@section('title', 'Report')
@section('body', 'sidebar-collapse')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.select').select2({
                theme: "bootstrap4"
            }).val('').trigger('change');

            var url = "{{ url()->full() }}";
            getDataTable(url, "#reportTable");

            $(document).on('click', '#btnFilters', function() {
                var masa = $('#masa').val();
                var matakuliah = $('#matakuliah').val();
                var nim = $('#nim').val();
                var lokasi = $('#lokasi').val();
                var url = "{{ url()->full() }}?filter=true&masa=" + masa + "&matakuliah=" + matakuliah +
                    "&nim=" + nim + "&lokasi=" + lokasi;
                getDataTable(url, "#reportTable");
            });

            $(document).on('click', '#btnExport', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Memproses Data..',
                    icon: 'info',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
                var masa = $('#masa').val();
                var matakuliah = $('#matakuliah').val();
                var nim = $('#nim').val();
                var lokasi = $('#lokasi').val();
                var url = "{{ action('ReportController@export') }}?filter=true&masa=" + masa + "&matakuliah=" + matakuliah +
                    "&nim=" + nim + "&lokasi=" + lokasi;
                $(location).attr('href', url);
            })
        });
    </script>
@endsection

@section('button-title')
    <button class="btn btn-primary float-right btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
        aria-expanded="false" aria-controls="collapseExample">
        Filter
    </button>
    <button class="btn btn-success float-right btn-sm mx-2" type="button" id="btnExport">
        Export Xlsx
    </button>
@endsection
@section('content')
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="collapse" id="collapseExample">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">MASA</label>
                        {!! Form::select('masa', $masa, '', ['class' => 'form-control select', 'id' => 'masa']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">KODE MATAKULIAH</label>
                        {!! Form::select('matakuliah', $matakuliah, '', ['class' => 'form-control select', 'id' => 'matakuliah']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">NIM</label>
                        {!! Form::select('nim', $nim, '', ['class' => 'form-control select', 'id' => 'nim']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">ID LOKASI</label>
                        {!! Form::select('lokasi', $lokasi, '', ['class' => 'form-control select', 'id' => 'lokasi']) !!}
                    </div>
                    {{-- <div class="form-group col-md-6">
                    <label for="formGroupExampleInput">Product</label>
                    {!! Form::select('product', [], null,['class'=>'form-control select','id'=>'product']) !!}
                </div> --}}
                    <div class="col-md-12">
                        <button class="btn btn-success col-12" id="btnFilters">
                            Apply Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-body" id="reportTable">

            {{-- @includeIf('admin.report.table') --}}
        </div>
    </div>
@endsection
