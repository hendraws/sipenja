<?php

namespace App\Http\Controllers;

use App\JadwalTutorial;
use App\JadwalTutorialDetail;
use App\Kelas;
use App\LokasiTutorial;
use App\MataKuliah;
use App\RefJurusan;
use App\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalTutorialDetailController extends Controller
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
    public function create(Request $request, $jadwalId)
    {
    	if ($request->ajax()) {
    		if($request->has('cek')){
    			// dd($request->tutor_id);
    			$result = [];
    			$cekTutor = JadwalTutorialDetail::where('jadwal_id', $jadwalId)->where('number', $request->number)->where('tutor_id', $request->tutor_id)->first();
    			if(!empty($cekTutor)){
    				$result['code'] = '200';
    				$result['number'] = $request->number;
    			}
    			return response()->json($result);

    		}
    	}
    	$jadwalTutor = JadwalTutorial::where('jadwal_id', $jadwalId)->get();
    	// dd($jadwalTutor->pluck('kelas_id', 'kelas_id'));
    	$jurusan = RefJurusan::get();
    	$kelas = Kelas::whereNotIn('id', $jadwalTutor->pluck('kelas_id', 'kelas_id'))->get();
    	$lokasi = LokasiTutorial::get();
    	$matakuliah = MataKuliah::get();
    	$tutor = Tutor::get();
    	return view('admin.jadwal_detail.create_jadwal_tutorial', compact('jadwalId','jurusan','kelas','lokasi','matakuliah','tutor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$jadwal = $request->validate([
    		'jadwal_id' => 'required',
    		'jurusan_id' => 'required',
    		'kelas_id' => 'required',
    		'kelompok_id' => 'required',
    		'link' => 'required',
    		'keterangan' => 'required'
    	]);
    	DB::beginTransaction();
    	try {
    		$jadwal['created_by'] = auth()->user()->nik_npm;
    		$jadwal = JadwalTutorial::create($jadwal);
    		$waktu = $request->waktu;
    		$matakuliah = $request->matakuliah;
    		$jumlah_peserta = $request->jumlah_peserta;
    		$tutor = $request->tutor;

    		for ($i=1; $i <= count($tutor) ; $i++) { 
    			JadwalTutorialDetail::create([
    				'jadwal_id' => $request->jadwal_id,
    				'jadwal_tutorial_id' => $jadwal->id,
    				'number' => $i,
    				'waktu'=> $waktu[$i],
    				'matakuliah_id' => $matakuliah[$i],
    				'jumlah_peserta'=> $jumlah_peserta[$i],
    				'tutor_id' => $tutor[$i],
    				'created_by' => auth()->user()->nik_npm,
    			]);
    		}
    		// dd($jadwal, $request->all(),$waktu[2]);
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
    	return redirect(action('JadwalController@show', $request->jadwal_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JadwalTutorialDetail  $jadwalTutorialDetail
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalTutorialDetail $jadwalTutorialDetail)
    {
    	
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalTutorialDetail  $jadwalTutorialDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $jadwalId, $id)
    {

        if ($request->ajax()) {
    		if($request->has('cek')){
 
    			$result = [];
    			$cekTutor = JadwalTutorialDetail::where('jadwal_id', $jadwalId)->where('number', $request->number)->where('tutor_id', $request->tutor_id)->where('id', '!=', $request->tutor_detail_id)->first();
    			if(!empty($cekTutor)){
    				$result['code'] = '200';
    				$result['number'] = $request->number;
    			}
    			return response()->json($result);

    		}
    	}
    	$dataJadwal = JadwalTutorial::find($id);
    	// dd($dataJadwal->getTutorialDetail->toArray()[0]['matakuliah_id']); 
    	$jadwalTutor = JadwalTutorial::where('jadwal_id', $jadwalId)->where('id','!=', $id)->get();
    	// dd($jadwalTutor->pluck('kelas_id', 'kelas_id'));
    	$jurusan = RefJurusan::get();
    	$kelas = Kelas::whereNotIn('id', $jadwalTutor->pluck('kelas_id', 'kelas_id'))->get();
    	$lokasi = LokasiTutorial::get();
    	$matakuliah = MataKuliah::get();
    	$tutor = Tutor::get();
    	return view('admin.jadwal_detail.edit_jadwal_tutorial', compact('jadwalId','jurusan','kelas','lokasi','matakuliah','tutor','dataJadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalTutorialDetail  $jadwalTutorialDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $jadwal = $request->validate([
    		'jadwal_id' => 'required',
    		'jurusan_id' => 'required',
    		'kelas_id' => 'required',
    		'kelompok_id' => 'required',
    		'link' => 'required',
    		'keterangan' => 'required'
    	]);
    	DB::beginTransaction();
    	try {
    		$jadwal['updated_by'] = auth()->user()->nik_npm;
    		$jadwal = JadwalTutorial::where('id', $id)->update($jadwal);
    		$waktu = $request->waktu;
    		$matakuliah = $request->matakuliah;
    		$jumlah_peserta = $request->jumlah_peserta;
    		$tutor = $request->tutor;

    		for ($i=1; $i <= count($tutor) ; $i++) { 
    			JadwalTutorialDetail::where('jadwal_tutorial_id', $id)->where('number',$i)->update([
    				'number' => $i,
    				'waktu'=> $waktu[$i],
    				'matakuliah_id' => $matakuliah[$i],
    				'jumlah_peserta'=> $jumlah_peserta[$i],
    				'tutor_id' => $tutor[$i],
    				'updated_by' => auth()->user()->nik_npm,
    			]);
    		}
    		// dd($jadwal, $request->all(),$waktu[2]);
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
    	return redirect(action('JadwalController@show', $request->jadwal_id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalTutorialDetail  $jadwalTutorialDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$jadwalTutorial = JadwalTutorialDetail::where('jadwal_tutorial_id',$id)->delete();
    	$jadwal = JadwalTutorial::where('id',$id)->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }
}
