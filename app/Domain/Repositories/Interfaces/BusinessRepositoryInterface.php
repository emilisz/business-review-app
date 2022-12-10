<?php


namespace App\Domain\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface BusinessRepositoryInterface extends BaseInterface
{
    public function getAllBy($orderBy): Collection;
}
