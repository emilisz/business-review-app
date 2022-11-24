<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Business;
use App\Models\Rating;
use Illuminate\Support\Facades\Gate;

class RatingController extends Controller
{
    public function store(Business $business, StoreRatingRequest $request)
    {
        (new Rating)->createNew($business, $request->validated());

        return redirect()->route('business.show', $business)->with('status', "Rating saved!");
    }

    public function delete(Business $business, Rating $rating)
    {
        Gate::authorize('rating-delete', $rating);
        $rating->delete();

        return redirect()->route('business.show', $business)->with('status', "Rating deleted!");
    }
}
