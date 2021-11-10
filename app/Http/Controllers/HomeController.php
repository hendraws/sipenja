<?php

namespace App\Http\Controllers;


use App\Jadwal;
use App\JadwalTutorial;
use App\JadwalTutorialDetail;
use App\Mahasiswa;
use App\MahasiswaJadwal;
use App\MahasiswaJadwalDetail;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
    	if(auth()->user()->hasRole('mahasiswa')){
    		$mahasiswa = Mahasiswa::where('nim', auth()->user()->nik_npm)->first();
    		$jadwal = Jadwal::where('is_aktif', 'Y')->first();
    		$mahasiswaJadwal = MahasiswaJadwal::where('nim', auth()->user()->nik_npm)->get();
    		if($request->ajax())
    		{
                $cek = MahasiswaJadwalDetail::where('jadwal_id', $jadwal->id)->where('nim', auth()->user()->nik_npm)->pluck('number')->toArray();
    			$jadwal = JadwalTutorial::where('id', $request->jadwal_tutorial_id)->first();

    			return view('mahasiswa.table_paket', compact('jadwal','cek'));

    			// $jadwal = JadwalTutorial::where('jurusan_id', $request->jurusan_id)->where('jadwal_id', $request->jadwal_id)->where('kelompok_id', $request->lokasi_id)->get();
    			// $matakuliah = JadwalTutorialDetail::with('getMatakuliah','getTutor')
    			// ->where('jadwal_id', $request->jadwal_id)
    			// ->whereIn('jadwal_tutorial_id', $jadwal->pluck('id'))
    			// ->where('number',$request->number)
    			// ->whereHas('getMatakuliah')
    			// ->whereHas('getTutor')
    			// ->get();

    			// return response()->json($matakuliah);
    		}
    		$lokasi = $cek = [];
    		if(!empty($jadwal->getJadwalTutorial)){
    			$lokasi = $jadwal->getJadwalTutorial->mapWithKeys(function ($item, $key) {
    				return  [$item->id => $item->getKelompok->lokasi .' - Kelas : '. $item->getKelas->nama];
    			});

    			$cek = MahasiswaJadwalDetail::where('jadwal_id', $jadwal->id)->where('nim', auth()->user()->nik_npm)->pluck('number')->toArray();
    		}


    	// $lokasi = $jadwal->getJadwalTutorial;
    		return view('mahasiswa.index', compact('mahasiswa','jadwal','mahasiswaJadwal','lokasi', 'cek'));
    	}
    	return view('home');
    }

    public function MahasiswaIndex(Request $request)
    {

    }

    public function storeJadwalMhs(Request $request)
    {
    	$mahasiswa = Mahasiswa::where('nim', auth()->user()->nik_npm)->first();
    	$jadwal = Jadwal::where('is_aktif', 'Y')->first();

    	if($request->ajax())
    	{
    		$jadwal = JadwalTutorial::where('jurusan_id', $request->jurusan_id)->where('jadwal_id', $request->jadwal_id)->where('kelompok_id', $request->lokasi_id)->get();
    		$matakuliah = JadwalTutorialDetail::with('getMatakuliah','getTutor')
    		->where('jadwal_id', $request->jadwal_id)
    		->whereIn('jadwal_tutorial_id', $jadwal->pluck('id'))
    		->where('number',$request->number)
    		->whereHas('getMatakuliah')
    		->whereHas('getTutor')
    		->get();

    		return response()->json($matakuliah);
    	}
    	// $lokasi = $jadwal->getJadwalTutorial;
    	return view('mahasiswa.index', compact('mahasiswa','jadwal','mahasiswaJadwal'));;
    }
}
