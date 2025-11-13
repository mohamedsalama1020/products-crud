<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, SoftDeletes;
    protected $fillable = ['name', 'category_id'];
    protected array $translatable = ['name'];

    public function category(){

        return $this->belongsTo(Category::class);
    }
}
