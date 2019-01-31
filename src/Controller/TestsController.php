<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestsController extends Controller
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
}
