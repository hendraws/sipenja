<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalTanggalPelaksana extends Model
{
     protected $fillable =['jadwal_id','tanggal_mulai','tanggal_selesai','created_by','updated_by'];
}
