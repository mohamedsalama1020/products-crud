<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        foreach(range(1,500) as $i ){
            Product::create([
                'name'=>['en'=>"Product $i" ,'ar'=>"منتج $i"],
                'category_id'=>$categories->random()->id
            ]);

        }

    }
}
