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
                'link'=>'/admin/posts',
                'name'=>'Posts'
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
            <a class="btn btn-info" href="{{ route('admin.posts.trash') }}" role="button">List</a>
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
                <th colspan="2">Action</th>
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
                    <td><a href="{{ route('admin.posts.restore', ['id'=>$post->id]) }}">Restore</a></td>
                    <td><a href="{{ route('admin.posts.delete', ['id'=>$post->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
