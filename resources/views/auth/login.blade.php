@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1 class="page-title">Login</h1>
    <div id="form">
        <form method="POST" action="{{ route('auth.login')}}">
            @csrf
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
                <button class="button" type="submit">Login</button>
                <p class="form-text">Don't have an account? <a class="link" href="/auth/register">Register here.</a></p>
            </div>
        </form>
    </div>
@endsection