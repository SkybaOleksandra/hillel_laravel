@extends('admin.layout')

@section('title', 'Read post')

@section('breadcrumbs')
    @include('admin.partials.breadcrumbs',[
        'links'=> [
            [
                'link'=>'/admin',
                'name'=>'Home'
            ],
            [
                'link'=>'/admin/posts/',
                'name'=>'Posts'
            ],
            [
                'link'=>'',
                'name'=>'Show'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $post->title }}</h3>
                    <h5 class="card-subtitle mb-2 text-muted">{{$post->user->name}}</h5>
                    <p class="card-subtitle mb-2 text-muted">created at {{$post->created_at}}</p>
                    <p class="card-text">{{$post->slug}}</p>
                    <br>
                    <p class="card-text">{{$post->body}}</p>
                    <div>
                        <span>Tags: </span>
                        @foreach($post->tags as $tag)
                            <span class="badge bg-secondary">{{$tag->title}}</span>
                        @endforeach
                    </div>
                    <br>
                    <div>
                        <span>Category: </span>
                        <span class="badge bg-primary">{{ $post->category->title }}</span>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    Comments
                </div>
                <div class="card-body">
                    <div>
                        @foreach($post->comments as $comment)
                            <p class="card-text">{{$comment->body}}</p>
                        @endforeach
                        <br>
                    </div>
                    <div>
                        <form method="post" action="{{route('admin.posts.comment.add', ['id'=>$post->id])}}">
                            @csrf
                            <div class="form-floating ">
                                <textarea class="form-control" id="comment" style="height: 80px" name="body"></textarea>
                                <label for="comment">Comment</label>
                                <br>
                                <button type="submit" class="btn btn-primary col-sm-2 ">Create</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
