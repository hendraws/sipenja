<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = ['nip', 'nik', 'nama', 'upbjj', 'gender', 'tanggal_lahir', 'alamat', 'telepon', 'email', 'status', 'institusi', 'jabatan_fungsional', 'golongan','created_by','updated_by'];

    public function Pendidikan(){
    	return $this->hasMany(TutorPendidikan::class, 'tutor_id', 'id');
    }
}
