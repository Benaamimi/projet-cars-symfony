<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Vehicule;
use App\Form\MemberType;
use App\Form\VehiculeType;
use App\Repository\MembreRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }




    #[Route('/modifier/{id}', name:'vehicule_modifier')]
    #[Route('/ajout', name: 'vehicule_ajout')]
    public function ajout(Request $request, EntityManagerInterface $manager, Vehicule $vehicule = null): Response
    {
        if($vehicule == null)
        {
            $vehicule = new Vehicule;
        }

        $form = $this->createForm(VehiculeType::class, $vehicule );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $vehicule->setDateEnregistrement(new \datetime);

            $manager->persist($vehicule);
            $manager->flush();
            return $this->redirectToRoute('vehicule_gestion');
        }

        return $this->render('admin/vehicule/form.html.twig', [
            'formVehicule' => $form,
            'editMode' => $vehicule->getId() !== null,
        ]);
    }




    #[Route('/gestion', name:'vehicule_gestion')]
    public function gestion(VehiculeRepository $repo) : Response
    {
        $vehicules = $repo->findAll();
        return $this->render('admin/vehicule/gestion.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'vehicule_supprimer')]
    public function supprimer(Vehicule $vehicule, EntityManagerInterface $manager)
    {
        $manager->remove($vehicule);
        $manager->flush();
        return $this->redirectToRoute('vehicule_gestion');
    }


    // ---------------------membres---------------------------------------------//

    // #[Route('membre/modifier/{id}', name:'membre_modifier')]
    // #[Route('membre/ajout', name: 'membre_ajout')]
    // public function ajouter(Request $request, EntityManagerInterface $manager): Response
    // {
       
    //         $membre = new Membre;
        

    //     $form = $this->createForm(MemberType::class, $membre );
    //     $form->handleRequest($request);


        


    //     if($form->isSubmitted() && $form->isValid())
    //     {

    //         $membre->setDateEnregistrement(new \datetime);


    //         $manager->persist($membre);
    //         $manager->flush();
    //         return $this->redirectToRoute('membre_gestion');
    //     }

    //     return $this->render('admin/membre/form.html.twig', [
    //         'formMembre' => $form,
    //         'editMode' => $membre->getId() !== null,
    //     ]);
    // }


    
    #[Route('/membre/gestion', name:'membre_gestion')]
    public function gestionMember(MembreRepository $repo) : Response
    {
        $membres = $repo->findAll();
        return $this->render('admin/membre/gestion.html.twig', [
            'membres' => $membres,
        ]);
    }
    #[Route('membre/supprimer/{id}', name: 'membre_supprimer')]
    public function supprimermembre(Membre $membre, EntityManagerInterface $manager)
    {
        $manager->remove($membre);
        $manager->flush();
        return $this->redirectToRoute('membre_gestion');
    }


    

    
  
}
