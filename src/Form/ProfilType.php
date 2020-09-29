<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participants;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        $builder
//            ->add('pseudo',TextType::class,['label'=>'Pseudo'])
//            ->add('prenom')
//            ->add('nom')
//            ->add('telephone')
//            ->add('email',EmailType::class)
//            ->add('password',RepeatedType::class,[
//                'type' => PasswordType::class,
//                'invalid_message' => 'The password fields must match.',
//                'required' => true,
//                'first_options'  => ['label' => 'Password'],
//                'second_options' => ['label' => 'Repeat Password'],
//            ])
//            ->add('campus',EntityType::class,['class'=>Campus::class,
//                'choice_label'=>'nom_campus']);*/
//
//        $builder
//            /*//Création du champs pseudo
//            ->add("pseudo", TextType::class, ['label'=>'Login',
//                'required'   => true,])
//            //Création du champs nom
//            ->add('nom',TextType::class, ['label'=>'Nom',
//                'required'   => true,])
//            //Création du champs prénom
//            ->add('prenom',TextType::class, ['label'=>'Prénom',
//                'required'   => true,])
//            //Création du champs télephone
//            ->add('telephone', NumberType::class, ['label'=>'Téléphone',
//                'required'   => true,])
//            //Création du champs mot de pas avec double confirmation
//            ->add('password',RepeatedType::class, [
//                'type' => PasswordType::class,
//                'invalid_message' => 'Les mots de passe ne sont pas identifques.',
//                'options' => ['attr' => ['class' => 'Champs de mot de passe']],
//                'required' => true,
//                'first_options'  => ['label' => 'Mot de passe'],
//                'second_options' => ['label' => 'Confirmer le mot de passe']])
//            ->add('email',EmailType::class)
//            //Affichage du contenu de l'entité campus sur le choix du labelle inscrit dans la bdd
//           ->add('campus', EntityType::class, [
//                'class' => Campus::class,
//                'choice_label' => 'nom_campus',])
//
//        ;
//    }*/
public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('pseudo', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class,
                ['type' => PasswordType::class,
                    'invalid_message' => 'Les deux mots de passe doivent correspondre',
                    'required' => true,
                    'mapped' => false,
                    'constraints' => [new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe devrait posséder au moins {{ limit }} caractères',
                        'max' => 255,
                        'maxMessage' => 'Votre mot de passe devrait posséder au plus {{ limit }} caractères',
                    ]),
                    ],
                    'first_options' => ['label' => 'Mot de passe :'],
                    'second_options' => ['label' => 'Confirmer le mot de passe :']])
            ->add('telephone', TelType::class)
            ->add('campus', EntityType::class, ['label' => 'Campus :', 'class' => Campus::class])
        ;
    }




    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}