<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InscriEtudiantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe',EntityType::class,[
                'class' =>  Classe::class,
                'choice_label' => 'libelle',
            ])
            ->add('anneescolaire',EntityType::class,[
                'class' =>  AnneeScolaire::class,
                'choice_label' => 'libelle',
            ])
            ->add('Ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
