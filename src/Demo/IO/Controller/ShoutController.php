<?php

declare(strict_types=1);

namespace App\Demo\IO\Controller;

use App\Demo\Application\Query\GetShouts;
use App\Demo\Application\Service\Bus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shout")
 */
class ShoutController extends Controller
{
    /**
     * @Route("/{author}", methods={"GET"})
     */
    public function byAuthorAction(
        Bus $bus,
        Request $request,
        string $author
    ): Response {
        $result = $bus->dispatchQuery(new GetShouts($author, $this->getReqOptInt($request, 'limit', 5)));

        return $this->createResponse(
            $request,
            $result->serialize(),
            Response::HTTP_OK
        );
    }
}
