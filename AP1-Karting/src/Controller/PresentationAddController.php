<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PresentationAddController extends AbstractController
{
    #[Route('/presentation/add', name: 'app_presentation_add')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pres = new Presentation();

        $form = $this->createForm(PresentationType::class, $pres);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($pres);
            $entityManager->flush();

            return $this->redirectToRoute('app_presentation');
        }

        return $this->render('presentation_add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
