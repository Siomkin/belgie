<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', null, ['label' => 'Координаты'])
            ->add('addressCity', null, ['label' => '* Населенный пункт:'])
            ->add('addressRegion', null, ['label' => '* Область, район:'])
            ->add('addressStreet', null, ['label' => '* Улица:', 'empty_data' => null, 'placeholder' => 'Выберите'])
            ->add('addressIndex', null, ['label' => '* Индекс:'])
            ->add('addressBuildingNumber', null, ['label' => '* № Дома-корпус:'])
            ->add('addressOfficeNumber', null, ['label' => '№ Офиса, комнаты или квартиры:'])
            ->add('latitudeDeg', null, ['label' => '* градусы:'])
            ->add('latitudeMin', null, ['label' => '* минуты:'])
            ->add('latitudeSec', null, ['label' => '* секунды:'])
            ->add('longitudeDeg', null, ['label' => '* градусы:'])
            ->add('longitudeMin', null, ['label' => '* минуты:'])
            ->add('longitudeSec', null, ['label' => '* секунды:']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => 'App\Entity\Destinations',
                // 'validation_groups' => array('address'),
                'validation_groups' => function (FormInterface $form) {
                    $data = $form->getData();

                    if (0 === $data->getType()) {
                        return ['address'];
                    }

                    return ['latitude'];
                },
            ]
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
