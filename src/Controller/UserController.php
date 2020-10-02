<?php

namespace App\Controller;


use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\ProfilType;
use App\Form\SortieType;
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
        //Les entités devraient être au singulier
        $profilForm=$this->createForm(ProfilType::class,$user);
        $profilForm->handleRequest($request);
        $user->setAdministrateur(0);
        $user->setActif(1);
        //$user->setRoles(['ROLE_ADMIN']);
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

    /**
     * @Route("/afficher_profil/{pseudo}", name="afficher_profil")
     */
    public function afficherProfil($pseudo){

        $profilRepo= $this->getDoctrine()->getRepository(Participants::class);

        $profil=$profilRepo->find($pseudo);

        return $this->render("user/afficher_profil.html.twig",["profil"=>$profil]);

    }

}
