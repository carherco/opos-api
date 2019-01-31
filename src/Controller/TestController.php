<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends Controller
{
    /**
     * @Route("/test/{id}", name="test")
     */
    public function testAction(Request $request, $id)
    {
        $response = new JsonResponse();
        
        $em = $this->getDoctrine()->getManager();
        
        $output = array();

        $test = $this->getDoctrine()
            ->getRepository('App:Test')
            ->find($id);

        if (!$test) {
            throw $this->createNotFoundException(
                'No existe el test solicitado: '.$id
            );
        }
        
        $preguntas = $test->getPreguntas();
        
        $output['id'] = $test->getId();
        $output['name'] = $test->getNombre();
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
        
        $response->setData($output);
        return $response;
    }
    
    /**
     * @Route("/pregunta/{id}", name="homepage")
     */
    public function preguntaAction(Request $request, $id)
    {
        $response = new JsonResponse();
        
        $em = $this->getDoctrine()->getManager();
        
        $data = array();

        $pregunta = $this->getDoctrine()
            ->getRepository('AppBundle:Pregunta')
            ->find($id);

        if (!$pregunta) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        
        $data['id'] = $pregunta->getId();
        $data['texto'] = $pregunta->getTexto();
        $data['test'] = array();
        $data['opciones'] = array();
        $data['etiquetas'] = array();
        $data['explicacion'] = $pregunta->getExplicacion();
        
        $data['test']['nombre'] = $pregunta->getTest()->getNombre();
        
        foreach($pregunta->getOpciones() as $opcion) {
            $item = array();
            $item['id'] = $opcion->getId();
            $item['texto'] = $opcion->getTexto();
            $item['correcta'] = $opcion->getCorrecta();
            $data['opciones'][] = $item;
        }
        
        foreach($pregunta->getEtiquetas() as $etiqueta) {
            $item = array();
            $item['nombre'] = $etiqueta->getNombre();
            $data['etiquetas'][] = $item;
        }
        
        $response->setData($data);
        return $response;
    }
}
