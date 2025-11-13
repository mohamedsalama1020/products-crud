<?php

use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories/ajax', function () {
    $categories = Category::all();
    return response()->json($categories->map(function($c){
        return [
            'id' => $c->id,
            'text' => $c->getTranslation('name', app()->getLocale())
        ];
    }));
});

Route::resource('products',ProductController::class);
