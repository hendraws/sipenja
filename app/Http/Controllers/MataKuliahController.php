<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use App\RefJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    		->addColumn('jurusan', function ($row) {
    			$jurusan = optional($row->getJurusan)->name;
    			return $jurusan;
    		})     	
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('MataKuliahController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit"  data-mode="lg">Edit</a>';
    			$action = $action.  '<a class="btn btn-sm btn-danger modal-button mx-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('MataKuliahController@delete',$row).'"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.matakuliah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$jurusan = RefJurusan::get();
    	return view('admin.matakuliah.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$matakuliah = $request->validate([
    		'jurusan_id' => 'required',
    		'nama_mk' => 'required',
    		'kode_mk' => 'required',
    		'semester' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$matakuliah['created_by'] = auth()->user()->nik_npm;
    		MataKuliah::create($matakuliah);
    	} catch (\Exception $e) {
    		DB::rollback();
    		toastr()->error($e->getMessage(), 'Error');
    		return back();
    	}catch (\Throwable $e) {
    		DB::rollback();
    		toastr()->error($e->getMessage(), 'Error');
    		throw $e;
    	}

    	DB::commit();
    	toastr()->success('Data telah ditambahkan', 'Berhasil');
    	return redirect(action('MataKuliahController@index'));
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
    public function edit(MataKuliah $matakuliah)
    {
    	$jurusan = RefJurusan::get();
    	return view('admin.matakuliah.edit_modal', compact('matakuliah','jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {

    	$mk = $request->validate([
    		'jurusan_id' => 'required',
    		'nama_mk' => 'required',
    		'kode_mk' => 'required',
    		'semester' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$mk['updated_by'] = auth()->user()->nik_npm;
    		$matakuliah->update($mk);
    	} catch (\Exception $e) {
    		DB::rollback();
    		toastr()->error($e->getMessage(), 'Error');
    		return back();
    	}catch (\Throwable $e) {
    		DB::rollback();
    		toastr()->error($e->getMessage(), 'Error');
    		throw $e;
    	}

    	DB::commit();
    	toastr()->success('Data telah diubah', 'Berhasil');
    	return redirect(action('MataKuliahController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
    	toastr()->success('Data telah hapus', 'Berhasil');
    	return back();
    }

    public function delete(MataKuliah $matakuliah)
    {
    	return view('admin.matakuliah.delete', compact('matakuliah'));   
    }
}
