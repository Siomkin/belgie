<?php

namespace AppBundle\Form;

use AppBundle\Entity\Canal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PortsEndType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('portId', null, array('label' => '* Идентификатор (номер) порта оборудования:'))
            ->add(
                'interface',
                'choice',
                array(
                    'choices' => Canal::getPortInterfaces(),
                    'label' => '* Наименование канала связи:',
                    'empty_data' => null
                )
            )
            ->add('speed', null, array('label' => '* скорость передачи'))
            ->add(
                'type',
                'choice',
                array(
                    'choices' => Canal::getPortSpeedTypes(),
                    'label' => '* ед. изм:',
                    'empty_data' => null
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
                'data_class' => 'AppBundle\Entity\PortsEnd'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_ports_end';
    }
}
