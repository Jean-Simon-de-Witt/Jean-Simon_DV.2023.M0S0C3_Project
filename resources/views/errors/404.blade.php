@extends('layouts.app')

@section('title', 'Not Found')

@section('content')
    <h1 class="error-message">{{$exception->getMessage() }}</h1>
@endsection