<?php
declare(strict_types=1);


namespace App\Domain\Repositories;


use App\Domain\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function mainQuery(): Builder
    {
        return Payment::with('user');

    }

    public function getOne($modelId): Model
    {
        return $this->mainQuery()->firstOrFail($modelId);
    }

    public function getAll(): Collection
    {
        return $this->mainQuery()->get();
    }

    public function getAllByUser($user_id): Builder
    {
        return $this->mainQuery()->where('user_id', $user_id);
    }

    public function update($modelId, $data): void
    {
        $model = Payment::findOrFail($modelId);
        $model->update($data);
    }

    public function delete($modelId): void
    {
        $model = Payment::findOrFail($modelId);
        $model->delete();
    }


    public function findAllNotExpired($user_id): Collection
    {
        return $this->getAllByUser($user_id)->get()->where('valid_till', '>', now());
    }

}
