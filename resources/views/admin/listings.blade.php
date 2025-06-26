@extends('layouts.app')

@section('title', 'Manage Listings (Admin)')

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

    <p class="page-title">Manage Listings</p>
    @if(!empty($listings))
        <table>
            <tr>
                <th class="table-heading">ID</th>
                <th class="table-heading">Name</th>
                <th class="table-heading">Description</th>
                <th class="table-heading">Price</th>
                <th class="table-heading">Category</th>
                <th class="table-heading">Image</th>
                <th class="table-heading">User ID</th>
                <th class="table-heading">Created At</th>
                <th class="table-heading">Updated At</th>
            </tr>
            @foreach($listings as $listing)
                <tr>
                    <td class="table-record"><a class="record-link" href="{{ route('admin.listing.show', ['id' => $listing->id] )}}">{{$listing->id}}</a></td>
                    <td class="table-record">{{$listing->name}}</td>
                    <td class="table-record">{{$listing->description}}</td>
                    <td class="table-record">{{$listing->price}}</td>
                    <td class="table-record">{{$listing->category}}</td>
                    <td class="table-record">{{$listing->image}}</td>
                    <td class="table-record">{{$listing->user_id}}</td>
                    <td class="table-record">{{$listing->created_at}}</td>
                    <td class="table-record">{{$listing->updated_at}}</td>
                </tr>
            @endforeach
        </table>
    @else

    @endif
    
@endsection