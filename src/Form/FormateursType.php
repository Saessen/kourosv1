<?php

namespace App\Form;

use App\Entity\Formateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FormateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denominationSociale')
            ->add('siret')
            ->add('nom')
            ->add('prenom')
            ->add('mail', EmailType::class)
            ->add('tel')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('tva')
            ->add('methode', ChoiceType::class, ['choices'=>['Distanciel'=>1, 'Présenciel'=>2, 'Distanciel & Présenciel'=>3]])
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
