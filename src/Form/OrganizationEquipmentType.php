<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizationEquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'equipments',
            'choice',
            [
                'choices' => $options['data'],
                'label' => 'Оборудование',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [// 'data_class' => 'App\Entity\Canal'
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_organization_equipment';
    }
}
