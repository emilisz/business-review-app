<?php

namespace App\Http\Controllers;

use App\Domain\Interfaces\RepositoryInterface;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Models\Business;
use Illuminate\Support\Facades\Gate;

class BusinessController extends Controller
{
    public function __construct(protected RepositoryInterface $repository)
    {
    }

    public function index()
    {
        $businesses = $this->repository->getAll()->paginate(6);
        return view('business.index', compact('businesses'));
    }

    public function orderby($order)
    {
        $businesses = $this->repository->getAllBy($order)->paginate(6);
//        dd($businesses);
        return view('business.index', compact('businesses'));
    }

    public function create()
    {
        return view('business.create');
    }

    public function store(StoreBusinessRequest $request)
    {
        (new Business)->createNew($request->validated());
        return redirect()->route('home')->with('status', "Saved!");
    }

    public function show(Business $business)
    {
        $business = $this->repository->getOne($business->id);
        return view('business.show', compact('business'));
    }

    public function edit(Business $business)
    {
        $business = $this->repository->getOne($business->id);
        Gate::authorize('business-update', $business);
        return view('business.edit', compact('business'));
    }

    public function update(Business $business, UpdateBusinessRequest $request)
    {
        $business = $this->repository->getOne($business->id);
        $business->update($request->validated());
        return redirect()->route('business.show', $business)->with('status', "Updated!");
    }

    public function delete(Business $business)
    {
        $business = $this->repository->getOne($business->id);
        Gate::authorize('business-delete', $business);
        $business->delete();
        return redirect()->route('home')->with('status', "Deleted!");
    }
}
