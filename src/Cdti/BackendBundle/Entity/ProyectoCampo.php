<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProyectoCampo
 *
 * @ORM\Table(name="proyecto_campo")
 * @ORM\Entity(repositoryClass="Cdti\BackendBundle\Entity\ProyectoRepository")
 */
class ProyectoCampo
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cdti\BackendBundle\Entity\Proyecto")
     */
    private $proyecto;

    /**
     * @ORM\Id
     * @ORM\Column(name="campo", type="string", length=50)
     */
    private $campo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255)
     */
    private $valor;
    
    public function __toString() {
      return $this->getValor();
    }


    /**
     * Set proyecto
     *
     * @param \Cdti\BackendBundle\Entity\Proyecto $proyecto
     * @return ProyectoCampo
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

    /**
     * Set campo
     *
     * @param string $campo
     * @return ProyectoCampo
     */
    public function setCampo($campo)
    {
        $this->campo = $campo;
    
        return $this;
    }

    /**
     * Get campo
     *
     * @return string 
     */
    public function getCampo()
    {
        return $this->campo;
    }

    /**
     * Set valor
     *
     * @param string $valor
     * @return ProyectoCampo
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }
}
