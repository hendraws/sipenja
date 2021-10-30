<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefJurusan extends Model
{
    protected $fillable = ['id', 'fakultas_id', 'kode_jurusan', 'name', 'created_by', 'updated_by'];

    public function Fakultas(){
    	return $this->belongsTo(RefFakultas::class, 'fakultas_id','id');
    }
}
