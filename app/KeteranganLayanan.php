<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeteranganLayanan extends Model
{
	protected $fillable = [
		'keterangan',  'created_by',  'updated_by',      
	];
}
