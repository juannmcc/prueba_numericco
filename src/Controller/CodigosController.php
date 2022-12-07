<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CodigosController extends AbstractController
{
    /**
     * @Route("/codigos", name="app_codigos")
     */
    public function index(): Response
    {
        return $this->render('codigos/index.html.twig', [
            'controller_name' => 'CodigosController',
        ]);
    }
}
