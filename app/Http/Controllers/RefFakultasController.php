<?php

namespace App\Http\Controllers;

use App\RefFakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RefFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = RefFakultas::get();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('name', function ($row) {
    			$name = $row->name;
    			return $name;
    		})        		
    		->addColumn('name', function ($row) {
    			$name = $row->name;
    			return $name;
    		})     
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('RefFakultasController@edit',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
    			$action = $action.  '<a class="btn btn-sm btn-danger modal-button mx-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('RefFakultasController@delete',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.fakultas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.fakultas.create_modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$fakultas = $request->validate([
    		'kode_fakultas' => 'required',
    		'name' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$fakultas['created_by'] = auth()->user()->nik_npm;
    		RefFakultas::create($fakultas);
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
    	return redirect(action('RefFakultasController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RefFakultas  $refFakultas
     * @return \Illuminate\Http\Response
     */
    public function show(RefFakultas $refFakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RefFakultas  $refFakultas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$fakultas = RefFakultas::find($id);
    	return view('admin.fakultas.edit_modal', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RefFakultas  $refFakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	$jadwal = $request->validate([
    		'kode_fakultas' => 'required',
    		'name' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$jadwal['updated_by'] = auth()->user()->nik_npm;
    		RefFakultas::where('id',$id)->update($jadwal);
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
    	return redirect(action('RefFakultasController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RefFakultas  $refFakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$fakultas = RefFakultas::find($id);
    	$fakultas->delete();
    	toastr()->success('Data telah hapus', 'Berhasil');
    	return back();
    }  

    public function delete($id)
    {
    	$fakultas = RefFakultas::find($id);
     	return view('admin.fakultas.delete', compact('fakultas'));   
    }

}
