<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Repositories\Interfaces\RatingRepositoryInterface;
use App\Http\Requests\StoreRatingRequest;
use App\Models\Business;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class RatingController extends Controller
{
    public function __construct(protected RatingRepositoryInterface $repository)
    {
    }


    public function store(Business $business, StoreRatingRequest $request): RedirectResponse
    {
        $this->repository->createNew($business->id, $request->validated());
        return redirect()->route('business.show', $business)->with('status', "Rating saved!");
    }

    public function delete(Rating $rating): RedirectResponse
    {
        Gate::authorize('rating-delete', $rating);

        $this->repository->delete($rating->id);
        return redirect()->back()->with('status', "Rating deleted!");
    }
}
