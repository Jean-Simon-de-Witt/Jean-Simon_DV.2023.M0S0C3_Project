@extends('layouts.app')

@section('title', 'Edit Listing (Admin)')

@section('content')
    <div class="sorting-container">
        <div class="sorting-menu-button">
            <img class="icon" src="{{ asset('uploads/menu-white.svg')}}">
        </div>
        <div class="sorting-menu">
            <a @if($view === 'admin.users') id="sorting-link-active" @endif class="sorting-link" href="{{ route('admin.users')}} ">Users</a>
            <a @if($view === 'admin.listings') id="sorting-link-active" @endif class="sorting-link" href="{{ route('admin.listings')}} ">Listings</a>
        </div>
    </div>
    <p class="page-title">Edit Listing</p>
    <div class="record-container">
        <form method="POST" action="{{ route('admin.listing.edit', ['id' => $listing->id]) }}">
            @csrf
            @method('PUT')
            <div>
                <label class="label" for="name">Name</label>
                <input class="input" id="name" name="name" type="text" value="{{ $listing->name }}">
                @error('name') <p> {{ $message }} </p> @enderror 
            </div>
            <div>
                <label class="label" for="description">Description</label>
                <textarea class="input" id="description" name="description">{{ $listing->description }}</textarea>
                @error('description') <p> {{ $message }} </p> @enderror 
            </div>
            <div>
                <label class="label" for="price">Price</label>
                <input class="input" id="price" name="price" type="number" step="0.01" value="{{ $listing->price }}">
                @error('description') <p> {{ $message }} </p> @enderror 
            </div>
            <div>
                <label class="label" for="category">Category</label>
                <input class="input" id="category" name="category" type="text" value="{{ $listing->category }}">
                @error('category') <p> {{ $message }} </p> @enderror 
            </div>
            <div>
                <label class="label" for="user_id">User ID</label>
                <input class="input" id="user_id" name="user_id" type="number" value="{{ $listing->user_id }}">
                @error('user_id') <p> {{ $message }} </p> @enderror 
            </div>
            <div class="record-actions">
                <button class="record-action" type="submit">Submit</button>
                <button class="record-action" type="button" onclick="window.location.href='{{ route('admin.listing.show', ['id' => $listing->id])}}'">Cancel</button>
            </div>
            
        </form>
    </div>
@endsection