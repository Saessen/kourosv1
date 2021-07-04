<?php

namespace App\Form;

use App\Entity\Formations;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FormationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('prixJour')
            ->add('programme', CKEditorType::class)
            ->add('niveau', ChoiceType::class, ['placeholder'=>'Quel est le niveau : ', 'choices'=>
            ['Initiation'=>1, 'Intermédiaire'=>2, 'Perfectionnement'=>3]])
            ->add('rubrique', ChoiceType::class, ['placeholder'=>'Quel est la rubrique : ', 'choices'=>[
            '3D'=>1, 'Architecture 3D'=>2, 'Audiovisuel'=>4,'BIM'=>5, 'Bureautique'=>6, 'CAO-DAO'=>7,'Cartographie'=>8, 'Commercial'=>9, 'Communication'=>10,'Comptabilité'=>11, 'Développement'=>12, 'Droit'=>13, 'Immobilier'=>14, 'Imprimerie'=>15, 'Infographie 3D'=>16, 'Informatique'=>17, 'Ingénierie'=>18, 'Langues'=>19,'Maîtrise d\'oeuvre'=>20, 'PAO'=>21, 'Web'=>22]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formations::class,
        ]);
    }
}
