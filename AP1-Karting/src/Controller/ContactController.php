<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $email = $contact->getEmail();
            
            
            $existingContact = $entityManager->getRepository(Contact::class)
                ->findOneBy(['email' => $email]);
            
            if ($existingContact) {
                
                $form->get('email')->addError(new FormError('Cet email est déjà utilisé.'));
            } else {
                
                $entityManager->persist($contact);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
            }
        }
        $contactList = $entityManager->getRepository(Contact::class)->findAll();

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'contactList' => $contactList,
        ]);
    }
}
