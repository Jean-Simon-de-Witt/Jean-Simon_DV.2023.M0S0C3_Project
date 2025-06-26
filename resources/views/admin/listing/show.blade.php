@extends('layouts.app')

@section('title', 'Show Listing (Admin)')

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
    <p class="page-title">Manage Listing</p>
    <div class="record-container">
        <p class="record-field">ID: {{$listing->id}}</p>
        <p class="record-field">Name: {{$listing->name}}</p>
        <p class="record-field">Description: {{$listing->description}}</p>
        <p class="record-field">Price: {{$listing->price}}</p>
        <p class="record-field">Category: {{$listing->category}}</p>
        <p class="record-field">Image: {{$listing->image}}</p>
        <p class="record-field">User ID: {{$listing->user_id}}</p>
        <p class="record-field">Created At: {{$listing->created_at}}</p>
        <p class="record-field">Updated At: {{$listing->updated_at}}</p>
        <div class="record-actions">
            <a class="record-action" href="{{ route('admin.listing.edit', ['id' => $listing->id]) }}">Edit</a>
            <form action="{{ route('admin.listing.destroy', ['id' => $listing->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="record-action" type="submit">Delete</button>
            </form>
            <a class="record-action" href="{{ route('admin.listings') }}">Back</a>
        </div>
    </div>
@endsection