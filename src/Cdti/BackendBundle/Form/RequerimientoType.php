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
            ->add('fecha', 'your_date',
                    array(
                        'widget' => 'single_text',
                        )
                  )
            ->add('glosa')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdti\BackendBundle\Entity\Requerimiento'
        ));
    }

    public function getName()
    {
        return 'cdti_backendbundle_reqtype';
    }
}
