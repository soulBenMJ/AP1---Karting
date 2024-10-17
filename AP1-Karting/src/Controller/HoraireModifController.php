<?php

namespace App\Controller;

use App\Entity\Ouverture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Annotation\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\HoraireType; 

class HoraireModifController extends AbstractController
{
    #[Route('/horaire/modif/{id}', name: 'app_horaire_modif')]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Ouverture $hrr = null, EntityManagerInterface $entityManager): Response
    {
        // Vérifie si la prestation existe
        if (!$hrr) {
            $this->addFlash('danger', 'Horaire non trouvé.');
            return $this->redirectToRoute('app_accueil');
        }

        // Vérifie si l'utilisateur a les droits pour modifier la prestation
        if (!$this->isGranted('ROLE_ADMIN') && $hrr->getUser() !== $this->getUser()) {
            $this->addFlash('danger', 'Vous n&emp;avez pas les droits pour modifier cet horaire.');
            return $this->redirectToRoute('app_accueil');
        }

        // Crée le formulaire pour modifier la prestation
        $form = $this->createForm(HoraireType::class, $hrr);  // Utilise ton propre formulaire (PrestationType)
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();  // Sauvegarde les changements en base de données
            $this->addFlash('success', 'Horaire modifié avec succès.');
            return $this->redirectToRoute('app_accueil');  // Redirige vers la liste des prestations
        }

        // Rendu de la vue avec le formulaire
        return $this->render('horaire_modif/index.html.twig', [
            'form' => $form->createView(),
            'hrr' => $hrr,
        ]);
    }
}
