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
        $totals = ['count' => 0, 'sum' => 0];

        foreach($copies as $copy) {
            $duplicate = false;
            $index = 0;
            for($i = 0; $i < count($listings); $i++ ) {
                if ($copy->listing_id === $listings[$i]['listing']->id) {
                    $duplicate = true;
                    $index = $i;
                    break;
                }
            }
            if ($duplicate) {
                $listings[$index]['quantity'] += 1;
                $totals['count'] += 1;
                $totals['sum'] += $listings[$index]['listing']->price;
            }
            else {
                try {
                    $listing = Listing::findOrFail($copy->listing_id);
                }
                catch (ModelNotFoundException $e) {
                    abort(404, "404 | Listing with ID '$id' not found.");
                }
                $listings[] = ['listing' => $listing, 'quantity' => 1];
                $totals['count'] += 1;
                $totals['sum'] += $listing->price;
            }
            
        }

        return view('user.cart', ['cart' => $cart, 'user' => $user, 'listings' => $listings, 'totals' => $totals, 'view' => 'user.cart']);
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
