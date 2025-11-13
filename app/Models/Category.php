<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pest\Support\Arr;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations,HasFactory ;
    protected $fillable = ['name'];
    protected array $translatable = ['name'];

    public function products(){

        return $this->hasMany(Product::class);
    }


}

