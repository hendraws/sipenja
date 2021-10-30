<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['nomor','tahun_ajaran','tanggal_mulai','tanggal_selesai','created_by','updated_by'];

    public function TanggalPelaksanaan(){
    	return $this->hasMany(JadwalTanggalPelaksana::class, 'jadwal_id','id');
    }
}