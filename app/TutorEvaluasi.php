<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorEvaluasi extends Model
{
    protected $fillable = [ 'tutor_id', 'nip', 'nilai', 'file', 'created_by'];
}
