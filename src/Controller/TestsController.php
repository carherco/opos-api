<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestsController extends AbstractController
{
    /**
     * @Route("/tests", name="tests")
     */
    public function indexAction(Request $request)
    {
        $response = new JsonResponse();
        
        $em = $this->getDoctrine()->getManager();
        
        $data = array();

        $tests = $this->getDoctrine()
            ->getRepository('App:Test')
            ->findAll();
  
        foreach($tests as $test) {
            $item = array();
            $item['id'] = $test->getId();
            $item['name'] = $test->getNombre();
            $item['year'] = $test->getAnyo();
            $item['month'] = $test->getMes();
            $item['city'] = $test->getCiudad();
            $item['numQuestions'] = count($test->getPreguntas());
            $data[] = $item;
        }
      
        $response->setData($data);
        return $response;
    }

    /**
     * @Route("/wordcount", name="wordcount")
     */
    public function wordCountAction(Request $request)
    {
        $question_words = array();

        $em = $this->getDoctrine()->getManager();
        $preguntas = $this->getDoctrine()
            ->getRepository('App:Pregunta')
            ->findAll();

        // ITERATE OVER THE ROWS OF THE QUERY RESULTS SET
        foreach($preguntas as $pregunta)
        {
            $texto = $pregunta->getTexto();
            // DISCARD NON-LETTERS AND EXTRA WHITESPACE CHARS
            $texto  = preg_replace('/^[\p{L}-]*$/u', ' ', $texto);
            $texto  = preg_replace('/\s\s+/', ' ', $texto);
            $texto  = preg_replace('/¿/', '', $texto);
            $texto  = preg_replace('/:/', '', $texto);
            $texto  = preg_replace('/,/', '', $texto);
            $texto = mb_strtoupper($texto);
            
            $unwanted_array = array('À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U');
            $texto = strtr( $texto, $unwanted_array );

            // SPLIT THE STRING INTO (MOSTLY) WORDS
            $words  = array_unique(explode(' ', $texto));
            
            // ITERATE OVER THE WORDS
            foreach($words as $word)
            {
                if ($word !== '') {
                    if(!isset($question_words[$word])) $question_words[$word] = 0;
                    $question_words[$word]++;
                }
            }
        }

        arsort($question_words);

        dump($question_words);
        // SHOW THE TOP-TEN
        $limit = 1000;
        foreach ($question_words as $word => $count)
        {
            echo "<br/> - " . " $word (" . number_format($count) . ")" . PHP_EOL;
            $limit--;
            if (!$limit) break;
        }
    }

}
