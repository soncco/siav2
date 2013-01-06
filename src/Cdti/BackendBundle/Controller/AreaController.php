<?php

namespace Cdti\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdti\BackendBundle\Entity\Area;
use Cdti\BackendBundle\Form\AreaType;

/**
 * Area controller.
 *
 */
class AreaController extends Controller
{
    /**
     * Lists all Area entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BackendBundle:Area')->findAll();

        return $this->render('BackendBundle:Area:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Area entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el área solicitada.');
        }

        return $this->render('BackendBundle:Area:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Area entity.
     *
     */
    public function newAction()
    {
        $entity = new Area();
        $form   = $this->createForm(new AreaType(), $entity);

        return $this->render('BackendBundle:Area:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Area entity.
     *
     */
    public function createAction()
    {
        $entity  = new Area();
        $request = $this->getRequest();
        $form    = $this->createForm(new AreaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              sprintf('Se ha creado el área "%s."', $entity)
            );

            return $this->redirect($this->generateUrl('backend_area_show', array('id' => $entity->getId())));

        }

        return $this->render('BackendBundle:Area:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Area entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el área solicitada.');
        }

        $editForm = $this->createForm(new AreaType(), $entity);

        return $this->render('BackendBundle:Area:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Area entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Area')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el área solicitada.');
        }

        $editForm   = $this->createForm(new AreaType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              sprintf('Se ha actualizado el área "%s".', $entity)
            );

            return $this->redirect($this->generateUrl('backend_area_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Area:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    public function printAction($id) {
      $em = $this->getDoctrine()->getEntityManager();
      $entity = $em->getRepository('BackendBundle:Area')->find($id);
      
      return true;
    }
}
