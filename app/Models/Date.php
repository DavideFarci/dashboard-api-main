<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Date extends Model
{
    use HasFactory;

    protected $fillable = ['reserved', 'year', 'month', 'day', 'day_w', 'time', 'visible', 'max_res'];
    public $timestamps = false;
}
