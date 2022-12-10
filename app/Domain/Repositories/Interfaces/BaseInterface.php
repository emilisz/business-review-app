<?php


namespace App\Domain\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface BaseInterface
{
    public function mainQuery(): Builder;

    public function getOne($id);

    public function getAll(): Collection;

    public function getAllByUser($user_id, $paginateBy);

    public function delete($id): void;
}
