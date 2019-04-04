<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', null, ['label' => '* Внутренний идентификатор (код):'])
            ->add('vendor', null, ['label' => '* Производитель оборудования:'])
            ->add('model', null, ['label' => '* Марка(модель):'])
            /* ->add(
                 'destinations',
                 'collection',
                 array(
                     'type' => new DestinationsType(),
                     'allow_add' => true,
                     'allow_delete' => true,
                     'by_reference' => false,
                    // 'prototype' => true
                 )
             )*/
            ->add(
                'destinations',
                DestinationsType::class,
                [
                    'required' => false,
                ]
            )
            ->add('type', null, ['label' => '* Тип оборуд. по назначению:'])
            ->add('isActiveSw', null, ['label' => 'Активный']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Equipment::class,
                // 'cascade_validation' => true,
            ]
        );
    }
}
