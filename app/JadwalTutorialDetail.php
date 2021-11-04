<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalTutorialDetail extends Model
{
	protected $fillable = [ 'jadwal_id', 'jadwal_tutorial_id', 'number', 'waktu', 'matakuliah_id', 'jumlah_peserta', 'tutor_id', 'created_by', 'updated_by' ];

	public function getMatakuliah(){
		return $this->belongsTo(MataKuliah::class, 'matakuliah_id', 'id');
	}
	public function getTutor(){
		return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
	}
	
}
