<?php

namespace Cps\Personal\ArchivoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * archivo
 *
 * @ORM\Table(name="file_virtual_archivo")
 * @ORM\Entity(repositoryClass="Cps\Personal\ArchivoBundle\Repository\archivoRepository")
 */
class archivo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Debe ingresar la fecha."))
     * @Assert\DateTime( message="Formato de fecha no valido.")
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     * @ORM\Column(name="glosa", type="text", nullable=true)
     */
    private $glosa;

    /**
     * @var int
     * @Assert\NotBlank(message="Este campo es obligatorio."))
     * @ORM\Column(name="nroempleado", type="integer")
     */
    private $nroempleado;
    //----------------------------------------------FORANEAS--------------------------------------//
    /**
     *@ORM\OneToMany(targetEntity="Cps\Personal\ArchivoBundle\Entity\detalle", mappedBy="archivo")
     *@ORM\JoinColumn(nullable=false)
     */
     protected $detalle;
    //----------------------------------------------FORANEAS--------------------------------------//
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return archivo
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
     * @return archivo
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
     * Set nroempleado
     *
     * @param integer $nroempleado
     * @return archivo
     */
    public function setNroempleado($nroempleado)
    {
        $this->nroempleado = $nroempleado;

        return $this;
    }

    /**
     * Get nroempleado
     *
     * @return integer
     */
    public function getNroempleado()
    {
        return $this->nroempleado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalle = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add detalle
     *
     * @param \Cps\Personal\ArchivoBundle\Entity\detalle $detalle
     * @return archivo
     */
    public function addDetalle(\Cps\Personal\ArchivoBundle\Entity\detalle $detalle)
    {
        $this->detalle[] = $detalle;

        return $this;
    }

    /**
     * Remove detalle
     *
     * @param \Cps\Personal\ArchivoBundle\Entity\detalle $detalle
     */
    public function removeDetalle(\Cps\Personal\ArchivoBundle\Entity\detalle $detalle)
    {
        $this->detalle->removeElement($detalle);
    }

    /**
     * Get detalle
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}
