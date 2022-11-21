<?php


namespace App\Domain\Interfaces;


interface RepositoryInterface
{
    public function getOne($id);

    public function getAll(string $order, int $results);

    public function getAllByUser($user_id);
}
