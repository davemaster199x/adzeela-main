<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';

    protected $guarded = [];

    public function medias()
    {
        return $this->hasMany(Media::class);
    }
}
