<?php


namespace App\Domain\Repositories;


use App\Domain\Repositories\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RatingRepository implements RatingRepositoryInterface
{

    public function mainQuery(): Builder
    {
        return Rating::with('business', 'user');
    }

    public function getOne($modelId): Model
    {
        return $this->mainQuery()->where('id', $modelId)->first();
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id): Builder
    {
        return $this->mainQuery()->where('user_id', $user_id);
    }

    public function createNew($businessId, $data)
    {
        return Rating::create([
            ...$data,
            ...['business_id' =>  $businessId, 'user_id' => auth()->id()]
        ]);
    }

    public function update($modelId, $data): void
    {
        $model = Rating::findOrFail($modelId);
        $model->update($data);
    }

    public function delete($modelId): void
    {
        $model = Rating::findOrFail($modelId);
        $model->delete();
    }
}
