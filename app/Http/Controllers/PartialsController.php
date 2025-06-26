<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class PartialsController extends Controller
{
    public function delete_alert($id) {
        $listing = Listing::findOrFail($id);
        return view('partials.alert', ['alert_title' => 'Confirmation', 'alert_text' => 'Are you sure you want to delete listing: ' . $listing->name . '?', 'action' => route('listings.destroy', $listing->id), 'method' => 'DELETE', 'command' => 'Delete']);
    }
}
