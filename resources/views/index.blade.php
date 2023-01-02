@extends('layout')

@section('title', 'Home page')

@section('content')
    @include('list', [
    'links' => [
        [
            'link'=>'categories/',
            'name'=>'Categories'
        ],
        [
            'link'=>'posts/',
            'name'=>'Posts'
        ],
        [
            'link'=>'tags/',
            'name'=>'Tags'
        ],
        [
            'link'=>'author/',
            'name'=>'Author'
        ]
]
])
@endsection
