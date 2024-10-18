<?php

namespace App\Controller;

use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'app_prestation')]
    public function index(PrestationRepository $presta): Response
    {
        $prestations = $presta->findAll();

        return $this->render('prestation/index.html.twig', [
            'controller_name' => 'PrestationController',
            'prestations' => $prestations,
        ]);
    }
}
