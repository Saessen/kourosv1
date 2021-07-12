<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbrParticipants')
            ->add('tva')
            ->add('dateCreation', DateType::class, ['widget'=> 'single_text'], ['label'=>'Création du devis'])
            ->add('dateDebut', DateType::class, ['widget'=> 'single_text'], ['label'=>'Début de la formation'])
            ->add('dateFin', DateType::class, ['widget'=> 'single_text'], ['label'=>'Fin de la formation'])
            ->add('dureeH')
            ->add('numeroDevis')
            ->add('methode', ChoiceType::class, ['choices'=> ['Distanciel'=>1, 'Présenciel'=>2, 'Distanciel & Présenciel'=>3]])
            ->add('fraisAnnexes')
            ->add('formations')
            ->add('client')
            ->add('nomContact')
            ->add('opco')
            ->add('statut', ChoiceType::class, ['choices'=> ['En cours'=>0, 'Accepté'=>1, 'Rejeté'=>2]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
