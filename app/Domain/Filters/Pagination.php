<?php


namespace App\Domain\Filters;


class Pagination
{
    public function __construct(private $data)
    {
    }

    public function paginateResults(int $number)
    {
        $this->data->paginate($number);
    }
}
