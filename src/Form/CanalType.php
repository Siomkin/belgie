<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CanalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => '* Наименование канала связи:'])
            ->add('beginEquip', null, ['label' => '* Оборудование начального узла:'])
            ->add('lines', null, ['label' => '* Линия(и):'])
            ->add(
                'beginPorts',
                CollectionType::class,
                [
                    'entry_type' => PortsType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
            ->add('endEquip', null, ['label' => '* Оборудование конечного узла:'])
            ->add(
                'endPorts',
                CollectionType::class,
                [
                    'entry_type' => PortsEndType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
            ->add('isActiveSw', null, ['label' => 'Активный']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => \App\Entity\Canal::class,
            ]
        );
    }
}
