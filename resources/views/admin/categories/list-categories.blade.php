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
                'link'=>'',
                'name'=>'Categories'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        @isset($messageError)
            <div class="container alert alert-danger mt-10 pb-0 d-flex justify-content-center align-items-center" role="alert">
                <p>The category can't be deleted. It has posts, delete the posts or change their categories</p>
            </div>
        @endisset
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary" href="{{ route('admin.categories.create') }}" role="button">Create</a>
            <a class="btn btn-danger" href="{{ route('admin.categories.trash') }}" role="button">Trash</a>
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
                    <td><a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">Update</a></td>
                    <td><a href="{{ route('admin.categories.destroy', ['id' => $category->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection