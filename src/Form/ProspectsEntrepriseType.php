<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProspectsEntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denominationSociale')
            ->add('siren')
            ->add('activite')
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('mail')
            ->add('nomFacultatif')
            ->add('prenomFacultatif')
            ->add('mailFacultatif')
            ->add('telFacultatif')
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
