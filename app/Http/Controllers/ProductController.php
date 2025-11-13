<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use LaravelLang\Publisher\Console\Update;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $query = Product::with('category');

            if($request->category_id){
                $query->where('category_id',$request->category_id);
            }
            return DataTables::of($query)
                ->editColumn('name',fn($p) => $p->getTranslation('name',app()->getLocale()))
                ->addColumn('category',fn($p) => $p->category?->getTranslation('name',app()->getLocale()))
                ->addColumn('actions',function($p){
                    return view('products.partials.actions',compact('p'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        $categories = Category::all();
        return view('products.index',compact('categories'));
    }

    public function create(){
        $categories = Category::all();
        return view('products.create',compact('categories'));
    }

    public function store(ProductRequest $request){
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success','Product created.');

    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('products.edit',compact('product','categories'));
    }

    public function update(ProductRequest $request, Product $product){
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success','Product updated.');

    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json(['success'=>true]);
    }

}
