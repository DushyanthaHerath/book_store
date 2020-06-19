<?php


namespace App\Service\Books\Contracts;


use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface BookInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function listBooks(Request $request);
}
