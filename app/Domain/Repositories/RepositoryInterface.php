<?php


namespace App\Domain\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function mainQuery(): Builder;

    public function getOne($id);

    public function getAll(): Collection;

    public function getAllByUser($user_id): Collection;

    public function getAllBy($orderBy): Collection;
}
