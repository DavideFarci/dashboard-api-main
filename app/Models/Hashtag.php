<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hashtag extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
