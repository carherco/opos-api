<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class EtiquetasController extends AbstractController
{
    /**
     * @Route("/etiqueta", name="etiqueta")
     */
    public function indexAction(Request $request)
    {
        $response = new JsonResponse();
        
        $em = $this->getDoctrine()->getManager();
        
        $data = array();

        $etiquetas = $this->getDoctrine()
            ->getRepository('App:Etiqueta')
            ->findAll();
  
        foreach($etiquetas as $etiqueta) {
            $item = array();
            $item['id'] = $etiqueta->getId();
            $item['name'] = $etiqueta->getNombre();
            $item['numQuestions'] = count($etiqueta->getPreguntas());
            $data[] = $item;
        }
      
        $response->setData($data);
        return $response;
    }
}
