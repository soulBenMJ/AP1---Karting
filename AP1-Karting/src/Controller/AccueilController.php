<?php

namespace App\Controller;

use App\Repository\OuvertureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(OuvertureRepository $ouvtr): Response
    {
        $horaires = $ouvtr->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'horaires' => $horaires,
        ]);
    }
}
