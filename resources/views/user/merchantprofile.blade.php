@extends('layouts.app')

@if($user->merchant)
    @if(!Auth::user())
        @section('title', $user->merchant_name)
    @elseif(Auth::user()->id === $user->id)
        @section('title', 'Merchant Profile')
    @else
        @section('title', $user->merchant_name)
    @endif
@else
    @if(!Auth::user())
        @section('title', 'Unassigned Profile')
    @elseif(Auth::user()->id === $user->id)
        @section('title', 'Merchant Profile')
    @else
        @section('title', 'Unassigned Profile')
    @endif
@endif

@section('content')
    @if($user->merchant)
        
            @if(!Auth::user())
                <h1 class="page-title">{{$user->merchant_name}}</h1>
                <div class="profile-section">
                    @if ($user->merchant_profile_picture)
                        <img class="profile-image" src="{{asset('storage/' . $user->merchant_profile_picture)}}">
                    @else
                        <img class="profile-image" src="{{asset('uploads/profile-grey.svg')}}">
                    @endif
                </div>
            @elseif(Auth::user()->id === $user->id)
                <h1 class="page-title">Your Merchant Profile <a class="edit-link" href="{{ route('user.profile.merchant.edit', ['id' => $user->id])}}"><img class="icon-background" src="{{asset('uploads/edit-white.svg')}}"></a></h1>
                <div class="profile-section">
                    @if ($user->merchant_profile_picture)
                        <img class="profile-image" src="{{asset('storage/' . $user->merchant_profile_picture)}}">
                    @else
                        <img class="profile-image" src="{{asset('uploads/profile-grey.svg')}}">
                    @endif
                    <p class="profile-field">Merchant Name: {{$user->merchant_name}}</p>
                    <a class="profile-button-edit" href="{{route('user.profile.show', ['id' => $user])}}">Switch to Personal Profile</a>
                </div>
            @else
                <h1 class="page-title">{{$user->merchant_name}}</h1>
                <div class="profile-section">
                    @if ($user->merchant_profile_picture)
                        <img class="profile-image" src="{{asset('storage/' . $user->merchant_profile_picture)}}">
                    @else
                        <img class="profile-image" src="{{asset('uploads/profile-grey.svg')}}">
                    @endif
                </div>
            @endif

            @if(!Auth::user())
                <h1 class="page-title">Products sold by {{$user->merchant_name}}</h1>
                <div id="listings">
                    @forelse($listings as $listing)
                        <div class="listing">
                            <a class="image-link" href="/listings/{{$listing->id}}"><img class="listing-image" src="{{ asset('storage/' . $listing->image)}}"></a>
                            <p class="listing-name">{{$listing->name}}</p>
                            <p class="listing-price">{{'R' . $listing->price}}</p>
                        </div>
                    @empty
                        <p class="profile-field">{{$user->merchant_name}} currently has no products listed.</p>
                    @endforelse
                </div>
            @elseif (Auth::user()->id === $user->id)
                <h1 class="page-title">Your Products <a class="edit-link" href="{{ route('listings.create')}}"><img class="icon-background" src="{{asset('uploads/add-white.svg')}}"></a></h1>
                <div id="listings">
                    @forelse($listings as $listing)
                        <div class="listing" data-id="{{ $listing->id }}">
                            <a class="image-link" href="/listings/{{$listing->id}}"><img class="listing-image" src="{{asset('storage/' . $listing->image)}}"></a>
                            <p class="listing-name">{{$listing->name}}</p>
                            <p class="listing-price">{{'R' . $listing->price}}</p>

                            <div class="edit-commands">
                                <a class="edit-link" href="{{ route('listings.stock.add', ['id'=> $listing->id])}}"><img class="icon-background" src="{{ asset('uploads/stock-add-white.svg')}}"></a>
                                <a class="edit-link" href="{{ route('listings.edit', ['id'=> $listing->id])}}"><img class="icon-background" src="{{ asset('uploads/edit-white.svg')}}"></a>
                                <a class="edit-link delete-link"><img class="icon-background" src="{{ asset('uploads/delete-white.svg')}}"></a>
                            </div>
                        </div>
                    @empty
                        <p class="profile-field">You currently do not have any products listed.</p>
                    @endforelse
                    <div id="alert-container"></div>
                </div>
            @else
                <h1 class="page-title">Products sold by {{$user->merchant_name}}</h1>
                <div id="listings">
                    @forelse($listings as $listing)
                        <div class="listing">
                            <a class="image-link" href="/listings/{{$listing->id}}"><img class="listing-image" src="{{ asset('storage/' . $listing->image)}}"></a>
                            <p class="listing-name">{{$listing->name}}</p>
                            <p class="listing-price">{{'R' . $listing->price}}</p>
                        </div>
                    @empty
                        <p class="profile-field">{{$user->merchant_name}} currently has no products listed.</p>
                    @endforelse
                </div>
            @endif
    @else
        @if(!Auth::user())
            <h1 class="page-title">Unassigned Profile</h1>
            <div class="profile-section">
                <p class="profile-field">This user doesn't have a merchant profile</p>
            </div>
        @elseif(Auth::user()->id === $user->id)
            <h1 class="page-title">Your Merchant Profile</h1>
            <div class="profile-section">
                <p class="profile-field">You don't have a merchant profile.</p>
                <p class="profile-field">Create one <a class="link" href="{{route('user.profile.merchant.create', ['id' => $user->id])}}">here</a>.</p>
                <a class="profile-button-edit" href="{{route('user.profile.show', ['id' => $user])}}">Switch to Personal Profile</a>
            </div>
        @else
            <h1 class="page-title">Unassigned Profile</h1>
            <div class="profile-section">
                <p class="profile-field">This user doesn't have a merchant profile</p>
            </div>
        @endif
    @endif
@endsection