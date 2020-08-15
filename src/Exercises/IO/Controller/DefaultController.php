<?php

declare(strict_types=1);

namespace App\Exercises\IO\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exercise")
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/dots")
     */
    public function index(): Response
    {
        $response = $this->render('exercise/dots.html.twig');
        $content = $response->getContent();

        if ($content !== false) {
            $response->setEtag(md5($content));
            $response->setPublic();
            $response->isNotModified($request);
        }

        return $response;
    }
}
