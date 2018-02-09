<?php

namespace Alm\ControlStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * LabAlmIngreso
 *
 * @ORM\Table(name="file_alm_ingreso", uniqueConstraints={@ORM\UniqueConstraint(name="numero_egreso_almacen", columns={"numero_egreso_almacen"})})
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"numeroEgresoAlmacen"},
 *     errorPath="numeroEgresoAlmacen",
 *     message="Este numero de egreso ya existe"
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class LabAlmIngreso
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recibido", type="date", nullable=false)
     */
    private $fechaRecibido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creado_el", type="datetime", nullable=false)
     */
    private $creadoEl;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_egreso_almacen", type="integer", nullable=false, unique = true)
     */
    private $numeroEgresoAlmacen;

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
     * Set fechaRecibido
     *
     * @param \DateTime $fechaRecibido
     * @return LabAlmIngreso
     */
    public function setFechaRecibido($fechaRecibido)
    {
        $this->fechaRecibido = $fechaRecibido;

        return $this;
    }

    /**
     * Get fechaRecibido
     *
     * @return \DateTime 
     */
    public function getFechaRecibido()
    {
        return $this->fechaRecibido;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreadoEl()
    {
        $this->creadoEl = new \DateTime();

        return $this;
    }

    /**
     * Get creadoEl
     *
     * @return \DateTime 
     */
    public function getCreadoEl()
    {
        return $this->creadoEl;
    }

    /**
     * Set numeroEgresoAlmacen
     *
     * @param integer $numeroEgresoAlmacen
     * @return LabAlmIngreso
     */
    public function setNumeroEgresoAlmacen($numeroEgresoAlmacen)
    {
        $this->numeroEgresoAlmacen = $numeroEgresoAlmacen;

        return $this;
    }

    /**
     * Get numeroEgresoAlmacen
     *
     * @return integer 
     */
    public function getNumeroEgresoAlmacen()
    {
        return $this->numeroEgresoAlmacen;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return LabAlmIngreso
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

   
}
