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
    			->where('is_aktif',1)
    			->get()
    			->toArray();

    	dd($report);
    	return view('admin.report.index');
    }
}
