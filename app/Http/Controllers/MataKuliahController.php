<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
    		$data = MataKuliah::get();
    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('kode_mk', function ($row) {
    			$kode_mk = $row->kode_mk;
    			return $kode_mk;
    		})     
    		->addColumn('nama_mk', function ($row) {
    			$nama_mk = $row->nama_mk;
    			return $nama_mk;
    		})     
    		->addColumn('kode_ba', function ($row) {
    			$kode_ba = $row->kode_ba;
    			return $kode_ba;
    		})          
    		->addColumn('nama_ba', function ($row) {
    			$nama_ba = $row->nama_ba;
    			return $nama_ba;
    		})     
    		->addColumn('action', function ($row) {
    			// $action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('KantorCabangController@edit',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
    			// $action = $action .  '<a class="btn btn-sm btn-danger modal-button ml-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('KantorCabangController@delete',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Hapus</a>';

    			// return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.kurikulum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        //
    }
}
