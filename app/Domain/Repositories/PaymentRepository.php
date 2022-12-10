<?php


namespace App\Domain\Repositories;


use App\Domain\Repositories\Interfaces\BaseInterface;
use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository implements BaseInterface
{

    public function mainQuery(): Builder
    {
        return Payment::with('user');

    }

    public function getOne($id): Model
    {
        return $this->mainQuery()->firstOrFail($id);
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id, $paginateBy = 10): LengthAwarePaginator
    {
        return $this->mainQuery()
            ->where('user_id', $user_id)
            ->paginate($paginateBy,['*'],'payments');
    }

    public function isValid($user_id): Collection
    {
        return $this->mainQuery()->get()->where('user_id', $user_id)->where('valid_till', '>', now());
    }

    public function delete($id): void
    {
        Payment::destroy($id);
    }
}
