<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note', ChoiceType::class, [
                    'choices' => [
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4'=> 4,
                        '5'=> 5
                    ]
                 ])
               
            ->add('titre')
            ->add('contenuMessageAvis')
            ->add('user', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                'choice_label' => 'email',
                ])
                ->add('approved', ChoiceType::class, [
                    'choices' => [
                        'Oui' => true,
                        'Non' => false,
                        
                    ]
                 ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
