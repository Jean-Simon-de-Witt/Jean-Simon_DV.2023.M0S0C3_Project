<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Copy;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListingController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'sort1' => 'nullable|string|in:name,date,rating,price',
            'order1' => 'string|in:asc,desc',
            'sort2' => 'nullable|string|in:name,date,rating,price',
            'order2' => 'string|in:asc,desc',
            'sort3' => 'nullable|string|in:name,date,rating,price',
            'order3' => 'string|in:asc,desc'
        ]);
        $oldValues = ['search' => '', 'sort1' => '', 'order1' => '', 'sort2' => '', 'order2' => '', 'sort3' => '', 'order3' => ''];
        $query = 'SELECT * FROM listings';
        $values = [];
        $subsequent = false;
        $title = '';
        if (empty($request->search) && empty($request->sort1) && empty($request->sort2) && empty($request->sort3)) {
            $query = $query . ' ORDER BY listings.created_at desc';
        }
        else {
            if (!empty($request->search)) {
                $title = $title . "Results for search: '" . $request->search . "' - ";
                $oldValues['search'] = $request->search;
                $query = $query . " WHERE listings.name LIKE :name OR listings.category LIKE :category";
                $values['name'] = '%' . $request->search . '%';
                $values['category'] = '%' . $request->search . '%';
            }
            

            if (!empty($request->sort1)) {
                $title = $title . "Sorted by: " . $request->sort1;
                $oldValues['sort1'] = $request->sort1;
                $oldValues['order1'] = $request->order1;
                if ($request->sort1 === 'date') {
                    $query = $query . " ORDER BY DATE(listings." . "created_at" . ") " . $request->order1;
                }
                else {
                    $query = $query . " ORDER BY listings." . $request->sort1 . " " . $request->order1;
                }
                $subsequent = true;
            }

            if (!empty($request->sort2)) {
                $oldValues['sort2'] = $request->sort2;
                $oldValues['order2'] = $request->order2;
                if ($subsequent) {
                    $title = $title . ", " . $request->sort2;
                    if ($request->sort2 === 'date') {
                        $query = $query . ", DATE(listings." . "created_at" . ") " . $request->order2;
                    }
                    else {
                        $query = $query . ", listings." . $request->sort2 . " " . $request->order2;
                    }
                }
                else {
                    $title = $title . 'Sorted by: ' . $request->sort2;
                    if ($request->sort2 === 'date') {
                        $query = $query . "ORDER BY DATE(listings." . "created_at" . ") " . $request->order2;
                    }
                    else {
                        $query = $query . "ORDER BY listings." . $request->sort2 . " " . $request->order2;
                    }
                    $subsequent = true;
                }
            }

            if (!empty($request->sort3)) {
                $oldValues['sort3'] = $request->sort3;
                $oldValues['order3'] = $request->order3;
                if ($subsequent) {
                    $title = $title . ", " . $request->sort3;
                    if ($request->sort3 === 'date') {
                        $query = $query . ", DATE(listings." . "created_at" . ") " . $request->order3;
                    }
                    else {
                        $query = $query . ", listings." . $request->sort3 . " " . $request->order3;
                    }
                }
                else {
                    $title = $title . 'Sorted by: ' . $request->sort3;
                    if ($request->sort3 === 'date') {
                        $query = $query . "ORDER BY DATE(listings." . "created_at" . ") " . $request->order3;
                    }
                    else {
                        $query = $query . "ORDER BY listings." . $request->sort3 . " " . $request->order3;
                    }
                    $subsequent = true;
                } 
            }
        }
        $listings = Listing::fromQuery($query, $values)->all();
        
        return view('listings.index', ['listings' => $listings, 'oldValues' => $oldValues, 'title' => $title, 'view' => 'listings.index']);
    }

    public function show($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        try {
            $merchant = User::findOrFail($listing->user_id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Merchant with ID '$id' not found.");
        }
        
        $availableCopies = Copy::where('listing_id', $listing->id)->whereNull('cart_id')->get();
        $ratings = Rating::where('listing_id', $listing->id)->get();
        $user_rating = null;
        if (Auth::user()) {
            $user_rating = Rating::where('user_id', Auth::user()->id)->where('listing_id', $listing->id)->first();
        }
        $reviews = [];
        if (count($ratings) > 0) {
            foreach($ratings as $rating) {

                if ($rating->review) {
                    $reviews[] = ['review' => $rating->review, 'score' => $rating->score, 'author' => User::findOrFail($rating->user_id)];
                }
            }
        }
        return view('listings.show', ['listing' => $listing, 'copies' => $availableCopies, 'merchant' => $merchant, 'reviews' => $reviews, 'user_rating' => $user_rating, 'ratings_count' => count($ratings), 'view' => 'listings.show']);
    }

    public function create() {
        return view('listings.create', ['view' => 'listings.create']);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'string|max:100',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $path = $request->file('image')->store('product_images', 'public');

        Listing::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $path,
            'user_id' => Auth::user()->id
        ]);
        return redirect(route('user.profile.merchant.show', ['id' => Auth::user()->id]));
    }

    public function edit($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        return view('listings.edit', ['listing' => $listing, 'view' => 'listings.edit']);
    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        if ($request->file('image')) {
            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $path = $request->file('image')->store('product_images', 'public');
            $listing->image = $path;
        }
        $listing->name = $request->name;
        $listing->description = $request->description;
        $listing->price = $request->price;
        $listing->category = $request->category;
        $listing->save();
        return redirect(route('user.profile.merchant.show', ['id' => Auth::user()->id]));
    }

    public function destroy($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        $listing->delete();
        return redirect(route('user.profile.merchant.show', ['id' => Auth::user()->id]));
    }

    public function add($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        return view('listings.add-stock', ['listing' => $listing, 'view' => 'listings.add-stock']);
    }

    public function append($id, Request $request) {
        $request->validate([
            'stock' => 'required|numeric|min:1'
        ]);
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        for ($i = 0; $i < $request->stock; $i++) {
            Copy::create([
                'listing_id' => $id
            ]);
        }
        return redirect(route('user.profile.merchant.show', ['id' => Auth::user()->id]));
    }

    public function createRating($id) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        return view('ratings.create', ['listing' => $listing, 'view' => 'ratings.create']);
    }

    public function storeRating($id, Request $request) {
        try {
            $listing = Listing::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            abort(404, "404 | Listing with ID '$id' not found.");
        }
        
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'string|nullable|max:1000'
        ]);

        Rating::create([
            'score' => $request->rating,
            'review' => $request->review,
            'user_id' => Auth::user()->id,
            'listing_id' => $listing->id
        ]);

        $ratings = Rating::where('listing_id', $listing->id)->get();
        $rating = 0;
        for ($i = 0; $i < count($ratings); $i++) {
            $rating += $ratings[$i]->score;
        }
        $rating = round($rating / count($ratings));
        $listing->rating = $rating;
        $listing->save();

        return redirect(route('listings.show', ['id' => $listing->id]));
    }
}
