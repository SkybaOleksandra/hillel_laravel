@extends('admin.layout')

@section('title', 'Tags')

@section('breadcrumbs')
    @include('admin.partials.breadcrumbs',[
        'links'=> [
            [
                'link'=>'/admin',
                'name'=>'Home'
            ],
            [
                'link'=>'',
                'name'=>'Tags'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary" href="{{ route('admin.tags.create') }}" role="button">Create</a>
            <a class="btn btn-danger" href="{{ route('admin.tags.trash') }}" role="button">Trash</a>
        </div>
        <table  class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->title }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td><a href="{{ route('admin.tags.edit', ['id' => $tag->id]) }}">Update</a></td>
                    <td><a href="{{ route('admin.tags.destroy', ['id' => $tag->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
