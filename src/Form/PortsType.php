<?php

namespace App\Form;

use App\Entity\Canal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('portId', null, ['label' => '* Идентификатор (номер) порта оборудования:'])
            ->add(
                'interface',
                'choice',
                [
                    'choices' => Canal::getPortInterfaces(),
                    'label' => '* Наименование канала связи:',
                    'empty_data' => null,
                ]
            )
            ->add('speed', null, ['label' => '* скорость передачи'])
            ->add(
                'type',
                'choice',
                [
                    'choices' => Canal::getPortSpeedTypes(),
                    'label' => '* ед. изм:',
                    'empty_data' => null,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => 'App\Entity\Ports',
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_ports';
    }
}
