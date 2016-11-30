<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="opciones")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OpcionRepository")
 */
class Opcion
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pregunta", inversedBy="opciones")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id", nullable=false)
     */
    private $pregunta;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $texto;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $correcta;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    function getPregunta() {
        return $this->pregunta;
    }

    function getTexto() {
        return $this->texto;
    }

    function getCorrecta() {
        return $this->correcta;
    }

    function setPregunta($pregunta) {
        $this->pregunta = $pregunta;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setCorrecta($correcta) {
        $this->correcta = $correcta;
    }



}
