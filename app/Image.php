<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function posts()
    {
        return $this->belongsTo('App\Post');
    }
}
