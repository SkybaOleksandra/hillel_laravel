@extends('admin.layout')

@section('title', 'Home page')

@extends('admin.partials.logout')

@section('content')
    @include('admin.list', [
    'links' => [
        [
            'link'=>'/admin/categories/',
            'name'=>'Categories'
        ],
        [
            'link'=>'/admin/posts/',
            'name'=>'Posts'
        ],
        [
            'link'=>'/admin/tags/',
            'name'=>'Tags'
        ],
        [
            'link'=>'/admin/author/',
            'name'=>'Author'
        ]
]
])
@endsection
