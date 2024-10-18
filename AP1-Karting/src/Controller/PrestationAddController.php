<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestationAddController extends AbstractController
{
    #[Route('/prestation/add', name: 'app_prestation_add')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $presta = new Prestation();

        $form = $this->createForm(PrestationType::class, $presta);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($presta);
            $entityManager->flush();

            return $this->redirectToRoute('app_prestation');
        }

        return $this->render('prestation_add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
