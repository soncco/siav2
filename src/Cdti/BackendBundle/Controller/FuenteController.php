<?php

namespace Cdti\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdti\BackendBundle\Entity\Fuente;
use Cdti\BackendBundle\Form\FuenteType;

/**
 * Fuente controller.
 *
 */
class FuenteController extends Controller
{
    /**
     * Lists all Fuente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BackendBundle:Fuente')->findAll();

        return $this->render('BackendBundle:Fuente:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Fuente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Fuente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la fuente solicitada.');
        }

        return $this->render('BackendBundle:Fuente:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Fuente entity.
     *
     */
    public function newAction()
    {
        $entity = new Fuente();
        $form   = $this->createForm(new FuenteType(), $entity);

        return $this->render('BackendBundle:Fuente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Fuente entity.
     *
     */
    public function createAction()
    {
        $entity  = new Fuente();
        $request = $this->getRequest();
        $form    = $this->createForm(new FuenteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              sprintf('Se ha creado la fuente "%s."', $entity)
            );

            return $this->redirect($this->generateUrl('backend_fuente_show', array('id' => $entity->getId())));

        }

        return $this->render('BackendBundle:Fuente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Fuente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Fuente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la fuente solicitada.');
        }

        $editForm = $this->createForm(new FuenteType(), $entity);

        return $this->render('BackendBundle:Fuente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Fuente entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Fuente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la fuente solicitada.');
        }

        $editForm   = $this->createForm(new FuenteType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              sprintf('Se ha actualizado la fuente "%s".', $entity)
            );

            return $this->redirect($this->generateUrl('backend_fuente_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Fuente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
