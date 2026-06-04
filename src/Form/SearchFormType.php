<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Data\SearchDataTest;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minPrice', NumberType::class, [
                'label'=> 'false',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Prix min'
                ]
            ])
            ->add('maxPrice', NumberType::class, [
                'label'=> 'false',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Prix max'
                ]
            ])
            ->add('minKms', NumberType::class, [
                'label'=> 'false',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Kms min'
                ]
            ])
            ->add('maxKms', NumberType::class, [
                'label'=> 'false',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Kms max'
                ]
            ])
            ->add('minYear', NumberType::class, [
                'label'=> 'false',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Année min'
                ]
            ])
            ->add('maxYear', NumberType::class, [
                'label'=> 'false',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Année max'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"=> SearchDataTest::class,
            'method' =>'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
