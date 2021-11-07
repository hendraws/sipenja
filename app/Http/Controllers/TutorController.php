<?php

namespace App\Http\Controllers;

use App\Tutor;
use App\TutorEvaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    		->addColumn('nilai', function ($row) {
    			$nilai = optional($row->Evaluasi)->nilai;
    			if($nilai == '5'){
    				$kategori = 'Sangat Baik';
    			}elseif($nilai == '4'){
    				$kategori = 'Baik';
    			}elseif($nilai == '3'){
    				$kategori = 'Cukup';
    			}elseif($nilai == '2'){
    				$kategori = 'Kurang';
    			}elseif($nilai == '1'){
    				$kategori = 'Sangat Kurang';
    			}else{
    				$kategori = '-';
    			}
    			return $kategori;
    		})   	
    		->addColumn('evaluasi', function ($row) {
    		
    			$evaluasi = '<a class="btn btn-xs btn-primary" href="'. asset('storage/'.optional($row->Evaluasi)->file) .'"  data-toggle="tooltip" data-placement="top" title="Pendidikan Tutor" style="width:100%">Download</a>';
    			return $evaluasi;
    		})   	
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-xs btn-info" href="'.action('TutorController@show',$row).'"  data-toggle="tooltip" data-placement="top" title="Pendidikan Tutor" style="width:100%">Pendidikan Tutor</a>';
    			$action = $action.  '<a class="btn btn-xs btn-success modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('TutorController@evaluasi',$row).'"  data-toggle="tooltip" data-placement="top" title="Hapus" style="width:100%">Evaluasi</a>';
    			$action = $action.  '<a class="btn btn-xs btn-warning" href="'.action('TutorController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit" style="width:100%">Edit</a>';
    			$action = $action.  '<a class="btn btn-xs btn-danger modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('TutorController@delete',$row).'"  data-toggle="tooltip" data-placement="top" title="Hapus" style="width:100%">Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action','evaluasi'])
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

    public function evaluasi(Tutor $tutor)
    {
    	return view('admin.tutor.evaluasi_modal', compact('tutor'));   
    }    

    public function updateEvaluasi(Request $request, Tutor $tutor)
    {

    	DB::beginTransaction();
    	try {
    		$file_path = '';

    		if(!empty($request->file)) {
    			$allowedfileExtension = ['txt', 'xls', 'xlsx'];
    			// $path_file = 'evaluasi/';


    			$fullPath = storage_path('app/public/'.optional($tutor->Evaluasi)->file);
				if(Storage::disk('public')->exists(optional($tutor->Evaluasi)->file)){
					unlink($fullPath);
				}

    			$tmp = $request->file('file');
    			$extension = strtolower($tmp->getClientOriginalExtension());
    			$check=in_array($extension,$allowedfileExtension);
    			if ($check){
    				$filename = 'evaluasi/'.$tutor->nip.time().".".$extension;
    				$path = $request->file('file')->storeAs('public/', $filename);
    				// dd($path);
    			}
    		}

    		TutorEvaluasi::updateOrCreate(
    			[
    				'tutor_id'=> $tutor->id,
    			],
    			[
    				'nip'=>$tutor->nip,
    				'nilai'=>$request->nilai,
    				'file'=>$filename,
    				'created_by'=>auth()->user()->nik_npm,
    			]);
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

    	return view('admin.tutor.evaluasi_modal', compact('tutor'));   
    }
}
