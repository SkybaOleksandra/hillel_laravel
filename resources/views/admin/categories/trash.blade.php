@extends('admin.layout')

@section('title', 'Categories')

@section('breadcrumbs')
    @include('admin.partials.breadcrumbs',[
        'links'=> [
            [
                'link'=>'/admin',
                'name'=>'Home'
            ],
            [
                'link'=>'/admin/categories/',
                'name'=>'Categories'
            ],
            [
                'link'=>'',
                'name'=>'Trash'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-info" href="{{ route('admin.categories') }}" role="button">List</a>
        </div>
        <table  class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->slug }}</td>
                    <td><a href="{{ route('admin.categories.restore', ['id' =>$category->id]) }}">Restore</a></td>
                    <td><a href="{{ route('admin.categories.delete', ['id' =>$category->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
