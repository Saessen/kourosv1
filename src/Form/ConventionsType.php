<?php

namespace App\Form;

use App\Entity\Conventions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConventionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieuFormation')
            ->add('nomParticipants')
            ->add('prenomParticipants')
            ->add('prospect')
            ->add('devis')
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conventions::class,
        ]);
    }
}
