<?php

namespace Cdti\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdti\BackendBundle\Entity\Requerimiento;
use Cdti\BackendBundle\Form\RequerimientoType;

/**
 * Requerimiento controller.
 *
 */
class RequerimientoController extends Controller
{
    /**
     * Lists all Requerimiento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BackendBundle:Requerimiento')->findAll();

        return $this->render('BackendBundle:Requerimiento:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Requerimiento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Requerimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el requerimiento solicitado.');
        }

        return $this->render('BackendBundle:Requerimiento:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Requerimiento entity.
     *
     */
    public function newAction()
    {
        $entity = new Requerimiento();
        $form   = $this->createForm(new RequerimientoType(), $entity);

        return $this->render('BackendBundle:Requerimiento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Requerimiento entity.
     *
     */
    public function createAction()
    {
        $entity  = new Requerimiento();
        $request = $this->getRequest();
        $form    = $this->createForm(new RequerimientoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              'Se ha creado el requerimiento'
            );

            return $this->redirect($this->generateUrl('backend_req_show', array('id' => $entity->getId())));

        }

        return $this->render('BackendBundle:Requerimiento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Requerimiento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Requerimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el requerimiento solicitado.');
        }

        $editForm = $this->createForm(new RequerimientoType(), $entity);

        return $this->render('BackendBundle:Requerimiento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Requerimiento entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Requerimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el requerimiento solicitado.');
        }

        $editForm   = $this->createForm(new RequerimientoType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              'Se ha actualizado el requerimiento.'
            );

            return $this->redirect($this->generateUrl('backend_req_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Requerimiento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
