<?php

namespace Cdti\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Cdti\BackendBundle\Entity\Producto;
use Cdti\BackendBundle\Form\ProductoType;

/**
 * Producto controller.
 *
 */
class ProductoController extends Controller
{
    /**
     * Lists all Producto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BackendBundle:Producto')->findAll();

        return $this->render('BackendBundle:Producto:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Producto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el producto solicitado.');
        }

        return $this->render('BackendBundle:Producto:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Producto entity.
     *
     */
    public function newAction()
    {
        $entity = new Producto();
        $form   = $this->createForm(new ProductoType(), $entity);

        return $this->render('BackendBundle:Producto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Producto entity.
     *
     */
    public function createAction()
    {
        $entity  = new Producto();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProductoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              'Se ha creado la fuente.'
            );

            return $this->redirect($this->generateUrl('backend_producto_show', array('id' => $entity->getId())));

        }

        return $this->render('BackendBundle:Producto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el producto solicitado.');
        }

        $editForm = $this->createForm(new ProductoType(), $entity);

        return $this->render('BackendBundle:Producto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Producto entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe el producto solicitado.');
        }

        $editForm   = $this->createForm(new ProductoType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('info',
              'Se ha actualizado el producto.'
            );

            return $this->redirect($this->generateUrl('backend_producto_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Producto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
    /**
     * Respuesta para el autocompletar.
     */
    public function searchJSONAction($keyword = null) {
      $em = $this->getDoctrine()->getEntityManager();
      $results = $em->getRepository('BackendBundle:Producto')->searchProducto($keyword);

      $arrayJSON = array();

      foreach($results as $k => $result) {
        $row = array();
        $row['id'] = $result->getId();
        $row['value'] = $result->getUnidadMedida() . " de " . $result->getDescripcion();
        $row['label'] = $result->getUnidadMedida() . " de " . $result->getDescripcion();
        $arrayJSON[] = $row;
      }

      $response = new Response();

      $response->setContent(json_encode($arrayJSON));

      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
}
