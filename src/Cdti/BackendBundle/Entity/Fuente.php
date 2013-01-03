<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fuente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Fuente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Proyecto", inversedBy="fuente")
     * @ORM\JoinTable(name="proyecto_fuente",
     *   joinColumns={
     *     @ORM\JoinColumn(name="fuente_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
     *   }
     * )
     */
    private $proyecto;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proyecto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * toString.
     */
    public function __toString() {
      return $this->getNombre();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Fuente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * Add proyecto
     *
     * @param \Cdti\BackendBundle\Entity\Proyecto $proyecto
     * @return Fuente
     */
    public function addProyecto(\Cdti\BackendBundle\Entity\Proyecto $proyecto)
    {
        $this->proyecto[] = $proyecto;
    
        return $this;
    }

    /**
     * Remove proyecto
     *
     * @param \Cdti\BackendBundle\Entity\Proyecto $proyecto
     */
    public function removeProyecto(\Cdti\BackendBundle\Entity\Proyecto $proyecto)
    {
        $this->proyecto->removeElement($proyecto);
    }

    /**
     * Get proyecto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }
}
