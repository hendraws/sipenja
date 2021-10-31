<?php

namespace App\Http\Controllers;

use App\LokasiTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LokasiTutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = LokasiTutorial::query();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('lokasi', function ($row) {
    			$lokasi = $row->lokasi;
    			return $lokasi;
    		})   	
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('LokasiTutorialController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
    			$action = $action.  '<a class="btn btn-sm btn-danger modal-button mx-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('LokasiTutorialController@delete',$row).'"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.lokasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.lokasi.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$lokasi = $request->validate([
    		'lokasi' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$lokasi['created_by'] = auth()->user()->nik_npm;
    		LokasiTutorial::create($lokasi);
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
    	return redirect(action('LokasiTutorialController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LokasiTutorial  $lokasiTutorial
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiTutorial $lokasiTutorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LokasiTutorial  $lokasiTutorial
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiTutorial $lokasi)
    {
    	return view('admin.lokasi.edit_modal', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LokasiTutorial  $lokasiTutorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LokasiTutorial $lokasi)
    {
    	$lokasiTutorial = $request->validate([
    		'lokasi' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$lokasi['updated_by'] = auth()->user()->nik_npm;
    		$lokasi->update($lokasiTutorial);
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
    	return redirect(action('LokasiTutorialController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LokasiTutorial  $lokasiTutorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiTutorial $lokasi)
    {

    	$lokasi->delete();
    	toastr()->success('Data telah terhapus', 'Berhasil');
    	return back();
    }    

    public function delete(LokasiTutorial $lokasi)
    {
        return view('admin.lokasi.delete', compact('lokasi'));   
    }
}
