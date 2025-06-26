@extends('layouts.app')

@if(!Auth::user())
    @section('title', $user->name . ' ' . $user->surname)
@elseif(Auth::user()->id == $user->id)
    @section('title', 'Profile')
@else
    @section('title', $user->name . ' ' . $user->surname)
@endif

@section('content')
    @if(!Auth::user())
        <h1 class="page-title">{{$user->name . ' ' . $user->surname}}</h1>
        <div class="profile-section">
            @if ($user->profile_picture)
                <img class="profile-image" src="{{asset('storage/' . $user->profile_picture)}}">
            @else
                <img class="profile-image" src="{{asset('uploads/profile.png')}}">
            @endif
        </div>
    @elseif(Auth::user()->id === $user->id)
        <h1 class="page-title">Your Profile <a class="edit-link" href="{{ route('user.profile.edit', ['id' => $user->id])}}"><img class="icon-background" src="{{asset('uploads/edit-white.svg')}}"></a></h1>
        <div class="profile-section">
            @if ($user->profile_picture)
                <img class="profile-image" src="{{asset('storage/' . $user->profile_picture)}}">
            @else
                <img class="profile-image" src="{{asset('uploads/profile.png')}}">
            @endif
            <p class="profile-field">Name: {{$user->name}}</p>
            <p class="profile-field">Surname: {{$user->surname}}</p>
            <a class="profile-button-edit" href="{{route('user.profile.merchant.show', ['id' => $user])}}">Switch to Merchant Profile</a>
        </div>
    @else
        <h1 class="page-title">{{$user->name . ' ' . $user->surname}}</h1>
        <div class="profile-section">
            @if ($user->profile_picture)
                <img class="profile-image" src="{{asset('storage/' . $user->profile_picture)}}">
            @else
                <img class="profile-image" src="{{asset('uploads/profile.png')}}">
            @endif
        </div>
    @endif 
    
     @if(!Auth::user())
                <h1 class="page-title">{{$user->name . ' ' . $user->surname}}'s Reviews</h1>
                <div class="profile-section">
                    @forelse($reviews as $review)
                        <a><div class="review">
                            <p class="review-score">{{ $review->score }}</p>
                            <p class="review-content">{{$review->review ?? 'No Review'}}</p>
                        </div></a>
                    @empty
                        <p class="profile-field">{{$user->name . ' ' . $user->surname}} has not posted any reviews.</p>
                    @endforelse
                </div>
            @elseif (Auth::user()->id === $user->id)
                <h1 class="page-title">Your Reviews</h1>
                <div class="profile-section">
                    @forelse($reviews as $review)
                        <a><div class="review">
                            <p class="review-score">{{ $review->score }}</p>
                            <p class="review-content">{{$review->review ?? 'No Review'}}</p>
                        </div></a>
                    @empty
                        <p class="profile-field">You have not posted any reviews.</p>
                    @endforelse
                </div>
            @else
                <h1 class="page-title">{{$user->name . ' ' . $user->surname}}'s Reviews</h1>
                <div class="profile-section">
                    @forelse($reviews as $review)
                        <a class="review-link" href="{{ route('listings.show', ['id' => $review->listing_id]) }}"><div class="review">
                            <p class="review-score">{{ $review->score }}</p>
                            <p class="review-content">{{$review->review ?? 'No Review'}}</p>
                        </div></a>
                    @empty
                        <p class="profile-field">{{$user->name . ' ' . $user->surname}} has not posted any reviews.</p>
                    @endforelse
                </div>
            @endif
@endsection