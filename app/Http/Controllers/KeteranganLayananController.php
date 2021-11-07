<?php

namespace App\Http\Controllers;

use App\KeteranganLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KeteranganLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = KeteranganLayanan::get();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('keterangan', function ($row) {
    			$keterangan = $row->keterangan;
    			return $keterangan;
    		})   	
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-xs btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('KeteranganLayananController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
    			$action = $action.  ' <button type="button" class="btn btn-danger btn-xs hapus" data-id="'. $row->id .'">Hapus</button>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.keterangan_layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.keterangan_layanan.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$keterangan = $request->validate([
    		'keterangan' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$keterangan['created_by'] = auth()->user()->nik_npm;
    		KeteranganLayanan::create($keterangan);
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
    	return redirect(action('KeteranganLayananController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KeteranganLayanan  $keteranganLayanan
     * @return \Illuminate\Http\Response
     */
    public function show(KeteranganLayanan $keteranganLayanan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KeteranganLayanan  $keteranganLayanan
     * @return \Illuminate\Http\Response
     */
    public function edit(KeteranganLayanan $keteranganLayanan)
    {
    	
        return view('admin.keterangan_layanan.edit_modal', compact('keteranganLayanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KeteranganLayanan  $keteranganLayanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeteranganLayanan $keteranganLayanan)
    {
        $keterangan = $request->validate([
    		'keterangan' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$keterangan['updated_by'] = auth()->user()->nik_npm;
    		$keteranganLayanan->update($keterangan);
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
    	return redirect(action('KeteranganLayananController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KeteranganLayanan  $keteranganLayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeteranganLayanan $keteranganLayanan)
    {
    	$keteranganLayanan->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
