<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = ['kode_mk', 'nama_mk', 'kode_ba', 'nama_ba', 'sks', 'semester', 'kurikulum_id', 'jurusan_id', 'created_by', 'updated_by'];

    public function getJurusan(){
    	return $this->belongsTo(RefJurusan::class, 'jurusan_id','id');
    }
}
