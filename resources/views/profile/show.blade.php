@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Profile Details
                </div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $profile->user->name }}</p>
                    <p><strong>Email:</strong> {{ $profile->user->email }}</p>
                    <p><strong>Birthday:</strong> {{ $profile->birthday ? $profile->birthday->format('Y-m-d') : 'Not provided' }}</p>
                    <p><strong>About Me:</strong> {{ $profile->about_me }}</p>
                    
                    @if($profile->avatar)
                        <img src="{{ Storage::url($profile->avatar) }}" alt="Avatar" class="img-fluid rounded-circle" style="max-width: 150px;">
                    @endif

                    <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-primary mt-3">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
