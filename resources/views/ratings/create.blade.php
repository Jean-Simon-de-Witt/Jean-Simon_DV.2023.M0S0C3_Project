@extends('layouts.app')

@section('title', 'Rate Product')

@section('content')
    <h1 class="page-title">Create a rating for {{$listing->name}}</h1>
    <div id="form">
        <form method="POST" action="{{ route('listings.ratings.store', ['id' => $listing->id])}}">
            @csrf
            <div>
                <label class="label" for="rating">Rating (1-5)</label>
                <input class="input" name="rating" id="rating" type="numeric" value="{{ old('rating')}}" required>
                @error('rating') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="review">Review</label>
                <textarea class="input" name="review" id="review">{{old('review')}}</textarea>
                @error('review') <p>{{ $message}}</p> @enderror
            </div>
            <div class="horisontal-align" id="buttons-section">
                <button class="button" type="submit">Submit</button>
                <button class="button" type="button" onclick="window.location.href='{{ route('listings.show', ['id' => $listing->id])}}'">Cancel</button>
            </div>
        </form>
    </div>
@endsection