<?php


namespace App\Domain\Interfaces;


interface BusinessRepositoryInterface extends RepositoryInterface
{
    public function search($name);
    public function getAllByRating($orderBy);
}
