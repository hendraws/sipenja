<?php

namespace App\Http\Controllers;

use App\Tutor;
use App\TutorPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$tutor = Tutor::find($request->data);
    	return view('admin.tutor_pendidikan.create', compact('tutor'));
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
    		'tutor_id' => 'required',
    		'bidang_studi' => 'required',
    		'kode_pt' => 'required',
    		'nama_pt' => 'required',
    		'akreditasi' => 'required',
    		'nama_pendidikan_akhir' => 'required',
    		'tahun_lulus' => 'required',
    		'gelar' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$tutorial['created_by'] = auth()->user()->nik_npm;
    		TutorPendidikan::create($tutorial);
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
    	return redirect(action('TutorController@show', $request->tutor_id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TutorPendidikan  $tutor_pendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(TutorPendidikan $tutor_pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TutorPendidikan  $tutor_pendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(TutorPendidikan $tutor_pendidikan)
    {
    	$tutor = Tutor::find($tutor_pendidikan->tutor_id);
    	return view('admin.tutor_pendidikan.edit', compact('tutor_pendidikan', 'tutor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TutorPendidikan  $tutor_pendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TutorPendidikan $tutor_pendidikan)
    {
    	$tutorial = $request->validate([
    		'bidang_studi' => 'required',
    		'kode_pt' => 'required',
    		'nama_pt' => 'required',
    		'akreditasi' => 'required',
    		'nama_pendidikan_akhir' => 'required',
    		'tahun_lulus' => 'required',
    		'gelar' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$tutorial['updated_by'] = auth()->user()->nik_npm;
    		$tutor_pendidikan->update($tutorial);
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
    	return redirect(action('TutorController@show', $tutor_pendidikan->tutor_id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TutorPendidikan  $tutor_pendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutorPendidikan $tutor_pendidikan)
    {
    	$tutor_pendidikan->delete();
    	toastr()->success('Data telah hapus', 'Berhasil');
    	return back();    
    }

    public function delete(TutorPendidikan $tutor_pendidikan)
    {
    	return view('admin.tutor_pendidikan.delete', compact('tutor_pendidikan'));   
    }
}
