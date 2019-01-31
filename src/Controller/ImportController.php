<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Test;
use App\Entity\Pregunta;
use App\Entity\Opcion;

class ImportController extends Controller
{
    /**
     * @Route("/import/form", name="import_form")
     */
    public function indexAction(Request $request)
    {
        return $this->render('import/form.html.twig', []);
    }

    /**
     * @Route("/import/process", name="import_process")
     */
    public function processAction(Request $request)
    {
        ini_set('auto_detect_line_endings',TRUE);
        $num_respuestas = $request->get('num_options');
        $file = $request->files->get('import');
        $handle = fopen($file->getPathname(),"r");

        $em = $this->getDoctrine()->getEntityManager();
        $mapa_respuestas = ['A','B','C','D'];
        $data = array();
        $test = new Test();
        $test->setNombre('Importación '.date('Ymd-his'));
        $em->persist($test);
        while ( ($line = fgetcsv($handle) ) !== FALSE ) {
          if($line[0]) {
            $pregunta = new Pregunta();
            $pregunta->setTexto(trim($line[0]));
            $pregunta->setTest($test);
            $pregunta->setAnulada(trim($line[$num_respuestas+1]) == 'ANULADA');
            for($o = 1; $o <= $num_respuestas; $o++){
              $opcion = new Opcion();
              $opcion->setTexto(trim($line[$o]));
              $esLaCorrecta = $line[$num_respuestas +1] == $mapa_respuestas[$o - 1];
              $opcion->setCorrecta($esLaCorrecta);
              $opcion->setPregunta($pregunta);
              $em->persist($opcion);
              $pregunta->addOpcion($opcion);
            }
            $em->persist($pregunta);
          }
        }
        $em->flush();
        ini_set('auto_detect_line_endings',FALSE);

        var_dump($data); exit;

        return $this->render('import/form.html.twig', [
            
        ]);
    }

}
