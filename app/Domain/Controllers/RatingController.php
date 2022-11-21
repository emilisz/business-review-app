<?php


namespace App\Domain\Controllers;


use App\Domain\Interfaces\RatingRepositoryInterface;
use App\Models\Business;

class RatingController
{
    public function __construct(protected RatingRepositoryInterface $repository)
    {
    }

    public function store(Business $business)
    {
        $validated =  request()->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => ''
        ]);
        $validated['user_id'] = auth()->id();

//        Business::create($validated);

        $business->ratings()->create($validated);

        return redirect()->route('home')->with('status', "Rating saved!");
    }
}
