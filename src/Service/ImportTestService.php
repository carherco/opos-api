<?php

namespace App\Service;

class ImportTestService {

  public function txt2csv($plain_text) {

    $plain_text_cleaned = $this->fixText($plain_text);
//dump($plain_text_cleaned);
    $patrones = [
      '/(\R\d+\..*)\R([Aa][\.\)].*)\R([Bb][\.\)].*)\R([Cc][\.\)].*)\R([Dd][\.\)].*)/', //Número de pregunta+.+pregunta+salto de línea+a)+respuesta+salto de línea+b)+respuesta+salto de línea+c)+respuesta+d)+respuesta
      '/(\R\d+\..*)\R([Aa][\.\)].*)\R([Bb][\.\)].*)\R([Cc][\.\)].*)/', //Número de pregunta+.+pregunta+salto de línea+a)+respuesta+salto de línea+b)+respuesta+salto de línea+c)+respuesta
    ];

    $sustituciones = [
      "$1;$2;$3;$4;$5",
      "$1;$2;$3;$4"
    ];
    $resultado = preg_replace($patrones, $sustituciones, PHP_EOL.$plain_text_cleaned);

    return $resultado;
  }

  public function fixText($text) {
    $patrones = [
      '/(\R\d+)\s/', // Números de pregunta sin estar seguidos de un punto
      '/\R\d+[\R|\s]/',  // Números de página
      '/\b(\R[a-dA-D][\)\.]\s)/', // Signos . olvidados seguidos de letra de pregunta
      '/\b(\R\d+\.\s)/', // Signos . olvidados seguidos de número de pregunta
      '/\b\R/', // Saltos de línea no precedidos por signo de puntuación (:.?)
      '/,\R/', // Saltos de línea precedidos de una coma
      '/\)\R/', // Saltos de línea precedidos de un paréntesis de cierre
      '/\R(\R)/' // 2 saltos de línea consecutivos
      
    ];
    
    $sustituciones = [
      '$1. ',
      '',
      '.$1', // Se les añade un . para que el último reemplazo no le afecte
      '.$1', // Se les añade un . para que el último reemplazo no le afecte
      ' ',
      ', ',
      ') ',
      '$1'
    ];

    return preg_replace($patrones, $sustituciones, $text);
  }
}