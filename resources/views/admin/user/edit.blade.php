@extends('layouts.app')

@section('title', 'Edit User (Admin)')

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
    <p class="page-title">Edit User</p>
    <div class="record-container">
        <form method="POST" action="{{ route('admin.user.edit', ['id' => $user->id]) }}">
            @csrf
            @method('PUT')
            <div>
                <label class="label" for="name">Name</label>
                <input class="input" id="name" name="name" type="text" value="{{ $user->name }}">
                @error('name') <p> {{ $message }} </p> @enderror 
            </div>
            <div>
                <label class="label" for="surname">Surname</label>
                <input class="input" id="surname" name="surname" type="text" value="{{ $user->surname }}">
                @error('surname') <p> {{ $message }} </p> @enderror 
            </div>
            <div class="check-div">
                <label class="check-label" for="merchant">Merchant</label>
                <input class="check-input" id="merchant" name="merchant" type="checkbox" @if($user->merchant) {{'checked'}} @endif value="{{1}}">
                @error('merchant') <p> {{ $message }} </p> @enderror 
            </div>
            <div class="check-div">
                <label class="check-label" for="admin">Admin</label>
                <input class="check-input" id="admin" name="admin" type="checkbox" @if($user->admin) {{'checked'}} @endif value="{{1}}">
                @error('admin') <p> {{ $message }} </p> @enderror 
            </div>
            <div>
                <label class="label" for="merchant_name">Merchant Name</label>
                <input class="input" id="merchant_name" name="merchant_name" type="text" value="{{ $user->merchant_name }}">
                @error('merchant_name') <p> {{ $message }} </p> @enderror 
            </div>
            <div class="record-actions">
                <button class="record-action" type="submit">Submit</button>
                <button class="record-action" type="button" onclick="window.location.href='{{ route('admin.user.show', ['id' => $user->id])}}'">Cancel</button>
            </div>
            
        </form>
    </div>
@endsection