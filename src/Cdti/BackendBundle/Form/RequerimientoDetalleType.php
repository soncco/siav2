<?php

namespace Cdti\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RequerimientoDetalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('producto', new ProductoACType())
            ->add('cantidad', 'text', array(
                'attr' => array(
                    'class' => 'tiny'
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdti\BackendBundle\Entity\RequerimientoDetalle'
        ));
    }

    public function getName()
    {
        return 'cdti_backendbundle_reqtype';
    }
}
