<?php

namespace Cdti\BackendBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="Cdti\BackendBundle\Entity\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nombres;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $usuario;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $password;
    
    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email()
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $salt;
    
    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $tipo;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $estado;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Area", inversedBy="usuario")
     * @ORM\JoinTable(name="usuario_area",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     *   }
     * )
     */
    private $area;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Proyecto", inversedBy="usuario")
     * @ORM\JoinTable(name="usuario_proyecto",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
     *   }
     * )
     */
    private $proyecto;

    public function __toString()
    {
      return $this->getNombres();
    }
    
    public function __construct() {
      $this->estado = 1;
      $this->area = new \Doctrine\Common\Collections\ArrayCollection();
      $this->proyecto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Método requerido por la interfaz UserInterface
     */
    public function eraseCredentials()
    {
    }

    /**
     * Método requerido por la interfaz UserInterface
     */
    public function getRoles()
    {
      switch($this->getTipo()) {
        case 'A':
          return array('ROLE_ADMIN');
        case 'O':
          return array('ROLE_USUARIO');
      }
    }

    /**
     * Método requerido por la interfaz UserInterface
     */
    public function getUsername()
    {
        return $this->getUsuario();
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
     * @param string $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set usuario
     *
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }
        
    /**
     * Set tipo
     *
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    /**
     * Set estado.
     * @param integer $estado 
     */
    public function setEstado($estado) {
      $this->estado = $estado;
    }
    
    /**
     * Get estado.
     * @return int
     */
    public function getEstado() {
      return (bool)$this->estado;
    }
    
    /**
     * Add area
     *
     * @param \Cdti\BackendBundle\Entity\Area $area
     * @return Usuario
     */
    public function addArea(\Cdti\BackendBundle\Entity\Area $area)
    {
        $this->area[] = $area;
    
        return $this;
    }

    /**
     * Remove area
     *
     * @param \Cdti\BackendBundle\Entity\Area $area
     */
    public function removeArea(\Cdti\BackendBundle\Entity\Area $area)
    {
        $this->area->removeElement($area);
    }

    /**
     * Get area
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Add proyecto
     *
     * @param \Cdti\BackendBundle\Entity\Proyecto $proyecto
     * @return Usuario
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