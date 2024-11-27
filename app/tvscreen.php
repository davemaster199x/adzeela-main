<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tvscreen extends Model
{
   
    protected $fillable = [
        'title',
        'size',
        'playlist_name',
        'tvscreen_loc'
    ];
}
