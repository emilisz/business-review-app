<?php


namespace App\Providers;


use App\Domain\Interfaces\RepositoryInterface;
use App\Domain\Repositories\BusinessRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            RepositoryInterface::class,
            BusinessRepository::class
        );

    }
}
