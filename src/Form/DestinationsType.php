<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DestinationsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', null, array('label' => 'Координаты'))
            ->add('addressCity', null, array('label' => '* Населенный пункт:'))
            ->add('addressRegion', null, array('label' => '* Область, район:'))
            ->add('addressStreet', null, array('label' => '* Улица:','empty_data' => null,'placeholder' => 'Выберите'))
            ->add('addressIndex', null, array('label' => '* Индекс:'))
            ->add('addressBuildingNumber', null, array('label' => '* № Дома-корпус:'))
            ->add('addressOfficeNumber', null, array('label' => '№ Офиса, комнаты или квартиры:'))
            ->add('latitudeDeg', null, array('label' => '* градусы:'))
            ->add('latitudeMin', null, array('label' => '* минуты:'))
            ->add('latitudeSec', null, array('label' => '* секунды:'))
            ->add('longitudeDeg', null, array('label' => '* градусы:'))
            ->add('longitudeMin', null, array('label' => '* минуты:'))
            ->add('longitudeSec', null, array('label' => '* секунды:'));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'App\Entity\Destinations',
                // 'validation_groups' => array('address'),
                'validation_groups' => function (FormInterface $form) {
                    $data = $form->getData();

                    if (0 == $data->getType()) {
                        return array('address');
                    }

                    return array('latitude');
                }

            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'App_destinations';
    }
}
