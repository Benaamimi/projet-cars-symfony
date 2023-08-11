<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Vehicule;
use App\Form\CommandeType;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(VehiculeRepository $repo): Response
    {
        $vehicules = $repo->findAll();

        return $this->render('home/index.html.twig', [
            "vehicules" =>  $vehicules
        ]);
    }

    #[Route('/show/{id}', name:"vehicule_show")]
    public function show($id, VehiculeRepository $repo, Request $request, EntityManagerInterface $manager)
    {

        $commande = new Commande;
    

        $form = $this->createForm(CommandeType::class, $commande );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $commande->setDateEnregistrement(new \datetime);

            $manager->persist($commande);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

       
        $vehicule = $repo->find($id) ;
        // dd($article);
        return $this->render('home/show.html.twig', [
            'vehicule' => $vehicule,
            'commandeForm' => $form,
        ]);
    }

   

   
}
