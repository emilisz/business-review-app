<?php

namespace App\Http\Controllers;


use App\Domain\Repositories\Interfaces\BusinessRepositoryInterface;

use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Models\Business;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class BusinessController extends Controller
{
    public function __construct(protected BusinessRepositoryInterface $repository)
    {
    }

    public function index(): View
    {
        $businesses = $this->repository
            ->getAll()
            ->paginate(config('constants.paginate_by.default'));

        return view('business.index', compact('businesses'));
    }

    public function orderby($order): View
    {
        $businesses = $this->repository
            ->getAllBy($order)
            ->paginate(config('constants.paginate_by.default'));

        return view('business.index', compact('businesses'));
    }

    public function create(): View
    {
        return view('business.create');
    }

    public function store(StoreBusinessRequest $request): RedirectResponse
    {
        $this->repository->createNew($request->validated());

        return redirect()->route('home')->with('status', "Saved!");
    }

    public function show(Business $business): View
    {
        $business = $this->repository->getOne($business->id);
        $ratings = $business->ratings()->paginate(config('constants.paginate_by.default'));

        return view('business.show', compact('business', 'ratings'));
    }

    public function edit(Business $business): View
    {
        Gate::authorize('business-update', $business);
        $business = $this->repository->getOne($business->id);

        return view('business.edit', compact('business'));
    }

    public function update(Business $business, UpdateBusinessRequest $request): RedirectResponse
    {
        $this->repository->update($business->id, $request->validated());
        return redirect()->route('business.show', $business)->with('status', "Updated!");
    }

    public function delete(Business $business): RedirectResponse
    {
        Gate::authorize('business-delete', $business);
        $this->repository->delete($business->id);

        return redirect()->route('dashboard')->with('status', "Deleted!");
    }
}
