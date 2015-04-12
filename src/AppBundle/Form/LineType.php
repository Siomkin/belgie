<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => '* Наименование линии:'))
            ->add('code', null, array('label' => '* Внутренний идентификатор(код):'))
            ->add('nodeLength', null, array('label' => '* Протяженность участка между узлами:'))
            ->add('cableType', null, array('label' => '* Тип:'))
            ->add('cableMark', null, array('label' => '* Маркировка:'))
            ->add('cableCap', null, array('label' => '* Емкость:'))
            ->add('capacity', null, array('label' => '* Задействов. емкость кабеля:'))
            ->add('isActiveSw', null, array('label' => 'Активный'))
            ->add(
                'destinationsBegin',
                new DestinationsType(),
                array(
                    'required' => false
                )
            )->add(
                'destinationsEnd',
                new DestinationsType(),
                array(
                    'required' => false
                )
            );

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Line',
                'cascade_validation' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_line';
    }
}
