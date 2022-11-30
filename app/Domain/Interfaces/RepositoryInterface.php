<?php


namespace App\Domain\Interfaces;


interface RepositoryInterface
{
    public function getOne($id);

    public function getAll();

    public function getAllByUser($user_id);

    public function getAllBy($orderBy);
}
