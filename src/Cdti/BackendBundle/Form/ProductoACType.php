<?php

namespace Cdti\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoACType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('descripcion', 'text', array(
              'attr' => 
                array(
                    'class' => 'autocomplete big',
              )))
        ;
        
        $builder
          ->add('pid', 'hidden', array(
                'mapped' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdti\BackendBundle\Entity\Producto'
        ));
    }

    public function getName()
    {
        return 'cdti_backendbundle_productotype';
    }
}
