
@extends('layout')

@section('content')

    <h1>contenido del blog</h1>

    @foreach($posts as $post)
        <li>
            <a href="{{ route('blog.show', $post->slug)  }}" > 
             {{ $post->title }}
            </a>
        </li>
    @endforeach

@endsection