<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['kode' ,'nama' ,'semester' ,'created_by' ,'updated_by'];
}
