<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileController extends Controller
{
    public function show($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        $reviews = Rating::where('user_id', $id)->get();
        return view('user.profile', ['user' => $user, 'reviews' => $reviews, 'view' => 'user.profile']);
    }

    public function showMerchant($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        $listings = Listing::where('user_id', $user->id)->get();
        return view('user.merchantprofile', ['user' => $user, 'listings' => $listings, 'view' => 'user.merchantprofile']);
    }

    public function edit($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        return view('user.profile-edit', ['user' => $user, 'view' => 'user.profile-edit']);
        
    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }

        if ($request->file('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = $path;
        }
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();
        return redirect(route('user.profile.show', ['id' => $user->id]));
    }

    public function createMerchant($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        return view('user.merchantprofile-create', ['user' => $user, 'view' => 'user.merchantprofile-create']);
    }

    public function assignMerchant($id, Request $request) {
        $request->validate([
            'merchant_name' => 'required|string|max:255'
        ]);
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        $user->merchant = 1;
        $user->merchant_name = $request->merchant_name;
        $user->save();
        return redirect(route('user.profile.merchant.show', ['id' => $user->id]));
    }

    public function editMerchant($id) {
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }
        return view('user.merchantprofile-edit', ['user'=> $user, 'view' => 'user.merchantprofile-edit']);
    }

    public function updateMerchant($id, Request $request) {
        $request->validate([
            'merchant_name' => 'required|string|max:255',
            'merchant_profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | User with ID '$id' not found.");
        }

        if ($request->file('merchant_profile_picture')) {
            $path = $request->file('merchant_profile_picture')->store('profile_pictures', 'public');
            if ($user->merchant_profile_picture) {
                Storage::disk('public')->delete($user->merchant_profile_picture);
            }
            $user->merchant_profile_picture = $path;
        }
        $user->merchant_name = $request->merchant_name;
        $user->save();
        return redirect(route('user.profile.merchant.show', ['id' => $user->id]));
    }
}
