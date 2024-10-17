<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestationModifController extends AbstractController
{
    #[Route('/prestation/modif', name: 'app_prestation_modif')]
    public function index(): Response
    {
        return $this->render('prestation_modif/index.html.twig', [
            'controller_name' => 'PrestationModifController',
        ]);
    }
}
