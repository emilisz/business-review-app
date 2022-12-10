<?php


namespace App\Domain\Repositories;


use App\Domain\Repositories\Interfaces\BaseInterface;
use App\Domain\Repositories\Interfaces\RatingRepositoryInterface;
use App\Models\Business;
use App\Models\Rating;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RatingRepository implements RatingRepositoryInterface
{

    public function mainQuery(): Builder
    {
        return Rating::with('business', 'user');
    }

    public function getOne($id): Model
    {
        return $this->mainQuery()->where('id', $id)->first();
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id, $paginateBy = 10): LengthAwarePaginator
    {
        return $this->mainQuery()
            ->where('user_id', $user_id)
            ->paginate($paginateBy,['*'],'ratings');
    }

    public function createNew($businessId, $data)
    {
        return Rating::create([
            ...$data,
            ...['business_id' =>  $businessId, 'user_id' => auth()->id()]
        ]);
    }

    public function delete($id): void
    {
        Rating::destroy($id);
    }
}
