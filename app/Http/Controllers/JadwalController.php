<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\JadwalTanggalPelaksana;
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
    			$action =  '<a class="btn btn-sm btn-warning" href="'.action('JadwalController@show',$row).'" data-placement="top" title="Detail">Detail</a>';
    			// $action = $action .  '<a class="btn btn-sm btn-danger modal-button ml-2" href="Javascript:void(0)"  data-target="ModalForm" data-url="'.action('KantorCabangController@delete',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Edit" >Hapus</a>';

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

    	]);

    	DB::beginTransaction();
    	try {
    		$jadwal['created_by'] = auth()->user()->nik_npm;
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

    	return view('admin.jadwal.edit', compact($jadwal));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
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

    public function createJadwalTutorial($jadwalId)
    {
    
    	return view('admin.jadwal.create_jadwal_tutorial', compact('jadwalId'));
    }

    public function storeJadwalTutorial(Request $request)
    {
    	dd($request);
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
}
