@extends('admin.layout')

@section('title', 'Edit post')

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
                'name'=>'Update'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        <form method="post" action="{{ route('admin.posts.update', ['id'=>$post->id]) }}">
            @csrf
            <div class="row mb-3">
                <label for="id" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="id" name="id" value="{{ $post->id }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label" >Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                    @if($errors->has('title'))
                        @foreach($errors->get('title') as $error)
                            <div class="alert alert-danger mt-3 h-25 pb-0 d-flex justify-content-center align-items-center" role="alert">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $post->slug }}">
                    @if($errors->has('slug'))
                        @foreach($errors->get('slug') as $error)
                            <div class="alert alert-danger mt-3 h-25 pb-0 d-flex justify-content-center align-items-center" role="alert">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="body" class="col-sm-2 col-form-label">Body</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="body" name="body" value="{{ $post->body }}">
                    @if($errors->has('body'))
                        @foreach($errors->get('body') as $error)
                            <div class="alert alert-danger mt-3 h-25 pb-0 d-flex justify-content-center align-items-center" role="alert">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="users" class="col-sm-2 col-form-label" >User</label>
                <div class="col-sm-6">
                    <select name="user_id" id="users">
                        @foreach($users as $user)
                            <option @if($user->id == $post->user_id) selected @endif value="{{ $user->id }}" >{{$user->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('users'))
                        @foreach($errors->get('users') as $error)
                            <div class="alert alert-danger mt-3 h-25 pb-0 d-flex justify-content-center align-items-center" role="alert">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="categories" class="col-sm-2 col-form-label" >Category</label>
                <div class="col-sm-6">
                    <select name="category_id" id="categories">
                        @foreach($categories as $category)
                            <option @if($category->id == $post->category_id) selected @endif value="{{ $category->id }}" >{{$category->title}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('categories'))
                        @foreach($errors->get('categories') as $error)
                            <div class="alert alert-danger mt-3 h-25 pb-0 d-flex justify-content-center align-items-center" role="alert">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="tags" class="col-sm-2 col-form-label" >Tags</label>
                <div class="col-sm-6">
                    <select name="tags[]" id="tags" multiple>
                        @foreach($tags as $tag)
                            <option @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) selected @endif value="{{ $tag->id }}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('tags'))
                        @foreach($errors->get('tags') as $error)
                            <div class="alert alert-danger mt-3 h-25 pb-0 d-flex justify-content-center align-items-center" role="alert">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
            <div class="row mb-3">
                <button type="submit" class="btn btn-primary col-sm-2 ">Update</button>
            </div>
        </form>
    </div>
@endsection
