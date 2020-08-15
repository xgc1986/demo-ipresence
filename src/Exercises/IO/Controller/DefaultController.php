<?php

declare(strict_types=1);

namespace App\Exercises\IO\Controller;

use App\Common\Controller\EtagCacheabkeController;
use App\Common\Controller\WebController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exercise")
 */
class DefaultController extends WebController implements EtagCacheabkeController
{

    /**
     * @Route("/dots")
     */
    public function index(): Response
    {
        return $this->render('exercise/dots.html.twig');
    }
}
