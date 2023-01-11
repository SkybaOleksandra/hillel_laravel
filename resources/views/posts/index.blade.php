@extends('admin.layout')

@section('title', 'Posts')

@section('breadcrumbs')
    @include('admin.partials.breadcrumbs',[
        'links'=> [
            [
                'link'=>'/',
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
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Body</th>
                <th>Category</th>
                <th>User</th>
                <th>Tags</th>
                <th>Updated_at</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->body }}</td>
                    <td><a href="/category/{{ $post->category->id }}">{{ $post->category->title }}</a></td>
                    <td><a href="/author/{{ $post->user->id }}">{{ $post->user->name }}</a></td>
                    <td>
                        @foreach($post->tags->pluck('id') as $item)
                            <a href="/tag/{{ $item }}"> {{ $post->tags->where('id', $item)->pluck('title')->join('')}}</a>
                        @endforeach
                    </td>
                    <td>{{ $post->updated_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection


