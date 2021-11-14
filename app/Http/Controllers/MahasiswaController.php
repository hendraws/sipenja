<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\JadwalTutorial;
use App\JadwalTutorialDetail;
use App\KeteranganLayanan;
use App\Mahasiswa;
use App\MahasiswaJadwal;
use App\MahasiswaJadwalDetail;
use App\RefCountry;
use App\RefJurusan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = Mahasiswa::get();

    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('nim', function ($row) {
    			$nim = $row->nim;
    			return $nim;
    		})
    		->addColumn('nama', function ($row) {
    			$nama = $row->nama;
    			return $nama;
    		})
    		->addColumn('jenis_kelamin', function ($row) {
    			$jenis_kelamin = $row->jenis_kelamin;
    			return $jenis_kelamin;
    		})
    		->addColumn('ttl', function ($row) {
    			$ttl = $row->tempat_lahir .', <br>'.date('d-m-Y',strtotime($row->tanggal_lahir));
    			return $ttl;
    		})
    		->addColumn('jurusan', function ($row) {
    			$jurusan = optional($row->getJurusan)->name;
    			return $jurusan;
    		})

    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-xs btn-info" href="'.action('MahasiswaController@show',$row).'"  data-toggle="tooltip" data-placement="top" title="Pendidikan Tutor" style="width:100%">Detail</a>';
    			$action = $action.  '<a class="btn btn-xs btn-warning" href="'.action('MahasiswaController@edit',$row).'"  data-toggle="tooltip" data-placement="top" title="Edit" style="width:100%">Edit</a>';
    			$action = $action.  ' <button type="button" class="btn btn-danger btn-xs hapus" data-id="'. $row->id .'" style="width:100%">Hapus</button>';
    			return $action;
    		})
    		->rawColumns(['action','ttl','nim'])
    		->make(true);
    	}

    	return view('admin.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$kewarganegaraan = RefCountry::pluck('nicename','nicename');
    	$jurusan = RefJurusan::pluck('name','id');
    	$keterangan = KeteranganLayanan::pluck('keterangan','id');

    	return view('admin.mahasiswa.create', compact('kewarganegaraan','jurusan','keterangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$mahasiswa = $request->validate([
    		'nim' => 'required',
    		'nama' => 'required',
    		'tempat_lahir' => 'required',
    		'tanggal_lahir' => 'required',
    		'jenis_kelamin' => 'required',
    		'agama' => 'required',
    		'alamat' => 'required',
    		'kewarganegaraan' => 'required',
    		'telepon' => 'required',
    		'email' => 'required',
    		'jurusan_id' => 'required',
    		'semester' => 'required',
    		'keterangan_layanan' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$mahasiswa['created_by'] = auth()->user()->nik_npm;
    		$mhs = Mahasiswa::create($mahasiswa);
    		$user = User::create([
    			'name' => $request->nama,
    			'email' => $request->email,
    			'password' => Hash::make(date('dmY',strtotime($request->tanggal_lahir))),
    			'username' => Str::slug($request->nama, '-'),
    			'nik_npm' => $request->nim,
    		]);
    		$user->assignRole('mahasiswa');
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
    	return redirect(action('MahasiswaController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
    	$kewarganegaraan = RefCountry::pluck('nicename','nicename');
    	$jurusan = RefJurusan::pluck('name','id');
    	$keterangan = KeteranganLayanan::pluck('keterangan','id');

    	return view('admin.mahasiswa.detail', compact('mahasiswa','kewarganegaraan','jurusan','keterangan' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {

    	$kewarganegaraan = RefCountry::pluck('nicename','nicename');
    	$jurusan = RefJurusan::pluck('name','id');
    	$keterangan = KeteranganLayanan::pluck('keterangan','id');

    	return view('admin.mahasiswa.edit', compact('mahasiswa','kewarganegaraan','jurusan','keterangan' ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
    	$mhs = $request->validate([
    		'nim' => 'required',
    		'nama' => 'required',
    		'tempat_lahir' => 'required',
    		'tanggal_lahir' => 'required',
    		'jenis_kelamin' => 'required',
    		'agama' => 'required',
    		'alamat' => 'required',
    		'kewarganegaraan' => 'required',
    		'telepon' => 'required',
    		'email' => 'required',
    		'jurusan_id' => 'required',
    		'semester' => 'required',
    		'keterangan_layanan' => 'required',
    	]);

    	DB::beginTransaction();
    	try {
    		$mhs['updated_by'] = auth()->user()->nik_npm;
    		$mahasiswa->getUser->update(['nik_npm' => $request->nim]);
    		$mahasiswa->update($mhs);
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
    	return redirect(action('MahasiswaController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
    	$mahasiswa->delete();
    	$mahasiswa->getUser->delete();
    	$result['code'] = '200';
    	return response()->json($result);
    }

    public function storeJadwalMhs(Request $request)
    {
        // dd($request);
    	DB::beginTransaction();
    	try {
    		$last_id = MahasiswaJadwal::latest()->first();
    		$last_id = $last_id  ? $last_id->id + 1 :  '1';
    		$nim = auth()->user()->nik_npm;

    		$mhsJadwal = MahasiswaJadwal::create([
    			'kode_order' => $nim.'-'.date('dmY').'-'.$last_id,
    			'nim' => $nim,
    			'jadwal_tutorial_id' => $request->jadwal_tutorial_id,
    			'status' => 'aktif'
    		]);

    		foreach ($request->jadwal_tutorial_detail_id as $key => $value) {

    			$jadwal = JadwalTutorialDetail::where('id', $value)->first();
    			$a = MahasiswaJadwalDetail::create([
    				'nim' => $nim,
    				'mahasiswa_jadwal_id' => $mhsJadwal->id,
    				'jadwal_id' => $jadwal->jadwal_id,
    				'jadwal_tutorial_id' => $jadwal->jadwal_tutorial_id,
    				'jadwal_tutorial_detail_id' => $jadwal->id,
    				'number' => $jadwal->number,
    				'waktu'=> $jadwal->waktu,
    				'matakuliah_id'=> $jadwal->matakuliah_id,
    			]);
    		}
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
    	return back();
    }

    public function showJadwal(MahasiswaJadwal $mahasiswa)
    {
    	return view('mahasiswa.detail', compact('mahasiswa'));
    }

    public function editJadwal(Request $request, MahasiswaJadwal $mahasiswa)
    {

    	$jadwal = Jadwal::where('is_aktif', 'Y')->first();
    	$cek = MahasiswaJadwalDetail::where('jadwal_id', $jadwal->id)->where('nim', auth()->user()->nik_npm)
    	->where('mahasiswa_jadwal_id', $mahasiswa->id)
        ->where('is_deleted', 'N')
    	->pluck('number', 'jadwal_tutorial_detail_id')->toArray();
    	$cekAll = MahasiswaJadwalDetail::where('jadwal_id', $jadwal->id)->where('nim', auth()->user()->nik_npm)
    	->where('mahasiswa_jadwal_id',"!=" , $mahasiswa->id)
        ->where('is_deleted', 'N')
    	->pluck('number')->toArray();

    	$paket = JadwalTutorial::where('id', $mahasiswa->jadwal_tutorial_id)->first();

    	$lokasi = $jadwal->getJadwalTutorial->mapWithKeys(function ($item, $key) {
    		return  [$item->id => $item->getKelompok->lokasi .' - Kelas : '. $item->getKelas->nama];
    	});

    	if($request->ajax() && $request->has('jadwal_tutorial_id')){
    		$jadwalTutor = JadwalTutorial::where('id', $request->jadwal_tutorial_id)->first();
    		return view('mahasiswa.table_paket', compact('jadwalTutor','cek', 'cekAll'));
    	}
        // dd($paket,$lokasi,$jadwal,$mahasiswa->jadwal_tutorial_id);


    	return view('mahasiswa.edit', compact('mahasiswa','jadwal','lokasi','paket','cek', 'cekAll'));
    }

    public function updateJadwal(Request $request, MahasiswaJadwal $mahasiswa)
    {
        DB::beginTransaction();
    	try {
            $nim = auth()->user()->nik_npm;
            if($request->has('jadwal_tutorial_detail_id')){
                if($request->has('jadwal_sekarang')){
                    $mhsdetail = MahasiswaJadwalDetail::whereIn('jadwal_tutorial_detail_id', $request->jadwal_sekarang )->delete();
    			}

                foreach ($request->jadwal_tutorial_detail_id as $key => $value) {
                    $nim = auth()->user()->nik_npm;
                    $jadwal = JadwalTutorialDetail::where('id', $value)->first();
                    MahasiswaJadwalDetail::create([
                        'nim' => $nim,
                        'mahasiswa_jadwal_id' => $mahasiswa->id,
                        'jadwal_id' => $jadwal->jadwal_id,
                        'jadwal_tutorial_id' => $jadwal->jadwal_tutorial_id,
                        'jadwal_tutorial_detail_id' => $jadwal->id,
                        'number' => $jadwal->number,
                        'waktu'=> $jadwal->waktu,
                        'matakuliah_id'=> $jadwal->matakuliah_id,
                    ]);
                }
    		}else{
                toastr()->error('harus pilih salah satu matakuliah', 'Error');
                return back();
            }

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
    	return redirect(action('HomeController@index'));
    }

    public function destroyJadwal($id)
    {
    	DB::beginTransaction();
    	try {
    		MahasiswaJadwal::where('id',$id)->update([
    			'status' => 'non aktif'
    		]);

            MahasiswaJadwalDetail::where('mahasiswa_jadwal_id', $id)->update([
                'is_deleted' => 'Y'
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
    	$result['code'] = '200';
    	return response()->json($result);
    }

}
