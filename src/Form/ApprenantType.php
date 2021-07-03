<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ApprenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('date_naissance', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('lieu_naissance')
            ->add('sexe')
            ->add('niveau_etude')
            ->add('attente')
            ->add('email')
            ->add('formation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
