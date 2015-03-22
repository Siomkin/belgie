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
            ->add('name')
            ->add('code')
            ->add('nodeLength')
            ->add('cableType')
            ->add('cableMark')
            ->add('cableCap')
            ->add('capacity')
            ->add('isActiveSw')
            ->add('destinationsEnd')
            ->add('destinationsBegin')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Line'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_line';
    }
}
