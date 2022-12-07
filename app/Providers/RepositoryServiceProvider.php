<?php


namespace App\Providers;


use App\Domain\Repositories\BusinessRepository;
use App\Domain\Repositories\RepositoryInterface;
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
