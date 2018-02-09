<?php

namespace Cps\Personal\ArchivoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tipo
 *
 * @ORM\Table(name="file_virtual_tipo")
 * @ORM\Entity(repositoryClass="Cps\Personal\ArchivoBundle\Repository\tipoRepository")
 */
class tipo
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;
    //------------------------------------FORENEAS------------------------------------//
    /**
     *@ORM\OneToMany(targetEntity="Cps\Personal\ArchivoBundle\Entity\detalle", mappedBy="tipo")
     *@ORM\JoinColumn(nullable=false)
     */
     protected $detalle;

     public function __toString(){
     	return $this->nombre;
    }
    //---------------------------------------------------------------------------------//

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
     * @param string $nombre
     * @return tipo
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
     * @return tipo
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
