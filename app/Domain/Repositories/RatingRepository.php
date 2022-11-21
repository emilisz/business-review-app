<?php


namespace App\Domain\Repositories;


use App\Domain\Interfaces\RatingRepositoryInterface;
use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{

    public function getOne($id)
    {
        return Rating::find($id);
    }

    public function getAll(string $order, int $results)
    {
        return Rating::get()->paginate($results);
    }

    public function getAllByUser($user_id)
    {
        return Rating::where('user_id', $user_id)->get();
    }
}
