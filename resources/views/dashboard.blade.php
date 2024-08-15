@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <p>Here you can manage your profile, view the latest news, and check out FAQs.</p>

    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile</h5>
                <p class="card-text">View and update your profile information.</p>
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-primary">Go to Profile</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Latest News</h5>
                <p class="card-text">Check out the latest news updates.</p>
                <a href="{{ route('news.index') }}" class="btn btn-primary">View News</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">FAQs</h5>
                <p class="card-text">Browse through the frequently asked questions.</p>
                <a href="{{ route('faq.index') }}" class="btn btn-primary">View FAQs</a>
            </div>
        </div>
    </div>
</div>
@endsection
