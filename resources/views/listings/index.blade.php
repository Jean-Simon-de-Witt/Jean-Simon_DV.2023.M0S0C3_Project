@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="sorting-container">
        <div class="sorting-menu-button">
            <img class="icon" src="{{ asset('uploads/menu-white.svg')}}">
        </div>
        <form method="GET" action="{{route('listings.index')}}">
            @csrf
            <div class="sorting-menu">
                <div class="sorting-section">
                    <label class="sorting-label" for="sort1">Sort 1</label>
                    <select class="sorting-field" name="sort1" id="sort1">
                        <option value=""></option>
                        <option value="name" {{$oldValues['sort1'] === 'name' ? 'selected' : ''}}>Name</option>
                        <option value="date" {{$oldValues['sort1'] === 'date' ? 'selected' : ''}}>Date</option>
                        <option value="rating" {{$oldValues['sort1'] === 'rating' ? 'selected' : ''}}>Rating</option>
                        <option value="price" {{$oldValues['sort1'] === 'price' ? 'selected' : ''}}>Price</option>
                    </select>
                    <select class="sorting-field" name="order1" id="order1">
                        <option value="asc" {{$oldValues['order1'] === 'asc' ? 'selected' : ''}}>Ascending</option>
                        <option value="desc" {{$oldValues['order1'] === 'desc' ? 'selected' : ''}}>Descending</option>
                    </select>
                </div>
                <div class="sorting-section">
                    <label class="sorting-label" for="sort2">Sort 2</label>
                    <select class="sorting-field" name="sort2" id="sort2">
                        <option value=""></option>
                        <option value="name" {{$oldValues['sort2'] === 'name' ? 'selected' : ''}}>Name</option>
                        <option value="date" {{$oldValues['sort2'] === 'date' ? 'selected' : ''}}>Date</option>
                        <option value="rating" {{$oldValues['sort2'] === 'rating' ? 'selected' : ''}}>Rating</option>
                        <option value="price" {{$oldValues['sort2'] === 'price' ? 'selected' : ''}}>Price</option>
                    </select>
                    <select class="sorting-field" name="order2" id="order2">
                        <option value="asc" {{$oldValues['order2'] === 'asc' ? 'selected' : ''}}>Ascending</option>
                        <option value="desc" {{$oldValues['order2'] === 'desc' ? 'selected' : ''}}>Descending</option>
                    </select>
                </div>
                <div class="sorting-section">
                    <label class="sorting-label" for="sort3">Sort 3</label>
                    <select class="sorting-field" name="sort3" id="sort1">
                        <option value=""></option>
                        <option value="name" {{$oldValues['sort3'] === 'name' ? 'selected' : ''}}>Name</option>
                        <option value="date" {{$oldValues['sort3'] === 'date' ? 'selected' : ''}}>Date</option>
                        <option value="rating" {{$oldValues['sort3'] === 'rating' ? 'selected' : ''}}>Rating</option>
                        <option value="price" {{$oldValues['sort3'] === 'price' ? 'selected' : ''}}>Price</option>
                    </select>
                    <select class="sorting-field" name="order3" id="order3">
                        <option value="asc" {{$oldValues['order3'] === 'asc' ? 'selected' : ''}}>Ascending</option>
                        <option value="desc" {{$oldValues['order3'] === 'desc' ? 'selected' : ''}}>Descending</option>
                    </select>
                </div>
                <div class="sorting-section">
                    <button class="sorting-button" type="submit">Apply</button>
                </div>
            </div>
            @if(!empty($oldValues['search']))
                <input type="hidden" name="search" id="search" value="{{$oldValues['search']}}">
            @endif
        </form>
    </div>
    <p class="page-title">@if(!empty($title)){{ $title }} @else Recent Listings @endif </p>
    <div id="listings">
        @forelse($listings as $listing)
            <div class="listing">
                <a class="image-link" href="/listings/{{$listing->id}}"><img class="listing-image"src="{{$listing->image}}"></a>
                <p class="listing-name">{{$listing->name}}</p>
                <p class="listing-price">{{'R' . $listing->price}}</p>
                <div class="listing-rating">@for($i = 0; $i < 5; $i++) @if($i < $listing->rating) <img class="icon" src="{{asset('uploads/star-rated-bright.svg')}}"> @else <img class="icon" src="{{asset('uploads/star-bright.svg')}}"> @endif @endfor</div>
            </div>
        @empty
            <p class="listing-name">No listings</p>
        @endforelse
    </div>
@endsection