<?php

declare(strict_types=1);

namespace App\Demo\IO\Controller;

use App\Common\Controller\ApiController;
use App\Common\Controller\EtagCacheabkeController;
use App\Demo\Application\Query\GetShouts;
use App\Demo\Application\Service\Bus;
use App\Demo\Infrastructure\ServerTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shout")
 */
class ShoutController extends ApiController implements EtagCacheabkeController
{
    /**
     * @Route("/{author}", methods={"GET"})
     */
    public function byAuthorAction(
        Bus $bus,
        Request $request,
        ServerTime $serverTime,
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
