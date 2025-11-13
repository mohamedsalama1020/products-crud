@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Products</h1>

    <div class="mb-3">
        <select id="filterByCategory" class="form-select" style="width: 200px;">
            <option value="">Categories</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->getTranslation('name',app()->getLocale()) }}</option>
            @endforeach
        </select>
    </div>
    <table class="table table-bordered" id="productsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
        var table = $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url:"{{ route('products.index') }}",
                data:function(d){
                    d.category_id = $('#filterByCategory').val();
                }
            },
            columns: [
                {data: 'id', name:'id'},
                {data: 'name', name:'name'},
                {data: 'category', name:'category'},
                {data: 'actions', name:'actions',orderable: false, searchable: false},
            ]
        });
        $('#filterByCategory').change(function() {
            table.ajax.reload();
        });

        $('#productsTable').on('click', '.delete-btn', function() {
        if(confirm('Are you sure you want to delete this product?')) {
            let id = $(this).data('id');
            $.ajax({
                url: '/products/' + id,
                type: 'DELETE',
                data: {_token: '{{ csrf_token() }}'},
                success: function(msg) {
                    if(msg.success) {
                        table.ajax.reload();
                    } else {
                        alert('Error deleting product.');
                    }
                },
                error: function(msg) {
                    console.log(msg.responseText);
                    alert('Error deleting product.');
                }
            });
        }
    });
});
    

</script>
@endpush


