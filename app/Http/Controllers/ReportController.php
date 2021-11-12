<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request)
    {
    	$report = Jadwal::join('mahasiswa_jadwal_details', 'mahasiswa_jadwal_details.jadwal_id', 'jadwals.id')
    			->join('jadwal_tutorial_details','jadwal_tutorial_details.id', 'mahasiswa_jadwal_details.jadwal_tutorial_detail_id')
    			->join('mata_kuliahs', 'mata_kuliahs.id','jadwal_tutorial_details.matakuliah_id')
    			->join('jadwal_tutorials', 'jadwal_tutorials.id','jadwal_tutorial_details.jadwal_tutorial_id')
    			->join('tutors', 'tutors.id','jadwal_tutorial_details.jadwal_tutorial_id')
                ->join('kelas', 'kelas.id','jadwal_tutorials.kelas_id')
                ->join('mahasiswa_jadwals','mahasiswa_jadwals.id','mahasiswa_jadwal_details.mahasiswa_jadwal_id')
                ->join('mahasiswas', 'mahasiswas.nim', 'mahasiswa_jadwals.nim')
                ->join('lokasi_tutorials','lokasi_tutorials.id','jadwal_tutorials.kelompok_id')
                ->selectRaw('nomor,tahun_ajaran, tanggal_mulai, tanggal_selesai, jadwals.is_aktif as is_aktif, mahasiswas.nim as nim_mahasiswa,mahasiswas.nama as nama_mahasiswa,id_tutorial,id_tutor,tutors.nama as nama_tutor,kelas.nama as nama_kelas,mahasiswa_jadwals.status as status_jadwal, lokasi, link, keterangan,mata_kuliahs.kode_mk as kode_mk ,  mata_kuliahs.nama_mk as nama_mk, jadwals.id as id_jadwal')
    			->where('jadwals.is_aktif','Y')
                ->where('is_deleted', 'N')
    			->get();
        // dd($report);
    	return view('admin.report.index', compact('report'));
    }
}
