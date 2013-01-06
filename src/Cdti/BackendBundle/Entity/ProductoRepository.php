<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductoRepository extends EntityRepository
{
  public function queryUsuarios() {
    $em = $this->getEntityManager();
    $dql = "SELECT u FROM BackendBundle:Usuario u";
    $query = $em->createQuery($dql);
    
    return $query;
  }
  
  public function findUsuarios() {
    return $this->queryUsuarios()->getResult();
  }
  
  public function searchProducto($keyword) {
    $em = $this->getEntityManager();
    $results = $em->getRepository('BackendBundle:Producto')
            ->createQueryBuilder('p')
            ->where('p.descripcion LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->getQuery()
            ->getResult();
    
    return $results;
  }
}