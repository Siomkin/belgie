<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', null, array('label' => '* Внутренний идентификатор (код):'))
            ->add('vendor', null, array('label' => '* Производитель оборудования:'))
            ->add('model', null, array('label' => '* Марка(модель):'))
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
                array(
                    'required' => false
                )
            )
            ->add('type', null, array('label' => '* Тип оборуд. по назначению:'))
            ->add('isActiveSw', null, array('label' => 'Активный'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Equipment',
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
            )

        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_equipment';
    }
}
