<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CanalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => '* Наименование канала связи:'))
            ->add('beginEquip', null, array('label' => '* Оборудование начального узла:'))
            ->add('lines', null, array('label' => '* Линия(и):'))
            ->add(
                'beginPorts',
                'collection',
                array(
                    'type' => new PortsType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    // 'prototype' => true
                )
            )
            ->add('endEquip', null, array('label' => '* Оборудование конечного узла:'))
            ->add(
                'endPorts',
                'collection',
                array(
                    'type' => new PortsEndType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    // 'prototype' => true
                )
            )
            ->add('isActiveSw', null, array('label' => 'Активный'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Canal'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_canal';
    }

}
