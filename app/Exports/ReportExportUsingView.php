<?php

namespace App\Exports;

use App\Jadwal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExportUsingView implements FromView, ShouldAutoSize,WithStyles,ShouldQueue
{
    use Exportable;

	public function view(): View
	{

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
                ->when(request()->filled('matakuliah') && request()->masa != 'null', fn($q) =>
                    $q->Where('mata_kuliahs.id', request()->matakuliah)
                )
                ->when(request()->filled('nim') && request()->nim != 'null', fn($q) =>
                    $q->Where('mahasiswa.nim', request()->nim)
                )
                ->when(request()->filled('lokasi') && request()->lokasi != 'null', fn($q) =>
                    $q->Where('lokasi_tutorials.id', request()->lokasi)
                )
                ->get();

                return view('admin.report.export', compact('report'));
	}

	public function styles(Worksheet $sheet)
	{
		return [
			'A:Q' => [
				'font' => ['name' => 'Times New Roman']
			],
			// 'A5:Q7'=> [
			// 	'alignment' => [
			// 		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			// 		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			// 	],
			// 	'font' => [
			// 		'bold' => true,
			// 		'size'      =>  14,
			// 	]
			// ],
			'A5:Q7'=> [
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				],
				'font' => [
					'bold' => true,
				]
			],
			// 'A4:N5'=> [
			// 	'alignment' => [
			// 		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			// 		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			// 	],
			// 	'font' => [
			// 		'bold' => true,
			// 	]
			// ],
		];
	}
}
