<?php

namespace Cps\Personal\ArchivoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="per_empleado",
              indexes={ @ORM\Index(name="pat_idx", columns={"paterno"}),
                        @ORM\Index(name="mat_idx", columns={"materno"}),
                        @ORM\Index(name="nom_idx", columns={"nombre"})
                      }
             )
 * @ORM\Entity(repositoryClass="Cps\Personal\ArchivoBundle\Entity\EmpleadoRepository")
 */
class Empleado{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $paterno;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $materno;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $docid;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;

    /**
     * @ORM\Column(type="date")
     */
    private $fchnac;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telfij;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telcel;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telref;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $busajax;

    /**
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

// === Funciones Auxiliares ============================================ //

    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public function __toString(){
        return $this->getNomCompleto();
    }

    public function getNomCompleto(){
        return $this->getPaterno().' '.$this->getMaterno().' '.$this->getNombre();
    }

    public function getNomCompletoNPM(){
        return $this->getNombre().' '.$this->getPaterno().' '.$this->getMaterno();
    }

    public function getIdNomCompleto(){
        return $this->id.'   '.$this->getNomCompleto();
    }

    public function getNombre(){
        return ucwords(strtolower($this->nombre));
    }

    public function getPaterno(){
        return ucwords(strtolower($this->paterno));
    }

    public function getMaterno(){
        return ucwords(strtolower($this->materno));
    }

// === Foraneas ======================================================== //

   /**
    * @ORM\ManyToOne(targetEntity="Cps\Administracion\AdministracionBundle\Entity\Nacionalidad", inversedBy="empleados")
    * @ORM\JoinColumn(name="nacionalidad_id", nullable=false)
    */
   protected $nacionalidad;

   /**
    * @ORM\ManyToOne(targetEntity="Cps\Administracion\AdministracionBundle\Entity\Dptobol", inversedBy="empleados")
    * @ORM\JoinColumn(name="prodocid_id", nullable=false)
    */
   protected $proDocId;

   /**
    * @ORM\ManyToOne(targetEntity="Cps\Administracion\AdministracionBundle\Entity\Tipdocid", inversedBy="empleados")
    * @ORM\JoinColumn(name="tipdocid_id", nullable=false)
    */
   protected $tipDocId;

// === Getter ======================================================== //

    /**
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDocid(){
        return $this->docid;
    }

    /**
     * @return string
     */
    public function getSexo(){
        return $this->sexo;
    }

    /**
     * @return \DateTime
     */
    public function getFchnac(){
        return $this->fchnac;
    }

    /**
     * @return string
     */
    public function getDireccion(){
        return $this->direccion;
    }

    /**
     * @return string
     */
    public function getTelfij(){
        return $this->telfij;
    }

    /**
     * @return string
     */
    public function getTelcel(){
        return $this->telcel;
    }

    /**
     * @return string
     */
    public function getTelref(){
        return $this->telref;
    }

    /**
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @return string
     */
    public function getBusajax(){
        return $this->busajax;
    }

    /**
     * @return boolean
     */
    public function getActivo(){
        return $this->activo;
    }

    /**
     * @return \Cps\Administracion\AdministracionBundle\Entity\Nacionalidad
     */
    public function getNacionalidad(){
        return $this->nacionalidad;
    }

    /**
     * @return \Cps\Administracion\AdministracionBundle\Entity\Dptobol
     */
    public function getProDocId(){
        return $this->proDocId;
    }

    /**
     * @return \Cps\Administracion\AdministracionBundle\Entity\Tipdocid
     */
    public function getTipDocId(){
        return $this->tipDocId;
    }


    /**
     * Set paterno
     *
     * @param string $paterno
     * @return Empleado
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Set materno
     *
     * @param string $materno
     * @return Empleado
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Empleado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Set docid
     *
     * @param string $docid
     * @return Empleado
     */
    public function setDocid($docid)
    {
        $this->docid = $docid;

        return $this;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Empleado
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Set fchnac
     *
     * @param \DateTime $fchnac
     * @return Empleado
     */
    public function setFchnac($fchnac)
    {
        $this->fchnac = $fchnac;

        return $this;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Empleado
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Set telfij
     *
     * @param string $telfij
     * @return Empleado
     */
    public function setTelfij($telfij)
    {
        $this->telfij = $telfij;

        return $this;
    }

    /**
     * Set telcel
     *
     * @param string $telcel
     * @return Empleado
     */
    public function setTelcel($telcel)
    {
        $this->telcel = $telcel;

        return $this;
    }

    /**
     * Set telref
     *
     * @param string $telref
     * @return Empleado
     */
    public function setTelref($telref)
    {
        $this->telref = $telref;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Empleado
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set busajax
     *
     * @param string $busajax
     * @return Empleado
     */
    public function setBusajax($busajax)
    {
        $this->busajax = $busajax;

        return $this;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Empleado
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Set nacionalidad
     *
     * @param \Cps\Administracion\AdministracionBundle\Entity\Nacionalidad $nacionalidad
     * @return Empleado
     */
    public function setNacionalidad(\Cps\Administracion\AdministracionBundle\Entity\Nacionalidad $nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Set proDocId
     *
     * @param \Cps\Administracion\AdministracionBundle\Entity\Dptobol $proDocId
     * @return Empleado
     */
    public function setProDocId(\Cps\Administracion\AdministracionBundle\Entity\Dptobol $proDocId)
    {
        $this->proDocId = $proDocId;

        return $this;
    }

    /**
     * Set tipDocId
     *
     * @param \Cps\Administracion\AdministracionBundle\Entity\Tipdocid $tipDocId
     * @return Empleado
     */
    public function setTipDocId(\Cps\Administracion\AdministracionBundle\Entity\Tipdocid $tipDocId)
    {
        $this->tipDocId = $tipDocId;

        return $this;
    }
}
