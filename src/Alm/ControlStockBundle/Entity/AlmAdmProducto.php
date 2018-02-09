<?php

namespace Alm\ControlStockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlmAdmProducto
 *
 * @ORM\Table(name="alm_adm_producto", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_7115BBB43C3C1592", columns={"codPro"})})
 * @ORM\Entity(repositoryClass="Alm\ControlStockBundle\Repository\AlmAdmProductoRepository")
 */
class AlmAdmProducto
{
    /**
     * @var string
     *
     * @ORM\Column(name="codPro", type="string", length=12, nullable=false)
     */
    private $codpro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=65, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="uniMedida", type="string", length=15, nullable=false)
     */
    private $unimedida;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=1, nullable=true)
     */
    private $prioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="string", length=1, nullable=false)
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set codpro
     *
     * @param string $codpro
     * @return AlmAdmProducto
     */
    public function setCodpro($codpro)
    {
        $this->codpro = $codpro;

        return $this;
    }

    /**
     * Get codpro
     *
     * @return string 
     */
    public function getCodpro()
    {
        return $this->codpro;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return AlmAdmProducto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set unimedida
     *
     * @param string $unimedida
     * @return AlmAdmProducto
     */
    public function setUnimedida($unimedida)
    {
        $this->unimedida = $unimedida;

        return $this;
    }

    /**
     * Get unimedida
     *
     * @return string 
     */
    public function getUnimedida()
    {
        return $this->unimedida;
    }

    /**
     * Set prioridad
     *
     * @param string $prioridad
     * @return AlmAdmProducto
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return string 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set activo
     *
     * @param string $activo
     * @return AlmAdmProducto
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return string 
     */
    public function getActivo()
    {
        return $this->activo;
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
