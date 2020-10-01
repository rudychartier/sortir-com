<?php

namespace App\Form;

use App\Entity\Sorties;
use http\Env\Url;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\DateTime;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Ajoute les champs requis ainsi que les types
        //Pas Obligatoire mais on peut rajouter des options(label) ou/et des attributs (class)
        $builder

            //Creation du champ nom


            ->add('nom', Texttype::class, [
                'label'=> 'Titre de l evenement'])

            ->add('descriptioninfos', TextareaType::class, [
                'label'=> 'Descriptif de l evenement'])


            //Creation du champ date de debut
            ->add('datedebut', DateType::class, [
                'placeholder' => [
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Day',
                ],

                'label'=> "Date du Debut d'Inscription"
            ])


            //Creation du champ date de cloture

            ->add('datecloture', DateType::class, [
                'placeholder' => [
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Day',
                ],

                'label'=> "Date de fin de l'inscription"
            ])
            ->add('nbinscriptionsmax',NumberType::class,[
                'label'=>'Nombre de places',

            ])

            //Creation du champ duree
            ->add('duree',NumberType::class,[
                'label'=> "Durée en minutes"
            ])
            ->add('descriptioninfos', TextareaType::class, [
                'label'=> 'Description de l evenement'])



            //Creation du champ urlphoto
            //->add('urlphoto',TexteType::class, [
            //    'label'=>"Photo"
            //])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //Associer formulaire à la classe Sortie
        $resolver->setDefaults([
            'date_class'=>Sorties::class,
        ]);
    }
}