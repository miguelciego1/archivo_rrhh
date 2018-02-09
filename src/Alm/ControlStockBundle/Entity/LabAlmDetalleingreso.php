<?php

namespace Alm\ControlStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LabAlmDetalleingreso
 *
 * @ORM\Table(name="file_alm_detalleingreso", indexes={@ORM\Index(name="ingreso_id", columns={"ingreso_id"}), @ORM\Index(name="productoLab_id", columns={"productoLab_id"})})
 * @ORM\Entity(repositoryClass="Alm\ControlStockBundle\Repository\LabAlmDetalleingresoRepository")
 * @UniqueEntity(
 *     fields={"productolab", "ingreso"},
 *     errorPath="productolab",
 *     message="Este ingreso ya tiene este producto"
 * )
 */
class LabAlmDetalleingreso
{
    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value=1)
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Alm\ControlStockBundle\Entity\LabAlmProductolab
     *
     * @ORM\ManyToOne(targetEntity="Alm\ControlStockBundle\Entity\LabAlmProductolab")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productoLab_id", referencedColumnName="id")
     * })
     */
    private $productolab;

    /**
     * @var \Alm\ControlStockBundle\Entity\LabAlmIngreso
     *
     * @ORM\ManyToOne(targetEntity="Alm\ControlStockBundle\Entity\LabAlmIngreso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ingreso_id", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $ingreso;



    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return LabAlmDetalleingreso
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return LabAlmDetalleingreso
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
     * Set productolab
     *
     * @param \Alm\ControlStockBundle\Entity\LabAlmProductolab $productolab
     * @return LabAlmDetalleingreso
     */
    public function setProductolab(\Alm\ControlStockBundle\Entity\LabAlmProductolab $productolab = null)
    {
        $this->productolab = $productolab;

        return $this;
    }

    /**
     * Get productolab
     *
     * @return \Alm\ControlStockBundle\Entity\LabAlmProductolab 
     */
    public function getProductolab()
    {
        return $this->productolab;
    }

    /**
     * Set ingreso
     *
     * @param \Alm\ControlStockBundle\Entity\LabAlmIngreso $ingreso
     * @return LabAlmDetalleingreso
     */
    public function setIngreso(\Alm\ControlStockBundle\Entity\LabAlmIngreso $ingreso = null)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso
     *
     * @return \Alm\ControlStockBundle\Entity\LabAlmIngreso 
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }
}
