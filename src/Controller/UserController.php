<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function register(Request $request,
                             EntityManagerInterface $em,
                             UserPasswordEncoderInterface $encoder)
    {
        $user= new Participants();

        $profilForm=$this->createForm(ProfilType::class,$user);
        $profilForm->handleRequest($request);
        $user->setAdministrateur(0);
        $user->setActif(1);
        if ($profilForm->isSubmitted()&& $profilForm->isValid())
        {
            $hashed=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hashed);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('user/profil.html.twig',[
            "profilForm"=>$profilForm->createView()]);
    }

}
