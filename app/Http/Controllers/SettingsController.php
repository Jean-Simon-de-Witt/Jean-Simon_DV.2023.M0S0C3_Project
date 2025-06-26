<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SettingsController extends Controller
{
    public function show($id) {
        $user = User::where('id', $id)->first();
        return view('user.settings', ['user' => $user]);
    }
}
