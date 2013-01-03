<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto
 *
 * @ORM\Table(name="proyecto")
 * @ORM\Entity(repositoryClass="Cdti\BackendBundle\Entity\ProyectoRepository")
 */
class Proyecto
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
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Fuente", mappedBy="proyecto")
     */
    private $fuente;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="proyecto")
     */
    private $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fuente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
      return (string)$this->id;
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
     * Set anio
     *
     * @param integer $anio
     * @return Proyecto
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    
        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Add fuente
     *
     * @param \Cdti\BackendBundle\Entity\Fuente $fuente
     * @return Proyecto
     */
    public function addFuente(\Cdti\BackendBundle\Entity\Fuente $fuente)
    {
        $this->fuente[] = $fuente;
        return $this;
    }

    /**
     * Remove fuente
     *
     * @param \Cdti\BackendBundle\Entity\Fuente $fuente
     */
    public function removeFuente(\Cdti\BackendBundle\Entity\Fuente $fuente)
    {
        $this->fuente->removeElement($fuente);
    }

    /**
     * Get fuente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Add usuario
     *
     * @param \Cdti\BackendBundle\Entity\Usuario $usuario
     * @return Proyecto
     */
    public function addUsuario(\Cdti\BackendBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;
        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \Cdti\BackendBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\Cdti\BackendBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
