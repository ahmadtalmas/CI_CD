<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    //add new field to table

    protected $appends = ['photo_url'];

    public function user()
    {
        //relation reference
        return $this->belongsTo('App\Models\User', 'id');
    }
    public function getPhotoUrlAttribute()
    {
        //asset for get url
        return asset('storage/' . $this->attributes['photo']);
    }
}
