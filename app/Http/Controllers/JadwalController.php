<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\JadwalTanggalPelaksana;
use App\JadwalTutorial;
use App\JadwalTutorialDetail;
use App\Kelas;
use App\LokasiTutorial;
use App\MataKuliah;
use App\RefJurusan;
use App\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = Jadwal::query();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('nomor', function ($row) {
    			$nomor = $row->nomor;
    			return $nomor;
    		})     
    		->addColumn('tahun_ajaran', function ($row) {
    			$tahun_ajaran = $row->tahun_ajaran;
    			return $tahun_ajaran;
    		})     		
    		->addColumn('tanggal_mulai', function ($row) {
    			$tanggal_mulai = date("d M Y", strtotime($row->tanggal_mulai));
    			return $tanggal_mulai;
    		})     
    		->addColumn('tanggal_selesai', function ($row) {
    			$tanggal_selesai = date("d M Y", strtotime($row->tanggal_selesai));
    			return $tanggal_selesai;
    		})     
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-info btn-xs" href="'.action('JadwalController@show',$row).'" data-placement="top" title="Detail" style="width:30%">Detail</a>';
    			$action = $action .  '<a class="btn btn-sm btn-warning modal-button btn-xs m-1" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('JadwalController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit" style="width:30%">Edit</a>';
    			$action = $action.  ' <button type="button" class="btn btn-danger btn-xs hapus" data-id="'. $row->id .'" style="width:30%">Hapus</button>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view('admin.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.jadwal.create_modal');
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
    		'nomor' => 'required',
    		'tahun_ajaran' => 'required',
    		'tanggal_mulai' => 'required',
    		'tanggal_selesai' => 'required',
    		'is_aktif' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$jadwal['created_by'] = auth()->user()->nik_npm;

    		if($request->is_aktif == 'Y'){
    			Jadwal::where('is_aktif', 'Y')->update(['is_aktif'=> 'N']);
    		}

    		Jadwal::create($jadwal);
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
    	return redirect(action('JadwalController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {

    	return view('admin.jadwal.detail', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {

    	return view('admin.jadwal.edit_modal', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
    	$data = $request->validate([
    		'nomor' => 'required',
    		'tahun_ajaran' => 'required',
    		'tanggal_mulai' => 'required',
    		'tanggal_selesai' => 'required',
    		'is_aktif' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$data['created_by'] = auth()->user()->nik_npm;

    		if($request->is_aktif == 'Y'){
    			Jadwal::where('is_aktif', 'Y')->update(['is_aktif'=> 'N']);
    		}

    		$jadwal->update($data);
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
    	return redirect(action('JadwalController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
		$jadwal->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }

    public function createTanggal($jadwalId)
    {

    	return view('admin.jadwal.create_tanggal_modal', compact('jadwalId'));
    }

    public function storeTanggal(Request $request)
    {

    	$jadwal = $request->validate([
    		'tanggal_selesai' => 'required',
    		'tanggal_mulai' => 'required',
    		'jadwal_id' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$jadwal['created_by'] = auth()->user()->nik_npm;
    		JadwalTanggalPelaksana::create($jadwal);
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

    public function createJadwalTutorial(Request $request, $jadwalId)
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
    	return view('admin.jadwal.create_jadwal_tutorial', compact('jadwalId','jurusan','kelas','lokasi','matakuliah','tutor'));
    }

    public function storeJadwalTutorial(Request $request)
    {
    	// dd($request);
    	$jadwal = $request->validate([
    		'id_tutorial' => 'required',
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

    public function destoryJadwalTutorial($id){
    	$jadwalTutorial = JadwalTutorialDetail::where('jadwal_tutorial_id',$id)->delete();

    	$result['code'] = '200';
    	return response()->json($result);

    }
}
