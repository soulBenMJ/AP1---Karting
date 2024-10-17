<?php

namespace App\Controller;

use App\Entity\Prestation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Annotation\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\PrestationType; 

class PrestationModifController extends AbstractController
{
    #[Route('/prestation/modif/{id}', name: 'app_prestation_modif')]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Prestation $presta = null, EntityManagerInterface $entityManager): Response
    {
        // Vérifie si la prestation existe
        if (!$presta) {
            $this->addFlash('danger', 'Prestation non trouvée.');
            return $this->redirectToRoute('app_prestation');
        }

        // Vérifie si l'utilisateur a les droits pour modifier la prestation
        if (!$this->isGranted('ROLE_ADMIN') && $presta->getUser() !== $this->getUser()) {
            $this->addFlash('danger', 'Vous n&emp;avez pas les droits pour modifier cette prestation.');
            return $this->redirectToRoute('app_prestation');
        }

        // Crée le formulaire pour modifier la prestation
        $form = $this->createForm(PrestationType::class, $presta);  // Utilise ton propre formulaire (PrestationType)
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();  // Sauvegarde les changements en base de données
            $this->addFlash('success', 'Prestation modifiée avec succès.');
            return $this->redirectToRoute('app_prestation');  // Redirige vers la liste des prestations
        }

        // Rendu de la vue avec le formulaire
        return $this->render('prestation_modif/index.html.twig', [
            'form' => $form->createView(),
            'presta' => $presta,
        ]);
    }
}
