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
        return $this->render('exercise/dots.html.twig');
    }
}
