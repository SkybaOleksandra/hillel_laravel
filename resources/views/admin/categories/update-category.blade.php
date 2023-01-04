@extends('admin.layout')

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
                'name'=>'Update'
            ]
]
    ])
@endsection

@section('content')
    <div class="container mt-10">
        <form method="post" action="{{ route('admin.categories.update', ['id' =>$category->id]) }}">
            @csrf
            <div class="row mb-3">
                <label for="id" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="id" name="id" value="{{ $category->id }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label" >Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}">
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
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}">
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
                <button type="submit" class="btn btn-primary col-sm-2 ">Update</button>
            </div>
        </form>
    </div>
@endsection
