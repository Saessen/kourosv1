<?php

namespace App\Form;

use App\Entity\Opco;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpcoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('nomContact')
            ->add('prenomContact')
            ->add('mail')
            ->add('tel')
            ->add('adresse')
            ->add('ville')
            ->add('codePostal')
            ->add('tva')
            ->add('site')
            ->add('ape')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Opco::class,
        ]);
    }
}
