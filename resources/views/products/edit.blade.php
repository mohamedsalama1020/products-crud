@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </div>
    @endif
    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $c)
                <option value="{{ $c->id }}" {{ old('category_id')== $c->id ? 'selected' : ''}}>
                    {{ $c->getTranslation('name',app()->getLocale()) }}
                </option>
            
            @endforeach
            </select>
        </div>
        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="en-tab" data-bs-toggle="tab" href="#en" role="tab">English</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ar-tab" data-bs-toggle="tab" href="#ar" role="tab">Arabic</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="en" role="tabpanel">
                <label for="name_en">Product Name (EN)</label>
                <input type="text" name="name[en]" id="name_en" class="form-control" value="{{ old('name.en',$product->getTranslation('name','en')) }}">
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show " id="ar" role="tabpanel">
                <label for="name_ar">Product Name (AR)</label>
                <input type="text" name="name[ar]" id="name_ar" class="form-control" value="{{ old('name.ar',$product->getTranslation('name','ar')) }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

@endsection