<?php

namespace App\Form;

use App\Entity\Canal;
use App\Entity\PortsEnd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortsEndType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('portId', null, ['label' => '* Идентификатор (номер) порта оборудования:'])
            ->add(
                'interface',
                ChoiceType::class,
                [
                    'choices' => Canal::getPortInterfaces(),
                    'label' => '* Наименование канала связи:',
                    'empty_data' => null,
                    'attr' => ['class' => 'form-control'],
                ]
            )
            ->add('speed', null, ['label' => '* скорость передачи'])
            ->add(
                'type',
                ChoiceType::class,
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
                'data_class' => PortsEnd::class,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_ports_end';
    }
}
