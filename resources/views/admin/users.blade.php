@extends('layouts.app')

@section('title', 'Manage Users (Admin)')

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

    <p class="page-title">Manage Users</p>
    @if(!empty($users))
        <table>
            <tr>
                <th class="table-heading">ID</th>
                <th class="table-heading">Name</th>
                <th class="table-heading">Surname</th>
                <th class="table-heading">Email</th>
                <th class="table-heading">Password</th>
                <th class="table-heading">Merchant</th>
                <th class="table-heading">Admin</th>
                <th class="table-heading">Profile Picture</th>
                <th class="table-heading">Merchant Name</th>
                <th class="table-heading">Merchant Profile Picture</th>
                <th class="table-heading">Created At</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td class="table-record"><a class="record-link" href="{{ route('admin.user.show', ['id' => $user->id] )}}">{{$user->id}}</a></td>
                    <td class="table-record">{{$user->name}}</td>
                    <td class="table-record">{{$user->surname}}</td>
                    <td class="table-record">{{$user->email}}</td>
                    <td class="table-record">{{$user->password}}</td>
                    <td class="table-record">{{$user->merchant}}</td>
                    <td class="table-record">{{$user->admin}}</td>
                    <td class="table-record">{{$user->profile_picture}}</td>
                    <td class="table-record">{{$user->merchant_name}}</td>
                    <td class="table-record">{{$user->merchant_profile_picture}}</td>
                    <td class="table-record">{{$user->created_at}}</td>
                </tr>
            @endforeach
        </table>
    @else

    @endif
    
@endsection