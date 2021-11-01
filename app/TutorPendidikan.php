<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorPendidikan extends Model
{
    protected $fillable = [ 'tutor_id', 'bidang_studi', 'kode_pt', 'nama_pt', 'akreditasi', 'kode_pendidikan_akhir', 'nama_pendidikan_akhir', 'tahun_lulus', 'gelar', 'created_by', 'updated_by' ];

}
