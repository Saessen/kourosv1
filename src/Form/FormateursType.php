<?php

namespace App\Form;

use App\Entity\Formateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denominationSociale')
            ->add('siret')
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('tel')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('tva')
            ->add('methode')
            ->add('formations')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formateurs::class,
        ]);
    }
}
