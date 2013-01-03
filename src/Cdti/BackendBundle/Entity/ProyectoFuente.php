<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProyectoFuente
 *
 * @ORM\Table(name="proyecto_fuente")
 * @ORM\Entity
 */
class ProyectoFuente
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cdti\BackendBundle\Entity\Fuente")
     */
    private $fuente;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cdti\BackendBundle\Entity\Proyecto")
     */
    private $proyecto;
    
    public function __toString() {
      return $this->getFuente()->getNombre();
    }

    /**
     * Set fuente
     *
     * @param \Cdti\BackendBundle\Entity\Fuente $fuente
     * @return ProyectoFuente
     */
    public function setFuente(\Cdti\BackendBundle\Entity\Fuente $fuente)
    {
        $this->fuente = $fuente;
    
        return $this;
    }

    /**
     * Get fuente
     *
     * @return \Cdti\BackendBundle\Entity\Fuente 
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Set proyecto
     *
     * @param \Cdti\BackendBundle\Entity\Proyecto $proyecto
     * @return ProyectoFuente
     */
    public function setProyecto(\Cdti\BackendBundle\Entity\Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
    
        return $this;
    }

    /**
     * Get proyecto
     *
     * @return \Cdti\BackendBundle\Entity\Proyecto 
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }
}
