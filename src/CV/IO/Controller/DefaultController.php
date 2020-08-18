<?php

declare(strict_types=1);

namespace App\CV\IO\Controller;

use App\Common\Controller\EtagCacheabkeController;
use App\Common\Controller\WebController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends WebController implements EtagCacheabkeController
{

    /**
     * @Route("")
     */
    public function spanish(): Response
    {
        return $this->render('cv.html.twig');
    }

    /**
     * @Route("/en")
     */
    public function english(): Response
    {
        return $this->render('cv_en.html.twig');
    }
}
