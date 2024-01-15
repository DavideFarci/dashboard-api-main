<?php

namespace App\Models;

use App\Models\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Month extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['month', 'n', 'y'];

    // public function date() {
    //     // hasMany si usa sul model della tabella che NON ha la chiave esterna in una relazione uno a molti
    //     // hasOne si usa sul model della tabella che NON ha la chiave esterna in una relazione uno a uno
    //     return $this->hasMany(Date::class);
    // }
}
