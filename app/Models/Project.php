<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function getRouteKey()
    {
        return $this->slug;
    }

    public $timestamps = false;
    //protected $fillable = ['nome', 'link', 'link_github', 'url_image', 'url_gif', 'description'];

    public function category() {
        // belongsTo si usa nel model della tabella che ha la chiave esterna, di conseguenza quella che sta dalla parte del molti
        return $this->belongsTo(Category::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    
    public static function slugger($string) {
    
        // generare lo slug base
        $baseSlug = Str::slug($string); // ciao-a-tutti
        $i = 1;
    
        $slug = $baseSlug;
        // finchè lo slug generato è presente nella tabella
        while (self::where('slug', $slug)->first()) {
            // genera un nuovo slug concatenando il contatore
            $slug = $baseSlug . '-' . $i; // ciao-a-tutti-1
            // incrementa il contatore
            $i++; // 2
        }
    
        // ritornare lo slug trovato
        return $slug;
    }

    public function orders()
    {
        return $this->belongsToMany('Order');
    }
}
