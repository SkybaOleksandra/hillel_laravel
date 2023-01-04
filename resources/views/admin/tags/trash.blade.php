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
                'link'=>'/admin/tags/',
                'name'=>'Tags'
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
            <a class="btn btn-info" href="{{ route('admin.tags') }}" role="button">List</a>
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
                    <td><a href="{{ route('admin.tags.restore', ['id' =>$tag->id]) }}">Restore</a></td>
                    <td><a href="{{ route('admin.tags.delete', ['id' =>$tag->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
