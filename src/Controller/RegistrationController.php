<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Membre;
use App\Form\RegistrationFormType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    // #[Route('membre/modifier/{id}', name:'membre_modifier')]
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager/*, Membre $user = null*/): Response
    {
        
        // if($user == null)
        // {
            $user = new Membre;
        // }
        

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $user->setDateEnregistrement(new \datetime);
                // $user->setRoles();
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'editMode' => $user->getId() !== null,
        ]);
    }

// -------------------------test modifier membre-------------------------

    #[Route('membre/modifier/{id}', name:'membre_modifier')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager, Membre $user = null): Response
    {
        
    {
          
        if($user == null)
        {
            $user = new Membre;
        }
        

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

       
        
        if ($form->isSubmitted() && $form->isValid()) 
        {

           
            

            $user->setDateEnregistrement(new \datetime);
            // $user->setPassword();
                

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('membre_gestion');
        }

        return $this->render('/admin/membre/modifier.html.twig', [
            'registrationForm' => $form/*->createView()*/,
            'editMode' => $user->getId() !== null,
        ]);
    }

    }


 

   
}
