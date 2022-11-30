<?php


namespace App\Domain\Repositories;


use App\Domain\Interfaces\RepositoryInterface;
use App\Models\Rating;

class RatingRepository implements RepositoryInterface
{

    public function mainQuery()
    {
        return Rating::with('business','user')->get();
    }

    public function getOne($id)
    {
        return $this->mainQuery()->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->mainQuery();
    }

    public function getAllByUser($user_id, $results = 15)
    {
        return $this->mainQuery()->where('user_id', $user_id);
    }

    public function getAllBy($orderBy = 'avg_rating')
    {
        return $this->mainQuery()->sortByDesc($orderBy);
    }
}
