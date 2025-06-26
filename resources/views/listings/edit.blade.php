@extends('layouts.app')

@section('title', 'Edit Listing')

@section('content')
    <h1 class="page-title">Edit Listing</h1>
    <div id="form">
        <form method="POST" action="{{ route('listings.edit', ['id' => $listing->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label class="label" for="name">Name</label>
                <input class="input" name="name" id="name" type="text" value="{{ $listing->name }}" required>
                @error('name') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="description">Description</label>
                <textarea class="input" name="description" id="description" required>{{ $listing->description }}</textarea>
                @error('description') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="price">Price</label>
                <input class="input" name="price" id="price" type="number" step="0.01" value="{{ $listing->price }}" required>
                @error('price') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="category">Category</label>
                <input class="input" name="category" id="category" type="text" value="{{ $listing->category }}">
                @error('category') <p>{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label" for="image">Image</label>
                <input class="input" name="image" id="image" type="file" accept="image/*">
                @error('image') <p>{{ $message }}</p> @enderror
            </div>
            <div class="horisontal-align" id="buttons-section">
                <button class="button" type="submit">Submit</button>
                <button class="button" type="button" onclick="window.location.href='{{ route('user.profile.merchant.show', ['id' => Auth::user()->id]) }}'">Cancel</button>
            </div>
        </form>
    </div>
@endsection