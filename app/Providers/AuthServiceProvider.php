<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Business;
use App\Models\Rating;
use App\Policies\BusinessPolicy;
use App\Policies\RatingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Business::class => BusinessPolicy::class,
        Rating::class => RatingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('rating-delete', [RatingPolicy::class, 'delete']);
        Gate::define('business-delete', [BusinessPolicy::class, 'delete']);
        Gate::define('business-update', [BusinessPolicy::class, 'update']);
    }
}
