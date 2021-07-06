<?php

namespace App\Form;

use App\Entity\Prospects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProspectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statut', ChoiceType::class, ['placeholder'=>'Souhaitez vous enregistrer une entreprise ou un particulier ', 'choices'=>
            ['Entreprise'=>1, 'Particulier'=>2]])
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('tel')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('site')
            ->add('entreprise')
            ->add('commentaire')
            ->remove('role', ChoiceType::class, ['placeholder'=>'prospect ou client', 'choices'=>
            ['Prospect'=>0, 'Client'=>1]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prospects::class,
        ]);
    }
}
