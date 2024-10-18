<?php

namespace App\Controller;

use App\Entity\Presentation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PresentationSuppressionController extends AbstractController
{
    #[Route('/presentation/suppression/{id}', name: 'app_presentation_suppression')]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Presentation $pres = null, EntityManagerInterface $entityManager): Response
    {

        if (!$pres) {
            $this->addFlash('danger', 'Presentation non trouvée.');
            return $this->redirectToRoute('app_presentation');
        }

        if ($this->isCsrfTokenValid('delete'.$pres->getId(), $request->request->get('_token'))) {

            if ($this->isGranted('ROLE_ADMIN') || $pres->getUser() === $this->getUser()) {
                $entityManager->remove($pres);
                $entityManager->flush();

                $this->addFlash('success', 'Presentation supprimée avec succès.');
            } else {
                $this->addFlash('danger', 'Vous n&emp;avez pas les droits pour supprimer cette presentation.');
            }
        }

        return $this->redirectToRoute('app_presentation');
    }
}
