<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Lieux;
use App\Entity\Sorties;

use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class SortiesController extends AbstractController
{

    /**
     * @Route("/list")
     */
    public function list()
    {
        // recup sorties  en bdd
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortieRepo->findAll();
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus = $campusRepo->findAll();
        return $this->render('sorties/list.html.twig', ["sorties"=>$sorties,"campus"=>$campus]);
    }

    /**
     * @Route("/detail/{id}", name="detail", requirements={"id":"\d+"})
     */
    // methode seulement get à spécifier
    public function detail($id,EntityManagerInterface $em,Request $request)
    {
        // recup detail sorties en bdd
        $sortieRepo = $em->getRepository(Sorties::class);
        $sorties =$sortieRepo->find($id);
        return $this->render('sorties/detail.html.twig', ["sorties"=>$sorties]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        //créer la sortie , traiter + sauvergarder dans la bdd

        $sortie = new Sorties();

       $sortie->setOrganisateur($this->getUser());
       // $sortie->setNbinscriptionsmax(10);
        $sortieForm = $this->createForm(SortieType::class,$sortie);
        $sortieForm->handleRequest($request);
        // set = donnees enregistrées du user
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Votre sortie est bien sauvergardée!");
            return $this->redirectToRoute("detail", ["id" => $sortie->getId()]);
        }

        // VERIFIER LE NOM DE CHEMIN SUR LEQUEL JE DOIS RENVOYER
        return $this->render('sorties/sortie.html.twig', ["sortieForm" => $sortieForm->createView()]);
    }

    /**
     * @Route("/delete", name="delete")
     */
    public function delete($id,EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sortie = $sortieRepo->findBy($id);

        $em->remove($sortie);
        $em->flush();
        // VOIR SI CHEMIN EN HOME OU EN MAIN
        $this->addFlash('success', "La sortie a été supprimée!");
        return $this->redirectToRoute('cancel');

    }
    /**
     * @Route("/modifier/{id}", name="modifier", requirements={"id":"\d+"})
     */
    //méthode detail qui permet d'afficher sur une page un évènement particulier enregistré en BDD
    public function edit($id,EntityManagerInterface $em,Request $request)
    {
        //récupérer les sorties en base de donnée
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        //findAll permet de récupérer toute les sorties enregistrées.
        $sortie = $sortieRepo->find($id);
        $sortieForm = $this->createForm(SortieType::class,$sortie);
        $sortieForm->handleRequest($request);
        // set = donnees enregistrées du user
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Votre sortie est bien sauvergardée!");
            return $this->redirectToRoute("detail", ["id" => $sortie->getId()]);
        }


        return $this->render('sorties/modifier.html.twig', [
            "sortieForm" => $sortieForm->createView()
        ]);
    }


    /**
     * @Route("/cancel", name="cancel")
     */
    public function cancel ()
    {
        //annuler la sortie
        return $this->render('sorties/modifier.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }

}