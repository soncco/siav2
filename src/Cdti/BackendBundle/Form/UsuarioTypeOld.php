<?php

namespace Cdti\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('usuario')
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña'),
                'required' => true ))
            ->add('email', 'email')
            ->add('tipo', 'choice', array(
                'choices' => array(
                    'A' => 'Administrador',
                    'O' => 'Operador'
                )
            ))
            ->add('estado', 'checkbox', array('required' => false))
        ;
        
        $builder
            ->add('proyecto', 'entity', array(
                'mapped' => false,
                'class' => 'BackendBundle:ProyectoCampo',
                'query_builder' => function(EntityRepository $er) {
                  return $er->
                          createQueryBuilder('pc')->
                          where("pc.campo = 'nombre'");
                },
                'multiple' => 'true'
            ))
            ->add('area', 'entity', array(
                'mapped' => false,
                'class' => 'BackendBundle:Area',
                'multiple' => 'true'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdti\BackendBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'cdti_backendbundle_usuariotype';
    }
}
