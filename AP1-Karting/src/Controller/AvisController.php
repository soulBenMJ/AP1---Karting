<?php

namespace App\Controller;

use App\Entity\Avis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $avisList = $entityManager->getRepository(Avis::class)->findAll();

        return $this->render('avis/index.html.twig', [
            'avisList' => $avisList,
        ]);
    }

    #[Route('/avis/supprimer/{id}', name: 'avis_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Avis $avis = null, EntityManagerInterface $entityManager): Response
    {

        if (!$avis) {
            $this->addFlash('danger', 'Avis non trouvé.');
            return $this->redirectToRoute('app_avis');
        }

        if ($this->isCsrfTokenValid('delete'.$avis->getId(), $request->request->get('_token'))) {
            
            if ($this->isGranted('ROLE_ADMIN') || $avis->getUser() === $this->getUser()) {
                $entityManager->remove($avis);
                $entityManager->flush();

                $this->addFlash('success', 'Avis supprimé avec succès.');
            } else {
                $this->addFlash('danger', 'Vous n\'avez pas les droits pour supprimer cet avis.');
            }
        }

        return $this->redirectToRoute('app_avis'); 
    }
}
