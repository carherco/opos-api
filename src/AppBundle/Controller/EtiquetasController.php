<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class EtiquetasController extends Controller
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
            ->getRepository('AppBundle:Etiqueta')
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
