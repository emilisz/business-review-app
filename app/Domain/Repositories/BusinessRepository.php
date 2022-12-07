<?php


namespace App\Domain\Repositories;


use App\Models\Business;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class BusinessRepository implements RepositoryInterface
{
    public function mainQuery(): Builder
    {
        return Business::select(['id', 'title', 'user_id','created_at','updated_at', 'description', 'image_url'])
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->with('ratings');
    }


    public function getOne($id)
    {
        return  $this->mainQuery()
            ->where('id', $id)
            ->selectVisibleData($id)
            ->firstOrFail();
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id): Collection
    {
        return $this->mainQuery()->where('user_id', $user_id)->get();
    }

    public function getAllBy($orderBy = 'created_at'): Collection
    {
        return $this->mainQuery()->get()->sortByDesc($orderBy);
    }


}
