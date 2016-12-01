<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use AppBundle\Validator\Constraints\Zabbix as ZabbixAssert;

/**
 * @ORM\Table(name="preguntas")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PreguntaRepository")
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
     * @ORM\Column(type="text", nullable=false)
     */
    private $texto;
    
    /**
     * @ORM\OneToMany(targetEntity="Opcion", mappedBy="pregunta", cascade={"remove"})
     */
    private $opciones;
    
    /**
     *
     * @var type \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Etiqueta", mappedBy="preguntas")
     * @ORM\JoinTable(name="pregunta_etiqueta")
     */
    private $etiquetas;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->opciones = new ArrayCollection();
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

    function getTexto() {
        return $this->texto;
    }

    function getOpciones() {
        return $this->opciones;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setOpciones($opciones) {
        $this->opciones = $opciones;
    }
    
    function getEtiquetas() {
        return $this->etiquetas;
    }

    function setEtiquetas(type $etiquetas) {
        $this->etiquetas = $etiquetas;
    }
    
}
