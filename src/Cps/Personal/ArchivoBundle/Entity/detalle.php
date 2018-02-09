<?php

namespace Cps\Personal\ArchivoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * detalle
 *
 * @ORM\Table(name="file_virtual_detalle")
 * @ORM\Entity(repositoryClass="Cps\Personal\ArchivoBundle\Repository\detalleRepository")
 */
class detalle
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
     * @Assert\NotBlank(message="Debe Ingresar el nombre."))
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ext", type="string", length=3)
     */
    private $ext;

    /**
     * @var int
     * 
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="fechareg", type="datetime")
     */
    private $fechareg;
    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255)
     */
    private $archivo;
    //------------------------------------FORENEAS------------------------------------//
    /**
     *@ORM\ManyToOne(targetEntity="Cps\Personal\ArchivoBundle\Entity\tipo", inversedBy="detalles")
     *@ORM\JoinColumn(nullable=false)
     */
    protected $tipo;

    /**
     *@ORM\ManyToOne(targetEntity="Cps\Personal\ArchivoBundle\Entity\archivo", inversedBy="detalle")
     *@ORM\JoinColumn(nullable=false)
     */
    protected $archivoc;
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
     * @return detalle
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
     * Set archivo
     *
     * @param string $archivo
     * @return detalle
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set tipo
     *
     * @param \Cps\Personal\ArchivoBundle\Entity\tipo $tipo
     * @return detalle
     */
    public function setTipo(\Cps\Personal\ArchivoBundle\Entity\tipo $tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Cps\Personal\ArchivoBundle\Entity\tipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set archivoc
     *
     * @param \Cps\Personal\ArchivoBundle\Entity\archivo $archivoc
     * @return detalle
     */
    public function setArchivoc(\Cps\Personal\ArchivoBundle\Entity\archivo $archivoc)
    {
        $this->archivoc = $archivoc;

        return $this;
    }

    /**
     * Get archivoc
     *
     * @return \Cps\Personal\ArchivoBundle\Entity\archivo 
     */
    public function getArchivoc()
    {
        return $this->archivoc;
    }

    /**
     * Set ext
     *
     * @param string $ext
     * @return detalle
     */
    public function setExt($ext)
    {
        $this->ext = $ext;

        return $this;
    }

    /**
     * Get ext
     *
     * @return string 
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * Set fechareg
     *
     * @param \DateTime $fechareg
     * @return detalle
     */
    public function setFechareg($fechareg)
    {
        $this->fechareg = $fechareg;

        return $this;
    }

    /**
     * Get fechareg
     *
     * @return \DateTime 
     */
    public function getFechareg()
    {
        return $this->fechareg;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return detalle
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
