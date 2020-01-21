<?php

namespace App\Service;

use App\Repository\PreguntaRepository;

class TestsGeneratorService {

  private $preguntaRepository;

  public function __construct(PreguntaRepository $preguntaRepository) {
    $this->preguntaRepository = $preguntaRepository;
  }

  public function generateThematicTest($theme, $numQuestions = 20) {
    
    $output = array();
    $preguntas = $this->preguntaRepository->findByWords($theme, $numQuestions);
    
    $output['id'] = 0;
    $output['name'] = $theme;
    $output['questions'] = array();
    
    foreach($preguntas as $pregunta) {
        $data = array();
        $data['id'] = $pregunta->getId();
        $data['text'] = $pregunta->getTexto();
        $data['answers'] = array();
        $data['labels'] = array();
        $data['explanation'] = $pregunta->getExplicacion();

        foreach($pregunta->getOpciones() as $opcion) {
            $item = array();
            $item['id'] = $opcion->getId();
            $item['text'] = $opcion->getTexto();
            $item['correct'] = $opcion->getCorrecta();
            $data['answers'][] = $item;
        }

        foreach($pregunta->getEtiquetas() as $etiqueta) {
            $item = array();
            $item['nombre'] = $etiqueta->getNombre();
            $data['labels'][] = $item;
        }
        $output['questions'][] = $data;
    }  

    return $output;
  }
  
}