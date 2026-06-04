<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\EtatDemande;
use App\Entity\GenreDemande;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sujet')
            ->add('contenuMessage')
            ->add('genreDemande', EntityType::class, [
                // looks for choices from this entity
                'class' => GenreDemande::class,
                'choice_label' => 'libelleGenreDemande',
                ])
            ->add('vehicule', EntityType::class, [
                // looks for choices from this entity
                'class' => Vehicule::class,
                'choice_label' => 'libelle',
                ])
            ->add('etatDemande', EntityType::class, [
                // looks for choices from this entity
                'class' => EtatDemande::class,
                'choice_label' => 'libelleEtatDemande',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
