<?php

namespace App\Http\Controllers;

use App\Exports\ReportExportUsingView;
use App\Jadwal;
use App\LokasiTutorial;
use App\Mahasiswa;
use App\MataKuliah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->all());
            $report = Jadwal::join('mahasiswa_jadwal_details', 'mahasiswa_jadwal_details.jadwal_id', 'jadwals.id')
                ->join('jadwal_tutorial_details', 'jadwal_tutorial_details.id', 'mahasiswa_jadwal_details.jadwal_tutorial_detail_id')
                ->join('mata_kuliahs', 'mata_kuliahs.id', 'jadwal_tutorial_details.matakuliah_id')
                ->join('jadwal_tutorials', 'jadwal_tutorials.id', 'jadwal_tutorial_details.jadwal_tutorial_id')
                ->join('tutors', 'tutors.id', 'jadwal_tutorial_details.jadwal_tutorial_id')
                ->join('kelas', 'kelas.id', 'jadwal_tutorials.kelas_id')
                ->join('mahasiswa_jadwals', 'mahasiswa_jadwals.id', 'mahasiswa_jadwal_details.mahasiswa_jadwal_id')
                ->join('mahasiswas', 'mahasiswas.nim', 'mahasiswa_jadwals.nim')
                ->join('lokasi_tutorials', 'lokasi_tutorials.id', 'jadwal_tutorials.kelompok_id')
                ->selectRaw('nomor,tahun_ajaran, tanggal_mulai, tanggal_selesai, jadwals.is_aktif as is_aktif, mahasiswas.nim as nim_mahasiswa,mahasiswas.nama as nama_mahasiswa,id_tutorial,id_tutor,tutors.nama as nama_tutor,kelas.nama as nama_kelas,mahasiswa_jadwals.status as status_jadwal, lokasi, link, keterangan,mata_kuliahs.kode_mk as kode_mk ,  mata_kuliahs.nama_mk as nama_mk, jadwals.id as id_jadwal')
                ->where('jadwals.is_aktif', 'Y')
                ->where('is_deleted', 'N')
                ->when(request()->filled('masa') && request()->masa != 'null' , fn($q) =>
                    $q->Where('tahun_ajaran', request()->masa)
                )
                ->when(request()->filled('matakuliah') && request()->masa != 'matakuliah', fn($q) =>
                    $q->Where('mata_kuliahs.id', request()->matakuliah)
                )
                ->when(request()->filled('nim') && request()->nim != 'null', fn($q) =>
                    $q->Where('mahasiswa.nim', request()->nim)
                )
                ->when(request()->filled('lokasi') && request()->lokasi != 'null', fn($q) =>
                    $q->Where('lokasi_tutorials.id', request()->lokasi)
                )
                ->get();
            return view('admin.report.table', compact('report'));
        }

        $nim = Mahasiswa::selectRaw('nim, CONCAT(nim," - ", nama) as nim_nama')->pluck('nim_nama', 'nim');
        $matakuliah = MataKuliah::selectRaw('id, CONCAT(kode_mk," - ", nama_mk) as mk')->pluck('mk', 'id');
        $lokasi = LokasiTutorial::pluck('lokasi', 'id');

        $datamasa = ['2019/2020', '2020/2021', '2021/2022', '2022/2023', '2023/2024'];
        $masa = [];
        foreach($datamasa as $val){
            $masa[$val] = $val;
        }
        return view('admin.report.index', compact( 'nim', 'matakuliah', 'lokasi', 'masa'));
    }

    public function export(Request $request)
    {

    	$filename = 'Report-Jadwal-Tutorial-'. now()->format('Y-md_Hi') .'.xlsx';
    	return Excel::download(new ReportExportUsingView(), $filename);
    }
}
