<?php


namespace App\Domain\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface BaseInterface
{
    public function mainQuery(): Builder;

    public function getOne($modelId);

    public function getAll(): Collection;

    public function getAllByUser($user_id, $paginateBy);

    public function update($modelId, $data): void;

    public function delete($modelId): void;
}
