<?php

namespace Alm\ControlStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LabAlmEgreso
 *
 * @ORM\Table(name="file_alm_egreso")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class LabAlmEgreso
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creado_el", type="datetime", nullable=false)
     */
    private $creadoEl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entregado", type="date", nullable=true)
     */
    private $fechaEntregado;

    /**
     * @var string
     *
     * @ORM\Column(name="recibido_por", type="string", length=70, nullable=true)
     */
    private $recibidoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    //$secciones=array('R'=>'RC-IVA','P'=>'PLANILLA','A'=>'ARCHIVO','E'=>'EVALUACION Y CAPACITACION','AFP'=>'AFP','CA'=>'CONTROL ASISTENCIA','SU'=>'SUBSIDIO','S'=>'SECRETARÍA','AL'=>'ASESORIA-LEGAL');
    /**
     * @var string
     *
     * @ORM\Column(name="seccion", type="string", length=3, nullable=false)
     */
    private $seccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;




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
     * Set fechaEntregado
     *
     * @param \DateTime $fechaEntregado
     * @return LabAlmEgreso
     */
    public function setFechaEntregado($fechaEntregado)
    {
        $this->fechaEntregado = $fechaEntregado;

        return $this;
    }

    /**
     * Get fechaEntregado
     *
     * @return \DateTime 
     */
    public function getFechaEntregado()
    {
        return $this->fechaEntregado;
    }

    /**
     * Set recibidoPor
     *
     * @param string $recibidoPor
     * @return LabAlmEgreso
     */
    public function setRecibidoPor($recibidoPor)
    {
        $this->recibidoPor = $recibidoPor;

        return $this;
    }

    /**
     * Get recibidoPor
     *
     * @return string 
     */
    public function getRecibidoPor()
    {
        return $this->recibidoPor;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return LabAlmEgreso
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
     * Set seccion
     *
     * @param string $seccion
     * @return LabAlmEgreso
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return string 
     */
    public function getSeccion()
    {
        return $this->seccion;
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
