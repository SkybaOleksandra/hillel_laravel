@extends('layout')

@section('title', 'Author')

@section('breadcrumbs')
    @include('partials.breadcrumbs',[
        'links'=> [
            [
                'link'=>'/../../',
                'name'=>'Home'
            ],
            [
                'link'=>'/../',
                'name'=>'Categories'
            ],
            [
                'link'=>'/',
                'name'=>'Show'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        <h3>Posts with "{{ $category->title }}"</h3>
        <table  class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Body</th>
                <th>User</th>
                <th>Updated_at</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->body }}</td>
                    <td><a href="/author/{{ $post->user->id }}">{{ $post->user->name }}</a></td>
                    <td>{{ $post->updated_at }}</td>

                </tr>
            @endforeach
        </table>
    </div>
@endsection
