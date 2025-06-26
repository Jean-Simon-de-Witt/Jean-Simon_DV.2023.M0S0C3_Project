<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show($id) {
        $user = User::where('id', $id)->first();
        $reviews = Rating::where('user_id', $id)->get();
        return view('user.profile', ['user' => $user, 'reviews' => $reviews, 'view' => 'user.profile']);
    }

    public function showMerchant($id) {
        $user = User::where('id', $id)->first();
        $listings = Listing::where('user_id', $user->id)->get();
        return view('user.merchantprofile', ['user' => $user, 'listings' => $listings, 'view' => 'user.merchantprofile']);
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        return view('user.profile-edit', ['user' => $user, 'view' => 'user.profile-edit']);
        
    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $user = User::where('id', $id)->first();

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
        $user = User::where('id', $id)->first();
        return view('user.merchantprofile-create', ['user' => $user, 'view' => 'user.merchantprofile-create']);
    }

    public function assignMerchant($id, Request $request) {
        $request->validate([
            'merchant_name' => 'required|string|max:255'
        ]);
        $user = User::where('id', $id)->first();
        $user->merchant = 1;
        $user->merchant_name = $request->merchant_name;
        $user->save();
        return redirect(route('user.profile.merchant.show', ['id' => $user->id]));
    }

    public function editMerchant($id) {
        $user = User::where('id', $id)->first();
        return view('user.merchantprofile-edit', ['user'=> $user, 'view' => 'user.merchantprofile-edit']);
    }

    public function updateMerchant($id, Request $request) {
        $request->validate([
            'merchant_name' => 'required|string|max:255',
            'merchant_profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $user = User::where('id', $id)->first();

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
