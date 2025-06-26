<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Copy;
use App\Models\Listing;

class CartController extends Controller
{
    public function show($id) {
        $cart = Cart::where('user_id', $id)->first();
        $user = User::where('id', $id)->first();
        $copies = Copy::where('cart_id', $cart->id)->get();
        $listings = [];

        foreach($copies as $copy) {
            $listings[] = Listing::where('id', $copy->listing_id)->first();
        }

        return view('user.cart', ['cart' => $cart, 'user' => $user, 'listings' => $listings, 'view' => 'user.cart']);
    }

    public function add($id, $copy_id) {
        $copy = Copy::findOrFail($copy_id);
        $cart = Cart::where('user_id', $id)->first();
        $copy->cart_id = $cart->id;
        $copy->save();
        return back();  
    }
}
