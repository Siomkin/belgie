<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizationCanalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'canals',
            'choice',
            [
                'choices' => $options['data'],
                'label' => 'Каналы',
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
        return 'App_organization_canal';
    }
}
