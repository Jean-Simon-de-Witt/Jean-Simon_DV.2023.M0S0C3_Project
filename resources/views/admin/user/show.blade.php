@extends('layouts.app')

@section('title', 'Show User (Admin)')

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
    <p class="page-title">Manage User</p>
    <div class="record-container">
        <p class="record-field">ID: {{$user->id}}</p>
        <p class="record-field">Name: {{$user->name}}</p>
        <p class="record-field">Surname: {{$user->surname}}</p>
        <p class="record-field">Email: {{$user->email}}</p>
        <p class="record-field">Password: {{$user->password}}</p>
        <p class="record-field">Merchant: {{$user->merchant}}</p>
        <p class="record-field">Admin: {{$user->admin}}</p>
        <p class="record-field">Profile Picture: {{$user->profile_picture}}</p>
        <p class="record-field">Merchant Name: {{$user->merchant_name}}</p>
        <p class="record-field">Merchant Profile Picture: {{$user->merchant_profile_picture}}</p>
        <p class="record-field">Created At: {{$user->created_at}}</p>
        <p class="record-field">Updated At: {{$user->updated_at}}</p>
        <div class="record-actions">
            <a class="record-action" href="{{ route('admin.user.edit', ['id' => $user->id]) }}">Edit</a>
            <form action="{{ route('admin.user.destroy', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="record-action" type="submit">Delete</button>
            </form>
            <a class="record-action" href="{{ route('admin.users') }}">Back</a>
        </div>
    </div>
@endsection