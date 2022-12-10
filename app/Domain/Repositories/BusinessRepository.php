<?php


namespace App\Domain\Repositories;


use App\Domain\Repositories\Interfaces\BusinessRepositoryInterface;
use App\Models\Business;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class BusinessRepository implements BusinessRepositoryInterface
{
    public function mainQuery(): Builder
    {
        return Business::select(['id', 'title', 'user_id', 'created_at', 'updated_at', 'description', 'image_url'])
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->with('ratings');
    }


    public function getOne($id): Model
    {
        return $this->mainQuery()
            ->where('id', $id)
            ->selectVisibleData($id)
            ->firstOrFail();
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id, $paginateBy = 10): LengthAwarePaginator
    {
        return $this->mainQuery()
            ->where('user_id', $user_id)
            ->paginate($paginateBy,['*'],'businesses');
    }

    public function getAllBy($orderBy = 'created_at'): Collection
    {
        return $this->mainQuery()->get()->sortByDesc($orderBy);
    }

    public function createNew($data)
    {
        return Business::create([
            ...$data,
            ...['user_id' => auth()->id()]
        ]);
    }


    public function delete($id): void
    {
        Business::destroy($id);
    }
}
