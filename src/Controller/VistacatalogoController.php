<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VistacatalogoController extends AbstractController
{
    #[Route('/vistacatalogo', name: 'app_vistacatalogo')]
    public function index(): Response
    {
        return $this->render('vistacatalogo/index.html.twig', [
            'controller_name' => 'VistacatalogoController',
        ]);
    }
}
