<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisCreerController extends AbstractController
{
    #[Route('/avis/creer', name: 'app_avis_creer')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $user = $this->getUser();
        $avis->setUser($user);

        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($avis);
            $entityManager->flush();

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('avis_creer/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
