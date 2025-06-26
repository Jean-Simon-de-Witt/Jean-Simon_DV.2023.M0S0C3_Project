@extends('layouts.app')

@section('title', 'Add Stock')

@section('content')
    <h1 class="page-title">Adding Stock for {{ $listing->name }}</h1>
    <div id="form">
        <form method="POST" action="{{ route('listings.stock.add', ['id'=> $listing->id])}}">
            @csrf
            <div>
                <label class="label" for="stock">Number of Stock</label>
                <input class="input" name="stock" id="stock" type="number" value="{{ old('stock')}}" required>
                @error('stock') <p>{{ $message }}</p> @enderror
            </div>
            <div class="horisontal-align" id="buttons-section">
                <button class="button" type="submit">Add</button>
                <button class="button" type="button" onclick="window.location.href='{{ route('user.profile.merchant.show', ['id' => Auth::user()->id])}}'">Cancel</button>
            </div>
        </form>
    </div>
@endsection