<?php

namespace App\Form;

use App\Entity\Line;
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
                DestinationsType::class,
                [
                    'required' => false,
                ]
            )->add(
                'destinationsEnd',
                DestinationsType::class,
                [
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Line::class,
                'cascade_validation' => true,
            ]
        );
    }
}
