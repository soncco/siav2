<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cdti\BackendBundle\Entity\ProductoRepository")
 */
class Producto
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
     * @ORM\Column(name="unidad_medida", type="string", length=100)
     */
    private $unidad_medida;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;


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
     * Set unidad_medida
     *
     * @param string $unidadMedida
     * @return Producto
     */
    public function setUnidadMedida($unidadMedida)
    {
        $this->unidad_medida = $unidadMedida;
    
        return $this;
    }

    /**
     * Get unidad_medida
     *
     * @return string 
     */
    public function getUnidadMedida()
    {
        return $this->unidad_medida;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
