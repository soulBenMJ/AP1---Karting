<?php

namespace App\Controller;

use App\Entity\Prestation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestationSuppressionController extends AbstractController
{
    #[Route('/prestation/suppression/{id}', name: 'app_prestation_suppression')]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Prestation $presta = null, EntityManagerInterface $entityManager): Response
    {

        if (!$presta) {
            $this->addFlash('danger', 'Prestation non trouvée.');
            return $this->redirectToRoute('app_prestation');
        }

        if ($this->isCsrfTokenValid('delete'.$presta->getId(), $request->request->get('_token'))) {

            if ($this->isGranted('ROLE_ADMIN') || $presta->getUser() === $this->getUser()) {
                $entityManager->remove($presta);
                $entityManager->flush();

                $this->addFlash('success', 'Prestation supprimée avec succès.');
            } else {
                $this->addFlash('danger', 'Vous n&emp;avez pas les droits pour supprimer cette prestation.');
            }
        }

        return $this->redirectToRoute('app_prestation');
    }
}
