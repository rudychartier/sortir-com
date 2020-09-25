<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route ("/sortie", name="sortie_")
 */

class SortieController extends AbstractController
{

    /**
     * @Route("/list", name="list")
     */
    public function list(EntityManagerInterface $em)
    {
        // recup sorties  en bdd
        $sortieRepo = $em->getRepository(Sortie::class);
        $sorties = $sortieRepo->find();
        return $this->render('sortie/list.html.twig', ["sorties"=>$sorties]);
    }

    /**
     * @Route("/detail/{id}", name="detail", requirements={"id":"\d+"})
     */
    // methode seulement get à spécifier
    public function detail($id,EntityManagerInterface $em,Request $request)
    {
        // recup detail sorties en bdd
        $sortieRepo = $em->getRepository(Sortie::class);
        $sorties =$sortieRepo->find($id);
        return $this->render('sortie/detail.html.twig', ["sorties"=>$sorties]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        //créer la sortie , traiter + sauvergarder dans la bdd
        $sortie = new Sortie();

        $sortieForm = $this->createForm(SortieType::class,$sortie);

        $sortieForm->handleRequest($request);
        // set = donnees enregistrées du user
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Votre sortie est bien sauvergardée!");
            return $this->redirectToRoute("sortie_detail", ["id" => $sortie->getId()]);
        }

        // VERIFIER LE NOM DE CHEMIN SUR LEQUEL JE DOIS RENVOYER
        return $this->render('sortie/sortie.html.twig', ["sortieForm" => $sortieForm->createView()]);
    }

    /**
     * @Route("/delete", name="delete")
     */
    public function delete($id,EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $sortieRepo->findBy($id);

        $em->remove($sortie);
        $em->flush();
        // VOIR SI CHEMIN EN HOME OU EN MAIN
        $this->addFlash('success', "La sortie a été supprimée!");
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/cancel", name="cancel")
     */
    public function cancel ()
    {
        //annuler la sortie
        return $this->render('sortie/cancel.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }

}