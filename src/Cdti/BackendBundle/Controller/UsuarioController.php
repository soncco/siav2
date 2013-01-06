<?php

namespace Cdti\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cdti\BackendBundle\Entity\Usuario;
use Cdti\BackendBundle\Form\UsuarioType;
use Cdti\BackendBundle\Form\UsuarioTestType;
use Cdti\BackendBundle\Form\UsuarioEditType;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{
    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Usuario')->findAll();
        return $this->render('BackendBundle:Usuario:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Usuario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el usuario.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Usuario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()));
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     */
    public function newAction()
    {
        $entity = new Usuario();
        $form   = $this->createForm(new UsuarioType(), $entity);

        return $this->render('BackendBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Usuario entity.
     *
     */
    public function createAction(Request $request)
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $usuario = new Usuario();

        $formulario = $this->createForm(new UsuarioType(), $usuario);

        if ($peticion->getMethod() == 'POST') {
            $formulario->bind($peticion);

            if ($formulario->isValid()) {
                // Completar las propiedades que el usuario no rellena en el formulario
                $usuario->setSalt(md5(time()));

                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                    $usuario->getPassword(),
                    $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);

                // Guardar el nuevo usuario en la base de datos
                $em->persist($usuario);
                $em->flush();

                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                $this->get('session')->setFlash('info',
                    'Se ha creado el usuario.'
                );
                
                return $this->redirect($this->generateUrl('backend_usuario_show', array('id' => $usuario->getId())));
            }
            
            return $this->render('BackendBundle:Usuario:new.html.twig', array(
              'entity' => $usuario,
              'form'   => $formulario->createView(),
            ));
        }
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el usuario.');
        }

        $editForm = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Usuario entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el usuario.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UsuarioType(), $entity);

        $originalPassword = $editForm->getData()->getPassword();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            if (null == $entity->getPassword()) {
                $entity->setPassword($originalPassword);
            }
            else {
                $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
                $codedPassword = $encoder->encodePassword(
                    $entity->getPassword(),
                    $entity->getSalt()
                );
                $entity->setPassword($codedPassword);
            }
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('info',
                sprintf('Se ha modificado el usuario "%s".', $entity->getUsuario())
            );

            return $this->redirect($this->generateUrl('backend_usuario_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Usuario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Usuario entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se encuentra el usuario.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_usuario'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
