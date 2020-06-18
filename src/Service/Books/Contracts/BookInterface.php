<?php


namespace App\Service\Books\Contracts;


use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface BookInterface
{
    public function listBooks(Request $request);
}
