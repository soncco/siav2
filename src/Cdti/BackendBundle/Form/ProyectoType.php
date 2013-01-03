<?php

namespace Cdti\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\CallbackValidator;

class ProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anio', 'choice', array(
                'choices' => array(
                    2013 => 2013,
                    2014 => 2014
                )
            ));
        $builder
            ->add('sec_func', null, array('mapped' => false))
            ->add('programa', null, array('mapped' => false))
            ->add('prod_pry', null, array('mapped' => false))
            ->add('act_ai_obra', null, array('mapped' => false))
            ->add('funcion', null, array('mapped' => false))
            ->add('division_func', null, array('mapped' => false))
            ->add('grupo_func', null, array('mapped' => false))
            ->add('meta', null, array('mapped' => false))
            ->add('finalidad', null, array('mapped' => false))
            ->add('nombre', null, array('mapped' => false))
            ->add('fuente', 'entity', array(
                'mapped' => false,
                'class' => 'BackendBundle:Fuente',
                'multiple' => 'true'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdti\BackendBundle\Entity\Proyecto'
        ));
    }

    public function getName()
    {
        return 'cdti_backendbundle_proyectotype';
    }
}
