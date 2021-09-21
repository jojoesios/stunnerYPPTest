<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongLyric extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'artist',
        'lyrics'
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
