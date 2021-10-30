<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefFakultas extends Model
{
    protected $fillable = ['kode_fakultas','name','jenjang','created_by','updated_by'];
}
