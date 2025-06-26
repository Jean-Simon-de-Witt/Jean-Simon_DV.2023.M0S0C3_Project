<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Copy;
use App\Models\Listing;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function show($id) {
        $cart = Cart::where('user_id', $id)->first();
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        
        $copies = Copy::where('cart_id', $cart->id)->get();
        $listings = [];

        foreach($copies as $copy) {
            $listings[] = Listing::where('id', $copy->listing_id)->first();
        }

        return view('user.cart', ['cart' => $cart, 'user' => $user, 'listings' => $listings, 'view' => 'user.cart']);
    }

    public function add($id, $copy_id) {
        try {
            $copy = Copy::findOrFail($copy_id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Copy with ID '$copy_id' not found.");
        }
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }

        $cart = Cart::where('user_id', $id)->first();
        $copy->cart_id = $cart->id;
        $copy->save();
        return back();  
    }
}
