<?php

namespace Cdti\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequerimientoDetalle
 *
 * @ORM\Table(name="requerimiento_detalle")
 * @ORM\Entity
 */
class RequerimientoDetalle
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
     * @var float
     *
     * @ORM\Column(name="cantidad", type="decimal", nullable=false)
     */
    private $cantidad;

    /**
     * @var \Producto
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_id", referencedColumnName="id")
     * })
     */
    private $producto;

    /**
     * @var \Requerimiento
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Requerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="requerimiento_id", referencedColumnName="id")
     * })
     */
    private $requerimiento;



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
     * Set cantidad
     *
     * @param float $cantidad
     * @return RequerimientoDetalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set producto
     *
     * @param \Cdti\BackendBundle\Entity\Producto $producto
     * @return RequerimientoDetalle
     */
    public function setProducto(\Cdti\BackendBundle\Entity\Producto $producto)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Cdti\BackendBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set requerimiento
     *
     * @param \Cdti\BackendBundle\Entity\Requerimiento $requerimiento
     * @return RequerimientoDetalle
     */
    public function setRequerimiento(\Cdti\BackendBundle\Entity\Requerimiento $requerimiento)
    {
        $this->requerimiento = $requerimiento;
    
        return $this;
    }

    /**
     * Get requerimiento
     *
     * @return \Cdti\BackendBundle\Entity\Requerimiento 
     */
    public function getRequerimiento()
    {
        return $this->requerimiento;
    }
}