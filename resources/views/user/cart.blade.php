@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <h1 class="page-title">Your Cart</h1>
    <div class="cart-container">
        <div class="cart-items">
            <h2 class="cart-title-light">Items in Cart</h2>
            @forelse($listings as $listing)
                <div class="cart-item">
                    <p class="cart-item-name">{{ $listing['listing']->name }}</p>
                    <p class="cart-item-text">{{ 'R' . round($listing['listing']->price, 2)}}</p>
                    <p class="cart-item-text">Quantity: {{ $listing['quantity']}}</p>
                </div>
            @empty
                <p class="cart-item-text">You have no items in your cart</p>
            @endforelse
        </div>
        <div class="cart-summary">
            <h2 class="cart-title-dark">Summary</h2>
            <p class="summary-text">Total Items: {{ $totals['count']}}</p>
            <p class="summary-text">Subtotal: {{ $totals['sum'] }}</p>
            <button class="button">Checkout</button>
        </div>
    </div>
@endsection