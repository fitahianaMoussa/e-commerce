<?php

namespace App\Models;

use App\Models\Product;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;

class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    
    protected $fillable = ['name','slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getSlugOptions() : SlugOptions 
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
