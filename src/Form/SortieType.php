<?php

namespace App\Form;

use App\Entity\Sortie;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;


class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom de la sortie'])
            ->add('datedebut', DateTimeType::class, ['label' => 'Date et heure de la sortie :',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'])
            ->add('datecloture', DateType::class, ['label' => 'Date limite dinscription : '])
            ->add('nbinscriptionsmax', TextType::class, ['label' => 'Nombre de places : '])
            ->add('duree', IntegerType::class, ['attr' => [' placeholder' => '90']])
            ->add('descriptioninfos', TextareaType::class, ['label' => 'Description et infos : '])
            ->add('lieux',null)
            ->add ('Campus', TextType::class,['label'=>'Campus'])
            //->add('Ville', ChoiceType::class,[]);

            /*  if ($builder->getData()->getLieu()) {
                  $builder->add('ville', EntityType::class, [
                      //'class' => Ville::class,
                      'mapped' => false,
                      'data' => $builder->getData()->getLieu()->getVille(),
                      'placeholder' => 'Choisissez une ville',
                      'choice_label' => 'nom',
                  ]);
                  //si c'est une creation
              } else {
                  $builder->add('ville', EntityType::class, [
                      // 'class' => Ville::class,
                      'mapped' => false,
                      'placeholder' => 'Choisissez une ville',
                      'choice_label' => 'nom',
                  ]);*/

            // ->add('etatsortie')
            // ->add('urlPhoto')
            // ->add('organisateur')
            //   ->add('lieux_no_lieu', ChoiceType::class,['label'=>'Ville ' ,])
            //   ->add('etats_no_etat')
        ;

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}