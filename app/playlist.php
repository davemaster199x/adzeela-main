<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class playlist extends Model
{

    protected $fillable = [
        'pl_name',
        'orientation',
        'media_id'
    ];
}
