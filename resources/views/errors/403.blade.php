@extends('layouts.app')

@section('title', 'Unauthorised')

@section('content')
    <h1 class="error-message">{{$exception->getMessage() }}</h1>
@endsection