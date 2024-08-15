@extends('layouts.app')

@section('content')
<div class="container">
    <h1>News</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('news.create') }}" class="btn btn-primary">Add News</a>

    <div class="row mt-3">
        @foreach ($news as $item)
            <div class="col-md-4">
                <div class="card mb-3">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->content }}</p>
                        <a href="{{ route('news.edit', $item) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('news.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


