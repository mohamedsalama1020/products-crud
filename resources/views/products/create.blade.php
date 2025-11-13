@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach 
            </ul>
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
            </select>
        </div>
        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
            @foreach (config('locales') as $locale => $label)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $locale }}-tap" data-bs-toggle="tab" href="#{{ $locale }}" role="tab">{{ $label }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
             @foreach (config('locales') as $locale => $label)
                <div class="tab-pane fade {{ $loop->first ? 'active' : ''}}" id="{{ $locale }}" role="tabpanel">
                    <label for="name_{{ $locale }}">Product Name ({{$label}})</label>
                    <input type="text" name="name[{{ $locale }}]" id="name_{{ $locale }}" class="form-control" value="{{ old('name.'.$locale ) }}">
                </div>
            @endforeach    
        </div>
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#category_id').select2({
        placeholder: 'Select a category',
        ajax: {
            url: '/categories/ajax',  
            dataType: 'json',
            processResults: function(data) {
                return {
                    results: data
                };
            }
        }
    });

    @if(isset($product))
        var categoryOption = new Option(
            '{{ $product->category->getTranslation("name", app()->getLocale()) }}',
            '{{ $product->category_id }}',
            true,
            true
        );
        $('#category_id').append(categoryOption).trigger('change');
    @endif
});
</script>
@endpush


