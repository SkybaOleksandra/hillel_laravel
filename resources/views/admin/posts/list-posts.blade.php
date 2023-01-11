@extends('admin.layout')

@section('title', 'Posts')

@section('breadcrumbs')
    @include('admin.partials.breadcrumbs',[
        'links'=> [
            [
                'link'=>'/admin',
                'name'=>'Home'
            ],
            [
                'link'=>'',
                'name'=>'Posts'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}" role="button">Create</a>
            <a class="btn btn-danger" href="{{ route('admin.posts.trash') }}" role="button">Trash</a>
        </div>
        <table  class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Body</th>
                <th>User</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th colspan="3">Action</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td><a href="{{ route('admin.posts.show', ['id'=>$post->id]) }}">Show</a></td>
                    <td><a href="{{ route('admin.posts.edit', ['id'=>$post->id]) }}">Update</a></td>
                    <td><a href="{{ route('admin.posts.destroy', ['id'=>$post->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
