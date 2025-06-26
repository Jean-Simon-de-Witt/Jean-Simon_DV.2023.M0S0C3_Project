<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', ['view' => 'admin.index']);
    }

    public function users() {
        $users = User::all();
        return view('admin.users', ['users' => $users, 'view' => 'admin.users']);
    }

    public function showUser($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        return view('admin.user.show', ['user' => $user, 'view' => 'admin.user.show']);
    }

    public function editUser($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        
        return view('admin.user.edit', ['user' => $user, 'view' => 'admin.user.edit']);
    }

    public function updateUser($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'merchant_name' => 'nullable|string|max:255',
            'merchant' => 'nullable|boolean',
            'admin' => 'nullable|boolean'
        ]);
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->merchant_name = $request->merchant_name;
        if ($request->merchant) {
            $user->merchant = 1;
        }
        else {
            $user->merchant = 0;
        }

        if ($request->admin) {
            $user->admin = 1;
        }
        else {
            $user->admin = 0;
        }
        $user->save();
        return redirect(route('admin.user.show', ['id' => $user->id]));
    }

    public function destroyUser($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }

        $user->delete();
        return redirect(route('admin.users'));
    } 

    public function listings() {
        $listings = Listing::all();
        return view('admin.listings', ['listings' => $listings, 'view' => 'admin.listings']);
    }

    public function showListing($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        return view('admin.listing.show', ['listing' => $listing, 'view' => 'admin.listing.show']);
    }

    public function editListing($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        return view('admin.listing.edit', ['listing' => $listing, 'view' => 'admin.listing.edit']);
    }

    public function updateListing($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:1',
            'category' => 'required|string|max:255',
            'user_id' => 'required|numeric|min:1'
        ]);
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        $listing->name = $request->name;
        $listing->description = $request->description;
        $listing->price = $request->price;
        $listing->category = $request->category;
        $listing->user_id = $request->user_id;
        $listing->save();
        return redirect(route('admin.listing.show', ['id' => $listing->id]));
    }

    public function destroyListing($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }

        $listing->delete();
        return redirect(route('admin.listings'));
    }
}
