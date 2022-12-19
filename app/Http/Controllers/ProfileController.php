<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\BusinessRepository;
use App\Domain\Repositories\PaymentRepository;
use App\Domain\Repositories\RatingRepository;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function dashboard(): View
    {
        $userId = auth()->id();

        $businesses = (new BusinessRepository)
            ->getAllByUser($userId)
            ->paginate(config('constants.paginate_by.profile.businesses'),['*'],'businesses');

        $ratings = (new RatingRepository)
            ->getAllByUser($userId)
            ->paginate(config('constants.paginate_by.profile.ratings'),['*'],'ratings');

        $payments = (new PaymentRepository)
            ->getAllByUser($userId)
            ->paginate(config('constants.paginate_by.profile.payments'),['*'],'payments');

        $latestPayment = (new PaymentRepository)->findAllNotExpired($userId)->last();

        return view('dashboard', compact('businesses', 'ratings', 'payments','latestPayment'));
    }


    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
