<?php


namespace App\Domain\Repositories;


use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RatingRepository implements RepositoryInterface
{

    public function mainQuery(): Builder
    {
        return Rating::with('business', 'user');
    }

    public function getOne($id)
    {
        return $this->mainQuery()->where('id', $id)->first();
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id): Collection
    {
        return $this->mainQuery()->where('user_id', $user_id)->get();
    }

    public function getAllBy($orderBy = 'avg_rating'): Collection
    {
        return $this->mainQuery()->get()->sortByDesc($orderBy);
    }
}
