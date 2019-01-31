<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Table(name="tests")
 * @ORM\Entity(repositoryClass="App\Repository\EtiquetaRepository")
 */
class Test
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ciudad;

    /**
     * @ORM\Column(type="integer")
     */
    private $mes;

    /**
     * @ORM\Column(type="integer")
     */
    private $anyo;
    
    /**
     * @var type \Doctrine\Common\Collections\Collection
     * 
     * @ORM\OneToMany(targetEntity="Pregunta", mappedBy="test",  cascade={"remove"})
     * 
     */
    private $preguntas;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preguntas = new ArrayCollection();
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

    function getNombre() {
        return $this->nombre;
    }

    function getPreguntas() {
        return $this->preguntas;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setPreguntas($preguntas) {
        $this->preguntas = $preguntas;
        return $this;
    }

    /**
     * Get the value of ciudad
     */ 
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */ 
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of mes
     */ 
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set the value of mes
     *
     * @return  self
     */ 
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get the value of anyo
     */ 
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * Set the value of anyo
     *
     * @return  self
     */ 
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;

        return $this;
    }
}
