<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
	protected $fillable  = ['nim', 'nik', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'kewarganegaraan', 'telepon', 'email', 'agama', 'jurusan_id', 'fakultas_id', 'semester', 'kurikulum', 'keterangan_layanan', 'created_by', 'updated_by'];

	public function getJurusan(){
		return $this->belongsTo(RefJurusan::class, 'jurusan_id', 'id');
	}
	public function getUser(){
		return $this->belongsTo(User::class, 'nim', 'nik_npm');
	}

}
