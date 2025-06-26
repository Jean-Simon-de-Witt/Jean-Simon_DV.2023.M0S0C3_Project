<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class CheckListingOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        try {
            $listing = Listing::findOrFail($id);
        }
        catch(HttpException $e) {
            return abort(404, "404 | No listing found with ID '$id'");
        }

        if (Auth::user()->id !== $listing->user_id) {
            return abort(403, '403 | You are not the owner of this product');
        }
        return $next($request);
    }
}
