<?php


namespace App\Providers;


use App\Domain\Interfaces\RatingRepositoryInterface;
use App\Domain\Repositories\BusinessRepository;
use App\Domain\Repositories\RatingRepository;
use Illuminate\Support\ServiceProvider;
use App\Domain\Interfaces\BusinessRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BusinessRepositoryInterface::class,
            BusinessRepository::class
        );

        $this->app->bind(
            RatingRepositoryInterface::class,
            RatingRepository::class
        );
    }
}
