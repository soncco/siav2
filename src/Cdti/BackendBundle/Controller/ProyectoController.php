<?php

namespace Cdti\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdti\BackendBundle\Entity\Proyecto;
use Cdti\BackendBundle\Entity\ProyectoFuente;
use Cdti\BackendBundle\Entity\ProyectoCampo;
use Cdti\BackendBundle\Entity\Fuente;
use Cdti\BackendBundle\Form\ProyectoType;
use Cdti\BackendBundle\Form\ProyectoEditType;

/**
 * Proyecto controller.
 *
 */
class ProyectoController extends Controller
{
    /**
     * Lists all Proyecto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $proyectos = $em->getRepository('BackendBundle:Proyecto')->findAll();

        foreach($proyectos as $k => $proyecto) {
          $fuentes = $em->getRepository('BackendBundle:Proyecto')->findFuentes($proyecto);
          $campos = $em->getRepository('BackendBundle:Proyecto')->findCampos($proyecto);
          
          $proyectos[$k]->fuentes = $fuentes;
          $proyectos[$k]->campos = $campos;
        }

        return $this->render('BackendBundle:Proyecto:index.html.twig', array(
            'entities' => $proyectos,
        ));
    }

    /**
     * Finds and displays a Proyecto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Proyecto')->find($id);
        
        $fuentes = $em->getRepository('BackendBundle:Proyecto')->findFuentes($entity);
        $campos = $em->getRepository('BackendBundle:Proyecto')->findCampos($entity);
        
        $entity->fuentes = $fuentes;
        $entity->campos = $campos;

        if (!$entity) {
            throw $this->createNotFoundException('No existe la fuente solicitada.');
        }

        return $this->render('BackendBundle:Proyecto:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Proyecto entity.
     *
     */
    public function newAction()
    {
        $entity = new Proyecto();
        $form   = $this->createForm(new ProyectoType(), $entity);

        return $this->render('BackendBundle:Proyecto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Proyecto entity.
     *
     */
    public function createAction()
    {
      $peticion = $this->getRequest();
      
        $em = $this->getDoctrine()->getEntityManager();

        $formulario = $this->createForm(new ProyectoType());
        
        if ($peticion->getMethod() == 'POST') {
            $formulario->bind($peticion);
              
            if ($formulario->isValid()) {
              $valores = $peticion->request->get($formulario->getName());
              
              // Creamos el proyecto.
              $proyecto = new Proyecto();
              $proyecto->setAnio($valores['anio']);
              
              $em->persist($proyecto);
              $em->flush();
              
              // Asignamos las fuentes al proyecto.
              foreach($valores['fuente'] as $fuente) {
                $oFuente = $em->getRepository('BackendBundle:Fuente')->find($fuente);
                $proyectoFuente = new ProyectoFuente();
                $proyectoFuente->setFuente($oFuente);
                $proyectoFuente->setProyecto($proyecto);
                
                $em->persist($proyectoFuente);
                $em->flush();
              }
              
              // Quitamos valores innecesarios.
              unset($valores['fuente']);
              unset($valores['anio']);
              unset($valores['_token']);
              
              // Agregarmos campos al proyecto.
              foreach($valores as $key => $valor) {
                $proyectoCampo = new ProyectoCampo();
                $proyectoCampo->setProyecto($proyecto);
                $proyectoCampo->setCampo($key);
                $proyectoCampo->setValor($valor);

                $em->persist($proyectoCampo);
                $em->flush();
              }

              // Mensaje de que todo está correcto.
              $this->get('session')->setFlash('info',
                  'Se ha creado el proyecto.'
              );

              return $this->redirect($this->generateUrl('backend_proyecto_show', array('id' => $proyecto->getId())));
            }
            
            return $this->render('BackendBundle:Proyecto:new.html.twig', array(
              'form'   => $formulario->createView(),
            ));
        }
    }

    /**
     * Displays a form to edit an existing Proyecto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Proyecto')->find($id);
        
        $fuentes = $em->getRepository('BackendBundle:Proyecto')->findFuentes($entity);
        $campos = $em->getRepository('BackendBundle:Proyecto')->findCampos($entity);
        
        $entity->fuentes = $fuentes;
        $entity->campos = $campos;

        if (!$entity) {
            throw $this->createNotFoundException('No existe el proyecto solicitado.');
        }

        $editForm = $this->createForm(new ProyectoEditType(), $entity);

        return $this->render('BackendBundle:Proyecto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Proyecto entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BackendBundle:Proyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No existe la fuente solicitada.');
        }

        $editForm   = $this->createForm(new ProyectoEditType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        
        if ($editForm->isValid()) {

            $valores = $request->request->get($editForm->getName());
            $em->persist($entity);
            $em->flush();
            
            // FIXME: Borra las fuentes existentes del proyecto y añade las nuevas.
            $em->getRepository('BackendBundle:Proyecto')->deleteFuentes($entity);
            
            // Asignamos las fuentes al proyecto.
            foreach($valores['fuente'] as $fuente) {
              $oFuente = $em->getRepository('BackendBundle:Fuente')->find($fuente);
              $proyectoFuente = new ProyectoFuente();
              $proyectoFuente->setFuente($oFuente);
              $proyectoFuente->setProyecto($entity);

              $em->persist($proyectoFuente);
              $em->flush();
            }
            
            // Quitamos valores innecesarios.
            unset($valores['fuente']);
            unset($valores['anio']);
            unset($valores['_token']);

            // Actualizamos los campos del proyecto campos al proyecto.
            foreach($valores as $key => $valor) {
              $proyectoCampo = $em->getRepository('BackendBundle:ProyectoCampo')->findOneBy(array(
                'proyecto' => $entity,
                'campo' => $key
              ));
              
              if (is_null($proyectoCampo)) {
                $proyectoCampo = new ProyectoCampo();
                $proyectoCampo->setProyecto($entity);
                $proyectoCampo->setCampo($key);
              }
              
              $proyectoCampo->setValor($valor);

              $em->persist($proyectoCampo);
              $em->flush();
            }
            
            $this->get('session')->setFlash('info',
              'Se han actualizado los datos del proyecto.'
            );

            return $this->redirect($this->generateUrl('backend_proyecto_show', array('id' => $id)));
        }

        return $this->render('BackendBundle:Proyecto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
