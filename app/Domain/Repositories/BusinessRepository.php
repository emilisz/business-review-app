<?php


namespace App\Domain\Repositories;

use App\Domain\Interfaces\RepositoryInterface;
use App\Models\Business;


class BusinessRepository implements RepositoryInterface
{
    public function mainQuery()
    {
        return Business::withCount('ratings')
            ->withAvg('ratings','rating')
            ->with('ratings')
            ->get();

}


    public function getOne($id)
    {
        return $this->mainQuery()->where('id', $id)->first();
    }

    public function getAll()
    {
        return $this->mainQuery();
    }

    public function getAllByUser($user_id)
    {
        return $this->mainQuery()->where('user_id', $user_id);
    }

    public function getAllBy($orderBy = 'rating_avg_rating')
    {
        return $this->mainQuery()->sortByDesc($orderBy);
    }


}
