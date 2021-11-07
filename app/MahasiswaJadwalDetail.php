<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahasiswaJadwalDetail extends Model
{
    protected $fillable = ['nim','mahasiswa_jadwal_id', 'jadwal_id', 'jadwal_tutorial_id', 'jadwal_tutorial_detail_id', 'number', 'waktu', 'matakuliah_id',];

    public function getJadwalDetail()
    {
    	return $this->belongsTo(JadwalTutorialDetail::class, 'jadwal_tutorial_detail_id', 'id');
    }

 }
