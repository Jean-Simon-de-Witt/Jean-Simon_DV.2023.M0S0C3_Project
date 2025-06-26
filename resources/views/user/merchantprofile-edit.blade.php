@extends('layouts.app')

@section('title', 'Edit Merchant Profile')

@section('content')
    <h1 class="page-title">Editing Merchant Profile for {{$user->name}} {{$user->surname}}</h1>
    <div class="profile-section">
        @if ($user->merchant_profile_picture)
        <img class="profile-image" src="{{asset('storage/' . $user->merchant_profile_picture)}}">
    @else
        <img class="profile-image" src="{{asset('uploads/profile.png')}}">
    @endif
    <form action="{{ route('user.profile.merchant.update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <input type="file" name="merchant_profile_picture" accept="image/*">
            @error('profile_picture') <p>{{ $message }}</p> @enderror
        </div>
        <div class="profile-section-edit">
            <label class="profile-label-edit" for="merchant_name">Merchant Name: </label>
            <input class="profile-field-edit" id="merchant_name" name="merchant_name" value="{{$user->merchant_name}}">
            @error('merchant_name') <p>{{ $message }}</p> @enderror
        </div>
        <div class="profile-section-edit" id="buttons-section">
            <button class="profile-button-edit" type="submit">Submit changes</button>
            <button class="profile-button-edit" type="button" onclick="window.location.href=' {{ route('user.profile.merchant.show', ['id' => $user->id])}} '">Cancel</button>
        </div>
    </form>
    </div>
@endsection