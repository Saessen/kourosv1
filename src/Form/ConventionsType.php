<?php

namespace App\Form;

use App\Entity\Conventions;
use App\Entity\Participants;
use App\Form\ParticipantsType;
use Symfony\Component\Form\AbstractType;
use App\Form\ConventionsParticipantsType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ConventionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieuFormation')
            ->add('prospect')
            ->add('devis')
            ->add('commentaire')
            // ANCHOR
            ->add('participants', CollectionType::class, [
                'entry_type' => ParticipantsType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conventions::class,
        ]);
    }
}
