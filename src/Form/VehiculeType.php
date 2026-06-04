<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\UserRepository;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('imageFile', VichImageType::class, [
                'label'=> 'Image du véhicule',
                'label_attr' => [
                    'class'=> 'form-label mt-4',
                ]
            ])

            ->add('immatriculation')
            ->add('prix', MoneyType::class, [
                'label' => 'Prix',
                'constraints' => [
                  new Positive(
                    message: 'Le prix ne peut être négatif'
                  )  
                ]
            ])
            ->add('anneeMiseEnCirculation')
            ->add('kms')
            ->add('estDisponible')
            ->add('user', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'email',
            'label' => 'Propriétaire du véhicule',
            'query_builder' => function (UserRepository $ur) {
                return $ur->createQueryBuilder('u')
                    ->orderBy('u.email', 'ASC');
            }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
