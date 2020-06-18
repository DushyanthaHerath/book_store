<?php


namespace App\Controller\API;


use App\Service\Books\Contracts\BookInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/books")
 */
class BookController extends BaseController
{
    protected $service;

    public function __construct(BookInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return BookInterface
     */
    public function getService(): BookInterface
    {
        return $this->service;
    }

    /**
     * @Route("/", defaults={"page": "1"})
     */
    public function list(Request $request) {
        return $this->sendResponse($this->getService()->listBooks($request));
    }
}
