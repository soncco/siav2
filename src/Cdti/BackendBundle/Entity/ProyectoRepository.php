<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProyectoRepository extends EntityRepository
{
  public function findFuentes(Proyecto $proyecto) {
    
    $em = $this->getEntityManager();
    
    $dql = "SELECT pf FROM BackendBundle:Fuente f
      JOIN BackendBundle:ProyectoFuente pf
      WHERE pf.proyecto = :proyecto";

    $query = $em->createQuery($dql);
    $query->setParameter("proyecto", $proyecto);

    return $query->getResult();    
  }
  
  public function findCampos(Proyecto $proyecto) {

    $em = $this->getEntityManager();

    $dql = "SELECT pc FROM BackendBundle:ProyectoCampo pc
            WHERE pc.proyecto = :proyecto";

    $query = $em->createQuery($dql);
    $query->setParameter("proyecto", $proyecto);

    return $query->getResult();
  }
  
  public function deleteFuentes(Proyecto $proyecto) {
    $em = $this->getEntityManager();
    
    $dql = "DELETE BackendBundle:ProyectoFuente pf 
      WHERE pf.proyecto = :proyecto";
    
    $query = $em->createQuery($dql);
    $query->setParameter('proyecto', $proyecto);
    
    return $query->execute();
  }
}