<?php

namespace Alm\ControlStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LabAlmDetalleegreso
 *
 * @ORM\Table(name="file_alm_detalleegreso", indexes={@ORM\Index(name="egreso_id", columns={"egreso_id"}), @ORM\Index(name="productoLab_id", columns={"productoLab_id"})})
 * @ORM\Entity(repositoryClass="Alm\ControlStockBundle\Repository\LabAlmDetalleegresoRepository")
 * @UniqueEntity(
 *     fields={"productolab", "egreso"},
 *     errorPath="productolab",
 *     message="Este egreso ya tiene este producto"
 * )
 */
class LabAlmDetalleegreso
{
    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value=0)
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
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
     * @var \Alm\ControlStockBundle\Entity\LabAlmEgreso
     *
     * @ORM\ManyToOne(targetEntity="Alm\ControlStockBundle\Entity\LabAlmEgreso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="egreso_id", referencedColumnName="id")
     * })
     */
    private $egreso;

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->getCantidad()>$this->getProductolab()->getStock()) {
            $context->buildViolation('No tiene sificiente cantidad en su almacen de este producto')
                ->atPath('cantidad')
                ->addViolation();
        }
        

    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return LabAlmDetalleegreso
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
     * @return LabAlmDetalleegreso
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
     * @return LabAlmDetalleegreso
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
     * Set egreso
     *
     * @param \Alm\ControlStockBundle\Entity\LabAlmEgreso $egreso
     * @return LabAlmDetalleegreso
     */
    public function setEgreso(\Alm\ControlStockBundle\Entity\LabAlmEgreso $egreso = null)
    {
        $this->egreso = $egreso;

        return $this;
    }

    /**
     * Get egreso
     *
     * @return \Alm\ControlStockBundle\Entity\LabAlmEgreso 
     */
    public function getEgreso()
    {
        return $this->egreso;
    }
}
