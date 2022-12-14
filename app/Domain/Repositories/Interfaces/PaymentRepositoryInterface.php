<?php
declare(strict_types=1);


namespace App\Domain\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;


interface PaymentRepositoryInterface extends BaseInterface
{
    public function findAllNotExpired($user_id): Collection;
}
