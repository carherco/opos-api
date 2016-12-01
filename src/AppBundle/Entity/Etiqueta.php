<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use AppBundle\Validator\Constraints\Zabbix as ZabbixAssert;

/**
 * @ORM\Table(name="etiquetas")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EtiquetaRepository")
 */
class Etiqueta
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, nullable=false)
     */
    private $nombre;
    
    /**
     * @var type \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="Pregunta", inversedBy="etiquetas")
     * @ORM\JoinTable(name="pregunta_etiqueta")
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
    }

    function setPreguntas(type $preguntas) {
        $this->preguntas = $preguntas;
    }


    
}
