<?php


namespace App\Repository\Contracts;


interface BookRepoInterface
{
    public function listBooks($filters);

    public function get($bookId);
}
