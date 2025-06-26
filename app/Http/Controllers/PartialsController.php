<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PartialsController extends Controller
{
    public function delete_alert($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        return view('partials.alert', ['alert_title' => 'Confirmation', 'alert_text' => 'Are you sure you want to delete listing: ' . $listing->name . '?', 'action' => route('listings.destroy', $listing->id), 'method' => 'DELETE', 'command' => 'Delete']);
    }
}
