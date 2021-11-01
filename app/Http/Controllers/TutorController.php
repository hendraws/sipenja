<?php

namespace App\Http\Controllers;

use App\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = Tutor::query();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('nip', function ($row) {
    			$nip = $row->nip;
    			return $nip;
    		})   	    		
    		->addColumn('nama', function ($row) {
    			$nama = $row->nama;
    			return $nama;
    		})   	    		
    		->addColumn('gender', function ($row) {
    			$gender = $row->gender;
    			return $gender;
    		})  	
    		->addColumn('alamat', function ($row) {
    			$alamat = $row->alamat;
    			return $alamat;
    		})   	
    		->addColumn('telepon', function ($row) {
    			$telepon = $row->telepon;
    			return $telepon;
    		})   	
    		->addColumn('email', function ($row) {
    			$email = $row->email;
    			return $email;
    		})   	    		
    		->addColumn('status', function ($row) {
    			$status = $row->status == '1' ? 'Aktif' : 'Tidak Aktif';
    			return $status;
    		})   	
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-xs btn-info" href="'.action('TutorController@show',$row).'"  data-toggle="tooltip" data-placement="top" title="Pendidikan Tutor">Pendidikan Tutor</a>';
    			$action = $action.  '<a class="btn btn-xs btn-warning mx-2" href="'.action('TutorController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
    			$action = $action.  '<a class="btn btn-xs btn-danger modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('TutorController@delete',$row).'"  data-toggle="tooltip" data-placement="top" title="Hapus" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.tutor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.tutor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$tutorial = $request->validate([
    		'nip' => 'required',
    		'nama' => 'required',
    		'tanggal_lahir' => 'required',
    		'gender' => 'required',
    		'alamat' => 'required',
    		'telepon' => 'required',
    		'email' => 'required',
    		'status' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$tutorial['created_by'] = auth()->user()->nik_npm;
    		Tutor::create($tutorial);
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
    	return redirect(action('TutorController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show(Tutor $tutor)
    {
        return view('admin.tutor.detail', compact('tutor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutor $tutor)
    {
    	return view('admin.tutor.edit', compact('tutor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutor $tutor)
    {
    	$tutorial = $request->validate([
    		'nip' => 'required',
    		'nama' => 'required',
    		'tanggal_lahir' => 'required',
    		'gender' => 'required',
    		'alamat' => 'required',
    		'telepon' => 'required',
    		'email' => 'required',
    		'status' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$tutorial['updated_by'] = auth()->user()->nik_npm;
    		$tutor->update($tutorial);
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
    	return redirect(action('TutorController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutor $tutor)
    {
    	$tutor->delete();
    	toastr()->success('Data telah hapus', 'Berhasil');
    	return back();    
    }

    public function delete(Tutor $tutor)
    {
    	return view('admin.tutor.delete', compact('tutor'));   
    }
}
