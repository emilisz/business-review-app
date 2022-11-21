<?php


namespace App\Domain\Controllers;


use App\Domain\Interfaces\BusinessRepositoryInterface;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Models\Business;
use Illuminate\Support\Facades\Gate;

class BusinessController
{
    public function __construct(protected BusinessRepositoryInterface $businessRepository)
    {
    }

    public function index()
    {
        $businesses = $this->businessRepository->getAll('asc', 10);
        return view('business.index', ['businesses' => $businesses]);
    }

    public function create()
    {
        return view('business.create');
    }

    public function store(StoreBusinessRequest $request)
    {
        auth()->user()->businesses()->create($request->validated());

        return redirect()->route('home')->with('status', "Saved!");
    }

    public function show($id)
    {
        $business = $this->businessRepository->getOne($id);
        return view('business.show', compact('business'));
    }

    public function edit(Business $business)
    {
        Gate::authorize('update', $business);
        $business = $this->businessRepository->getOne($business->id);

        return view('business.edit', compact('business'));

    }

    public function update(Business $business, UpdateBusinessRequest $request)
    {
        $business = $this->businessRepository->getOne($business->id);
        $business->update($request->validated());

        return redirect()->route('business.show', $business)->with('status', "Updated!");
    }

    public function delete(Business $business)
    {
        Gate::authorize('delete', $business);

        $business->delete();
        return redirect()->route('home')->with('status', "Deleted!");
    }

}
