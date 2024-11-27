<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $table = 'medias';

    protected $guarded = [];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
