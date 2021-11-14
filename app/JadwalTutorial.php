<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalTutorial extends Model
{
	protected $fillable = [ 'id_tutorial','jadwal_id', 'jurusan_id', 'kelas_id', 'kelompok_id', 'link', 'keterangan', 'created_by', 'updated_by' ];

	public function getKelompok(){
		return $this->belongsTo(LokasiTutorial::class, 'kelompok_id', 'id');
	}

	public function getJurusan(){
		return $this->belongsTo(RefJurusan::class, 'jurusan_id', 'id');
	}

	public function getKelas(){
		return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
	}

	public function getTutorialDetail(){
		return $this->hasMany(JadwalTutorialDetail::class, 'jadwal_tutorial_id','id');
	}


}
