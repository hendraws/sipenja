<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = Kelas::get();
    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('nama', function ($row) {
    			$nama = $row->nama;
    			return $nama;
    		})      	
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('KelasController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit">Edit</a>';
    			$action = $action.  '<a class="btn btn-sm btn-danger modal-button mx-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('KelasController@delete',$row).'"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.kelas.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$kelas = $request->validate([
    		'nama' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$kelas['created_by'] = auth()->user()->nik_npm;
    		Kelas::create($kelas);
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
    	return redirect(action('KelasController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
    	return view('admin.kelas.edit_modal', compact('kela'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {

    	$kelas = $request->validate([
    		'nama' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$kelas['created_by'] = auth()->user()->nik_npm;
    		$kela->update($kelas);
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
    	toastr()->success('Data telah Diubah', 'Berhasil');
    	return redirect(action('KelasController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();
    	toastr()->success('Data telah terhapus', 'Berhasil');
    	return back();
    }

    public function delete(Kelas $kela)
    {
    	return view('admin.kelas.delete', compact('kela'));   
    }
}
