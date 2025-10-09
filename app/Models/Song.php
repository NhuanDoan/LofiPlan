<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title','artist','file_path','cover_path','duration','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
