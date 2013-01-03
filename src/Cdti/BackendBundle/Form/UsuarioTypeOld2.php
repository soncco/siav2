<?php
namespace Cdti\BackendBundle\Form;

use Cdti\BackendBundle\Form\UsuarioType;

/**
 * Formulario para editar el perfil de los usuarios registrados.
 */
class UsuarioEditType extends UsuarioType
{

    public function getDefaultOptions(array $options)
    {
        return array(
            'validation_groups' => array('default')
        );
    }
}
