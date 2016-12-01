<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends Controller
{
    /**
     * @Route("/pregunta/{id}", name="homepage")
     */
    public function indexAction(Request $request, $id)
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
        $data['opciones'] = array();
        foreach($pregunta->getOpciones() as $opcion) {
            $item = array();
            $item['id'] = $opcion->getId();
            $item['texto'] = $opcion->getTexto();
            $item['correcta'] = $opcion->getCorrecta();
            $data['opciones'][] = $item;
        }
        
        $response->setData($data);
        return $response;
    }
}
