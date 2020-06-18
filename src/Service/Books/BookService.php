<?php


namespace App\Service\Books;


use App\Repository\BookRepository;
use App\Service\Books\Contracts\BookInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class BookService implements BookInterface
{
    private $repository;
    private $paginator;
    const MAX_ENTRIES = 50;
    public function __construct(BookRepository $repository, PaginatorInterface $paginator)
    {
        $this->repository = $repository;
        $this->paginator = $paginator;
    }

    public function listBooks(Request $request)
    {
        $page = $request->query->get('page', 1);
        $entries = $request->query->get('entries', null);
        $query = $this->repository->listBooks($this->createFilters($request));
        return $this->paginator->paginate(
            $query,
            $page,
            $entries ?? self::MAX_ENTRIES
        );
    }

    public function createFilters($request) {
        return ['category_id' => $request->query->get('category_id', null)];
    }
}
