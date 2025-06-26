@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h1 class="page-title">Register</h1>
    <div id="form">
        <form method="POST" action="{{ route('auth.register')}}">
            @csrf
            <div>
                <label class="label" for="name">Name</label>
                <input class="input" name="name" id="name" type="text" value="{{ old('name')}}" required>
                @error('name') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="surname">Surname</label>
                <input class="input" name="surname" id="surname" type="text" value="{{ old('surname')}}" required>
                @error('surname') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="email">Email</label>
                <input class="input" name="email" id="email" type="text" value="{{ old('email')}}" required>
                @error('email') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="password">Password</label>
                <input class="input" name="password" id="password" type="password">
                @error('password') <p>{{ $message}}</p> @enderror
            </div>
            <div>
                <label class="label" for="password_confirmation">Confirm Password</label>
                <input class="input" name="password_confirmation" id="password_confirmation" type="password">
                @error('password-confirm') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <button class="button" type="submit">Register</button>
                <p class="form-text">Already have an account? <a class="link" href="/auth/login">Login here.</a></p>
            </div>
        </form>
    </div>
@endsection