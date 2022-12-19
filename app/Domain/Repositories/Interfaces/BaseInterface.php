<?php


namespace App\Domain\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    public function mainQuery(): Builder;

    public function getOne($modelId): Model;

    public function getAll(): Collection;

    public function getAllByUser($user_id): Builder;

    public function update($modelId, $data): void;

    public function delete($modelId): void;
}
