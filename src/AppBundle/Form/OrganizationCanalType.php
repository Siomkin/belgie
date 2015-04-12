<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganizationCanalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
            'canals',
            'choice',
            array(
                'choices' => $options['data'],
                'label' => 'Каналы',
                'multiple' => true,
                'expanded' => true,
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
            array(// 'data_class' => 'AppBundle\Entity\Canal'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_organization_canal';
    }

}