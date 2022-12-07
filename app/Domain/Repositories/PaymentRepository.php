<?php


namespace App\Domain\Repositories;


use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository implements RepositoryInterface
{

    public function mainQuery():Builder
    {
        return Payment::with('user');

    }

    public function getOne($id)
    {
        return $this->mainQuery()->firstOrFail($id);
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id): Collection
    {
        return $this->mainQuery()->where('user_id', $user_id)->get();
    }

    public function getAllBy($orderBy): Collection
    {
        return $this->mainQuery()->get()->sortByDesc($orderBy);
    }

    public function isValid($user_id): Collection
    {
        return $this->mainQuery()->get()->where('user_id', $user_id)->where('valid_till','>', now());
    }
}
