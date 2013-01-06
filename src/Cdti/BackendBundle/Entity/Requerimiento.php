<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Requerimiento
 *
 * @ORM\Table(name="requerimiento")
 * @ORM\Entity
 */
class Requerimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=20, nullable=false)
     */
    private $numero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="glosa", type="text", nullable=true)
     */
    private $glosa;

    /**
     * @var \Usuario
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;
    
    protected $detalles;
    
    public function __construct() {
      $this->detalles = new ArrayCollection();
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
     * Set numero
     *
     * @param string $numero
     * @return Requerimiento
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Requerimiento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set glosa
     *
     * @param string $glosa
     * @return Requerimiento
     */
    public function setGlosa($glosa)
    {
        $this->glosa = $glosa;
    
        return $this;
    }

    /**
     * Get glosa
     *
     * @return string 
     */
    public function getGlosa()
    {
        return $this->glosa;
    }

    /**
     * Set usuario
     *
     * @param \Cdti\BackendBundle\Entity\Usuario $usuario
     * @return Requerimiento
     */
    public function setUsuario(\Cdti\BackendBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Cdti\BackendBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function getDetalles()
    {
        return $this->detalles;
    }

    public function setDetalles(ArrayCollection $detalles = null)
    {
        $this->detalles = $detalles;
    }
}