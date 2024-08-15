@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $news->title }}</h1>
    <p>{{ $news->content }}</p>
    @if($news->cover_image)
        <img src="/images/{{ $news->cover_image }}" alt="Cover Image">
    @endif
    <p>Published on: {{ $news->published_at }}</p>
</div>
@endsection
