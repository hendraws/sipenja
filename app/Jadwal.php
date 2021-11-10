<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['nomor','tahun_ajaran','tanggal_mulai','tanggal_selesai','is_aktif','created_by','updated_by'];

    // public function TanggalPelaksanaan(){
    // 	return $this->hasMany(JadwalTanggalPelaksana::class, 'jadwal_id','id');
    // }

    public function getJadwalTutorial(){
    	return $this->hasMany(JadwalTutorial::class, 'jadwal_id','id');
    }
    public function getJadwalTutorialDetail(){
    	return $this->hasMany(JadwalTutorialDetail::class, 'jadwal_id','id');
    }


}
