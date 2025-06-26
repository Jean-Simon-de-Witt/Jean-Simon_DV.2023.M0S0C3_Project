@extends('layouts.app')

@section('title', $listing->name)

@section('content')
    <div class="show-listing-container">
        <img class="show-listing-image" src="{{ asset('storage/' . $listing->image) }}">
        <p class="show-listing-name">{{ $listing->name }}</p>
        <p class="show-listing-price">{{'R' . $listing->price }}</p>
        <a class="show-listing-merchant" href="{{route('user.profile.merchant.show', ['id' => $merchant->id])}}">@if($merchant->merchant_profile_picture)<img class="show-listing-profile" src="{{asset('storage/' . $merchant->merchant_profile_picture)}}">@else<img class="show-listing-profile" src="{{asset('uploads/profile-grey.svg')}}">@endif {{$merchant->merchant_name}}</a>
        <div class="show-listing-rating">@for($i = 0; $i < 5; $i++) @if($i < $listing->rating) <img class="icon" src="{{asset('uploads/star-rated-bright.svg')}}"> @else <img class="icon" src="{{asset('uploads/star-bright.svg')}}"> @endif @endfor <p class="show-rating-number">({{ $ratings_count }})</p></div>
        <p class="show-listing-category">{{$listing->category}}</p>
        <p class="show-listing-description">{{ $listing->description }}</p>
        @auth
            @if(count($copies) !== 0)
                <form action="{{route('user.cart.add', ['id' => Auth::user()->id, 'copy_id' => $copies->first()])}}" method="POST">
                    @csrf
                    @method('PUT')
                <button class="show-listing-button"type="submit">Add to Cart</button>
                </form>
            @else
                <p class="show-listing-message">Out of stock.</p>
            @endif
            @if($user_rating)
                <p class="review-title">Reviews</p>
            @else
                <p class="review-title">Reviews <a class="edit-link" href="{{route('listings.ratings.create', ['id' => $listing->id])}}"><img class="icon-background" src="{{asset('uploads/add-white.svg')}}"></a></p>
            @endif   
                @forelse($reviews as $review) 
                    <div class="review">
                        <a class="review-author" href="{{ route('user.profile.show', ['id' => $review['author']->id])}}">@if($review['author']->profile_picture)<img class="review-profile" src="{{asset('storage/' . $review['author']->profile_picture)}}">@else<img class="review-profile" src="{{asset('uploads/profile-grey.svg')}}">@endif {{$review['author']->name . ' ' . $review['author']->surname}}</a>
                        <p class="review-score">{{$review['score']}}</p>
                        <p class="review-content">{{$review['review']}}</p>
                    </div>
                @empty
                    <p class="review-content">This product has not received any reviews</p>
                @endforelse
            @endauth
        @guest
            <p class="show-listing-message">You must be logged in to add this item to your cart.</p>
            <p class="review-title">Reviews</p>
            @forelse($reviews as $review) 
                    <div class="review">
                        <a class="review-author" href="{{ route('user.profile.show', ['id' => $review['author']->id])}}">@if($review['author']->profile_picture)<img class="review-profile" src="{{asset('storage/' . $review['author']->profile_picture)}}">@else<img class="review-profile" src="{{asset('uploads/profile-grey.svg')}}">@endif {{$review['author']->name . ' ' . $review['author']->surname}}</a>
                        <p class="review-score">{{$review['score']}}</p>
                        <p class="review-content">{{$review['review']}}</p>
                    </div>
            @empty
                <p class="review-content">This product has not received any reviews</p>
            @endforelse
        @endguest
    </div>
    
@endsection