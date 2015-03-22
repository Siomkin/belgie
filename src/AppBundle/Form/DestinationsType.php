<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('addressCity', null, array('label' => 'Населенный пункт:'))
            ->add('addressRegion', null, array('label' => 'Область, район:'))
            ->add('addressStreet', null, array('label' => 'Улица:'))
            ->add('addressIndex', null, array('label' => 'Индекс:'))
            ->add('addressBuildingNumber', null, array('label' => '№ Дома-корпус:'))
            ->add('addressOfficeNumber', null, array('label' => '№ Офиса, комнаты или квартиры:'))
            ->add('latitudeDeg', null, array('label' => 'градусы:'))
            ->add('latitudeMin', null, array('label' => 'минуты:'))
            ->add('latitudeSec', null, array('label' => 'секунды:'))
            ->add('longitudeDeg', null, array('label' => 'градусы:'))
            ->add('longitudeMin', null, array('label' => 'минуты:'))
            ->add('longitudeSec', null, array('label' => 'секунды:'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Destinations'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_destinations';
    }
}
