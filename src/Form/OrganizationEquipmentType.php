<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class OrganizationEquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'equipments',
            ChoiceType::class,
            [
                'choices' => $options['data'],
                'label' => 'Оборудование',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ]
        );
    }
}
