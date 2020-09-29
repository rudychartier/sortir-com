<?php

namespace App\Controller;


use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\ProfilType;
use App\Form\SortieType;
use App\Security\Authenticator;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Provider\sr_Latn_RS\Address;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

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
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request,
                             EntityManagerInterface $em,
                             UserPasswordEncoderInterface $encoder)
    {
        $user= new Participants();
        //Les entités devraient être au singulier
        //rudy rate tout
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

    /**
     * @Route("/afficher_profil/{pseudo}", name="afficher_profil")
     */
    public function afficherProfil($pseudo){

        $profilRepo= $this->getDoctrine()->getRepository(Participants::class);

        $profil=$profilRepo->find($pseudo);

        return $this->render("user/afficher_profil.html.twig",["profil"=>$profil]);

    }



    /**
     * @Route("/app_profil", name="app_profil")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param Authenticator $authenticator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profil(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, Authenticator $authenticator)
{
        //$user = new User();
        $participants = $this->getParticipants();
        $form = $this->createForm(ProfilType::class, $participants);
        $participants-> setAdministrateur(false);
        $participants-> setActif(true);
        $participants-> setRoles([]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $participants->setPassword(
                $passwordEncoder->encodePassword(
                    $participants,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participants);
            $entityManager->flush();
            // generate a signed url and email it to the user
           // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $participants,
//                (new TemplatedEmail())
//                    ->from(new Address('no-reply@sortir.com', 'Rocky Sorty'))
//                    ->to($participants->getEmail())
//                    ->subject('Cliquer sur le lien pour confirmer votre email.')
//                    //->htmlTemplate('registration/confirmation_email.html.twig')
//            );
            // do anything else you need here, like send an email
            return $guardHandler->authenticateUserAndHandleSuccess(
                $participants,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }
        return $this->render('user/profil.html.twig', [
            'profilForm' => $form->createView(),
        ]);



}
}
