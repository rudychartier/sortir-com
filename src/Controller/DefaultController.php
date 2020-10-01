<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Sorties;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/",name="home")
     */
    public function Home()
    {

        $user= $this->getUser();
        $sortieRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties = $sortieRepo->findAll();
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus = $campusRepo->findAll();
        return $this->render("sorties/list.html.twig",['user'=>$user,'campus'=>$campus,'sorties'=>$sorties]);
        //return $this->redirectToRoute('sorties/list.html.twig',['user'=>$user]);
    }
}
