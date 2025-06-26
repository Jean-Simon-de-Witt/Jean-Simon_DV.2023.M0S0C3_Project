@extends('layouts.app')

@section('title', 'Create Merchant Profile')

@section('content')
    <div id="form">
        <form method="POST" action="{{ route('user.profile.merchant.create', ['id' => $user->id])}}">
            @csrf
            @method('PUT')
            <div>
                <label class="label" for="merchant_name">Merchant Name</label>
                <input class="input" name="merchant_name" id="merchant_name" type="text" value="{{ old('merchant_name')}}" required>
                @error('merchant_name') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <button class="button" type="submit">Create Merchant Profile</button>
            </div>
        </form>
    </div>
@endsection