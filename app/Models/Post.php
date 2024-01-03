<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hashtag;

class Post extends Model
{
    use HasFactory;
    public function hashtags() {
        return $this->belongsToMany(Hashtag::class);
    }
}
