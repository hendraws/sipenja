<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahasiswaJadwal extends Model
{
    protected $fillable = ['kode_order', 'nim', 'lokasi_id', 'status', ];

    public function getMahasiswa(){
    	return $this->belongsTo(Mahasiswa::class,'nim','nim');
    }

    public function getLokasi(){
    	return $this->belongsTo(LokasiTutorial::class,'lokasi_id','id');
    }

    public function getMahasiswaJadwalDetail(){
    	return $this->hasMany(MahasiswaJadwalDetail::class, 'mahasiswa_jadwal_id','id');
    }
}
