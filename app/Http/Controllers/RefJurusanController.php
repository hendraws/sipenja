<?php

namespace App\Http\Controllers;

use App\RefFakultas;
use App\RefJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RefJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = RefJurusan::query();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('jurusan', function ($row) {
    			$jurusan = $row->name;
    			return $jurusan;
    		})   	
    		->addColumn('fakultas', function ($row) {
    			$fakultas = optional($row->Fakultas)->name;
    			return $fakultas;
    		})     
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('RefJurusanController@edit',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
    			$action = $action.  '<a class="btn btn-sm btn-danger modal-button mx-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('RefJurusanController@delete',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.jurusan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$fakultas = RefFakultas::get();
        return view('admin.jurusan.create_modal', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jurusan = $request->validate([
        	'fakultas_id' => 'required',
        	'name' => 'required',
        	'kode_jurusan' => 'required',
        ]);

        DB::beginTransaction();
        try {
        	$jurusan['created_by'] = auth()->user()->nik_npm;
        	RefJurusan::create($jurusan);
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
        return redirect(action('RefJurusanController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RefJurusan  $refJurusan
     * @return \Illuminate\Http\Response
     */
    public function show(RefJurusan $refJurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RefJurusan  $refJurusan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurusan = RefJurusan::find($id);
    	$fakultas = RefFakultas::get();
    	return view('admin.jurusan.edit_modal', compact('fakultas','jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RefJurusan  $refJurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jurusan = $request->validate([
    		'fakultas_id' => 'required',
    		'kode_jurusan' => 'required',
    		'name' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$jurusan['updated_by'] = auth()->user()->nik_npm;
    		RefJurusan::where('id',$id)->update($jurusan);
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
    	return redirect(action('RefJurusanController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RefJurusan  $refJurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$jurusan = RefJurusan::find($id);
    	$jurusan->delete();
    	toastr()->success('Data telah hapus', 'Berhasil');
    	return back();
    }  

    public function delete($id)
    {
    	$jurusan = RefJurusan::find($id);
     	return view('admin.jurusan.delete', compact('jurusan'));   
    }

}
