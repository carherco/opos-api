<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use App\Entity\Opcion;
use App\Entity\Etiqueta;

/**
 * @ORM\Table(name="preguntas")
 * @ORM\Entity(repositoryClass="App\Repository\PreguntaRepository")
 */
class Pregunta
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Test", inversedBy="preguntas", cascade={"persist"})
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id", nullable=false)
     */
    private $test;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $texto;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $explicacion;
    
    /**
     * @ORM\OneToMany(targetEntity="Opcion", mappedBy="pregunta", cascade={"remove"})
     */
    private $opciones;

    /**
     * @ORM\Column(type="boolean")
     */
    private $anulada;
    
    /**
     *
     * @var type \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Etiqueta", mappedBy="preguntas", cascade={"persist"})
     * @ORM\JoinTable(name="pregunta_etiqueta")
     */
    private $etiquetas;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->opciones = new ArrayCollection();
        $this->anulada = false;
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

    function getTest() {
        return $this->test;
    }

    function setTest($test) {
        $this->test = $test;
        return $this;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
        return $this;
    }

    function getOpciones() {
        return $this->opciones;
    }

    function setOpciones($opciones) {
        $this->opciones = $opciones;
        return $this;
    }

    public function addOpcion(Opcion $opcion): self
    {
        if (!$this->opciones->contains($opcion)) {
            $this->opciones[] = $opcion;
            $opcion->setPregunta($this);
        }

        return $this;
    }

    public function removeOpcion(Opcion $opcion): self
    {
        if ($this->opciones->contains($opcion)) {
            $this->opciones->removeElement($opcion);
        }

        return $this;
    }
    
    function getExplicacion() {
        return $this->explicacion;
    }

    function setExplicacion($explicacion) {
        $this->explicacion = $explicacion;
        return $this;
    }
    
    function getEtiquetas() {
        return $this->etiquetas;
    }

    function setEtiquetas($etiquetas) {
        $this->etiquetas = $etiquetas;
        return $this;
    }

    function getAnulada() {
        return $this->anulada;
    }

    function setAnulada($anulada) {
        $this->anulada = $anulada;
        return $this;
    }

}
