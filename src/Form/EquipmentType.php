<?php

namespace App\Form;

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
                new DestinationsType(),
                [
                    'required' => false,
                ]
            )
            ->add('type', null, ['label' => '* Тип оборуд. по назначению:'])
            ->add('isActiveSw', null, ['label' => 'Активный']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => 'App\Entity\Equipment',
                'cascade_validation' => true, //needed to validate embeed forms.
                // 'validation_groups' => array('registration'), //use of validation groups.
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
                // a unique key to help generate the secret token
                //'intention' => 'task_item',
                /* 'validation_groups' => function (FormInterface $form) {
                     $data = $form->getData();
                     dump($data->getDestinations()->getType());
                     if (0 === $data->getType()) {
                         return array('address');
                     } else {
                         return array('latitude');
                     }
                 },*/
                // 'validation_groups' => array('address')
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_equipment';
    }
}
