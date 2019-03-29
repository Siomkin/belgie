<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => '* Наименование линии:'])
            ->add('code', null, ['label' => '* Внутренний идентификатор(код):'])
            ->add('nodeLength', null, ['label' => '* Протяженность участка между узлами:'])
            ->add('cableType', null, ['label' => '* Тип:'])
            ->add('cableMark', null, ['label' => '* Маркировка:'])
            ->add('cableCap', null, ['label' => '* Емкость:'])
            ->add('capacity', null, ['label' => '* Задействов. емкость кабеля:'])
            ->add('isActiveSw', null, ['label' => 'Активный'])
            ->add(
                'destinationsBegin',
                new DestinationsType(),
                [
                    'required' => false,
                ]
            )->add(
                'destinationsEnd',
                new DestinationsType(),
                [
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => 'App\Entity\Line',
                'cascade_validation' => true,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_line';
    }
}
