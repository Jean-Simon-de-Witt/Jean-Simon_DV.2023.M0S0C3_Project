@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    @auth
        <p class="page-title">Cart for {{Auth::user()->name . ' ' .Auth::user()->surname}}</p>
        @forelse($listings as $listing)
            <div class="listing">
                <a class="image-link" href="/listings/{{$listing->id}}"><img class="listing-image" src="{{$listing->image}}"></a>
                <p class="listing-name">{{$listing->name}}</p>
                <p class="listing-price">{{'R' . $listing->price}}</p>
            </div>
        @empty
            <p>You currently have no items in your cart.</p>
        @endforelse
    @endauth
    @guest

    @endguest
@endsection