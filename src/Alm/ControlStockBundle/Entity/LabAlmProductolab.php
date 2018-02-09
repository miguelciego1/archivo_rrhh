<?php

namespace Alm\ControlStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LabAlmProductolab
 *
 * @ORM\Table(name="file_alm_producto", indexes={@ORM\Index(name="producto_id", columns={"producto_id"})})
 * @ORM\Entity(repositoryClass="Alm\ControlStockBundle\Repository\LabAlmProductolabRepository")
 * @UniqueEntity(
 *     fields={"producto"},
 *     errorPath="producto",
 *     message="Este producto ya existe"
 * )
 */
class LabAlmProductolab
{
    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

 
    /**
     * @var integer
     *
     * @ORM\Column(name="minimo", type="integer", nullable=true)
     */
    private $minimo;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Alm\ControlStockBundle\Entity\AlmAdmProducto
     *
     * @ORM\OneToOne(targetEntity="Alm\ControlStockBundle\Entity\AlmAdmProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_id", referencedColumnName="id" , unique=true)
     * })
     */
    private $producto;



    /**
     * Set stock
     *
     * @param integer $stock
     * @return LabAlmProductolab
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return LabAlmProductolab
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
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
     * Set minimo
     *
     * @param integer $minimo
     * @return LabAlmProductolab
     */
    public function setMinimo($minimo)
    {
        $this->minimo = $minimo;

        return $this;
    }

    /**
     * Get minimo
     *
     * @return integer 
     */
    public function getMinimo()
    {
        return $this->minimo;
    }

    /**
     * Set presentacion
     *
     * @param string $presentacion
     * @return LabAlmProductolab
     */
    public function setPresentacion($presentacion)
    {
        $this->presentacion = $presentacion;

        return $this;
    }

    /**
     * Get presentacion
     *
     * @return string 
     */
    public function getPresentacion()
    {
        return $this->presentacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return LabAlmProductolab
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
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
     * Set producto
     *
     * @param \Alm\ControlStockBundle\Entity\AlmAdmProducto $producto
     * @return LabAlmProductolab
     */
    public function setProducto(\Alm\ControlStockBundle\Entity\AlmAdmProducto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \Alm\ControlStockBundle\Entity\AlmAdmProducto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}
