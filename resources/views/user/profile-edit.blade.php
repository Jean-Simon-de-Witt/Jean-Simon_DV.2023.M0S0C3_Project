@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <h1 class="page-title">Editing Profile for {{$user->name}} {{$user->surname}}</h1>
    <div class="profile-section">
        @if ($user->profile_picture)
            <img class="profile-image" src="{{asset('storage/' . $user->profile_picture)}}">
        @else
            <img class="profile-image" src="{{asset('uploads/profile-grey.svg')}}">
        @endif
        <form action="{{ route('user.profile.update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <input type="file" name="profile_picture" accept="image/*">
                @error('profile_picture') <p>{{ $message }}</p> @enderror
            </div>
            <div class="profile-section-edit">
                <label class="profile-label-edit" for="name">Name: </label>
                <input class="profile-field-edit" id="name" name="name" value="{{$user->name}}">
                @error('name') <p>{{ $message }}</p> @enderror
            </div>
            <div class="profile-section-edit">
                <label class="profile-label-edit" for="surname">Surname: </label>
                <input class="profile-field-edit" id="surname" name="surname" value="{{$user->surname}}">
                @error('surname') <p>{{ $message }}</p> @enderror
            </div>
            <div class="profile-section-edit" id="buttons-section">
                <button class="profile-button-edit" type="submit">Submit</button>
                <button class="profile-button-edit" type="button" onclick="window.location.href=' {{ route('user.profile.show', ['id' => $user->id])}} '">Cancel</button>
            </div>
        </form>
    </div>
    
@endsection