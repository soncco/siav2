<?php

namespace Cdti\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RequerimientoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('fecha', 'date', array(
                'years' => range(date('Y'), date('Y')),
                'data' => date_create()
            ))
            ->add('glosa', null, array(
                'attr' => 
                  array(
                      'cols' => 80,
                      'rows' => 6,
                )))
            //->add('detalles', 'collection', array('type' => new RequerimientoDetalleType()))
            ->add('detalles', 'collection', array(
                'type' => new RequerimientoDetalleType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdti\BackendBundle\Entity\Requerimiento',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'cdti_backendbundle_reqtype';
    }
}
