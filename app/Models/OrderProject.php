<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProject extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'order_project';

    protected $fillable = [
        'order_id',
        'project_id',
        'quantity_item',
    ];
    

}
